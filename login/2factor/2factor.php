<?php 
    include("../../setup.php");
    include("../../sendmail.php");

    if(!(isset($_SESSION["name"]) && isset($_SESSION["user_id"]) && isset($_SESSION["password"]))){
        header("Location: ../../login");
        exit();
    }
    $result = $conn->get("registros", "nome", $_SESSION["name"])[0];
    if(!password_verify( $_SESSION["password"] ,$result[3])){
        header("Location: ../../login");
        exit();
    }
    if(isset($_POST["resend"]) || !isset($_SESSION["2FA_id"])){
        $result = $conn->get("registros", "nome", $_SESSION["name"]);

        $code = (string)(random_int(10000, 99999));
        $time = time() + 60*5;
        $expiresAt = date("Y-m-d H:i:s", $time);
        $codeHash = hash("sha256", $code . $expiresAt . $_SESSION["user_id"]);

        $attempts = 0;
        $conn->insert("2FA", [$_SESSION["user_id"], $codeHash, $expiresAt, $attempts, null]);
        $_SESSION["2FA_id"] = $conn->get("2FA", "code_hash", $codeHash)[0][0];
        sendCodeMail($result[0][2], $code);


        header("Location: ". $_SERVER["PHP_SELF"]);
        exit();

    }
    if(!isset($_POST["code"])) exit();

    $result=$conn->get("2FA", "id", $_SESSION["2FA_id"])[0];
    $isTheSameCode = hash_equals($result[2], hash("sha256", $_POST["code"] . $result[3] . $_SESSION["user_id"]));

    $conn->update("2FA", $result[0], "attempts", $result[4]+1);

    if($isTheSameCode && $result[4] <= 5){
    $conn->update("2FA", $result[0], "used_at", date("Y-m-d H:i:s", time()));
    $token = bin2hex(random_bytes(32));
    $id = $_SESSION["user_id"];
    $ip = $_SERVER["REMOTE_ADDR"];
    $userAgent = $_SERVER["HTTP_USER_AGENT"];
    $time = time() + (($_SESSION["remember"])? (86400 * 30) : (60  * 15));
    $expiresAt = date("Y-m-d H:i:s", $time);
    $createdAt = date("Y-m-d H:i:s", time());
    $_SESSION["token"] = $token;
    $_SESSION["id"] = $id;
    
    if(isset($_SESSION["remember"])){
        setcookie("token",$token, $time, "/", $_SERVER["SERVER_NAME"], false, true);
        setcookie("id",$id, $time, "/", $_SERVER["SERVER_NAME"], false, true);
    
        
    }

    $conn->insert("tokens", [$id, hash_hmac("sha256", $token.$createdAt.$id, SECRET_CODE), $ip, $userAgent, $expiresAt, $createdAt]);
    unset($_SESSION["name"]);
    unset($_SESSION["user_id"]);
    unset($_SESSION["2FA_id"]);
    unset($_SESSION["password"]);
    unset($_SESSION["remember"]);


    header("Location: ../../homepage");
    }elseif($result[4]>5){
        echo "erro demais. gera outro codigo";
    }else{
        echo "codigo ta errado";
    }
    

?>