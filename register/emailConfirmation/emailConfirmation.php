<?php 
    include("../../setup.php");
    include("../../sendmail.php");

    if(!(isset($_SESSION["name"]) && isset($_SESSION["email"]) && isset($_SESSION["password"]) && isset($_SESSION["bedrock"]) && isset($_SESSION["premium"]))){
        header("Location: ../../register");
        exit();
    }
    $name=$_SESSION["name"];
    $email=$_SESSION["email"];
    $password=$_SESSION["password"];
    $bedrock= $_SESSION["bedrock"];
    $premium= $_SESSION["premium"];
    $avatar = "../_images/default-avatar.jpg";
    if(isset($_POST["resend"]) || !isset($_SESSION["confirmation_id"])){

        $code = (string)(random_int(10000, 99999));
        $time = time() + 60*5;
        $expiresAt = date("Y-m-d H:i:s", $time);
        $codeHash = hash("sha256", $code . $expiresAt . $email);

        $attempts = 0;
        $conn->insert("confirmacao_de_email", [$name, $email, $codeHash, $expiresAt, $attempts, null]);
        $_SESSION["confirmation_id"] = $conn->get("confirmacao_de_email", "code_hash", $codeHash)[0][0];
        sendCodeMail($email, $code);


        header("Location: ". $_SERVER["PHP_SELF"]);
        exit();

    }
    if(!isset($_POST["code"])) exit();

    $result=$conn->get("confirmacao_de_email", "id", $_SESSION["confirmation_id"])[0];
    $isTheSameCode = hash_equals($result[3], hash("sha256", $_POST["code"] . $result[4] . $email));

    $conn->update("confirmacao_de_email", $result[0], "attempts", $result[5]+1);

    if($isTheSameCode && $result[5] <= 5){

    $conn->insert("registros", [$name, $email, password_hash($password, PASSWORD_DEFAULT), $premium, $bedrock, $avatar]);
    $conn->update("confirmacao_de_email", $result[0], "confirmed_at", date("Y-m-d H:i:s", time()));
    $result = $conn->get("registros", "nome", $name)[0];
    
    $token = bin2hex(random_bytes(32));
    $id = $result[0];
    $ip = $_SERVER["REMOTE_ADDR"];
    $userAgent = $_SERVER["HTTP_USER_AGENT"];
    $time = time() + (60  * 15);
    $expiresAt = date("Y-m-d H:i:s", $time);
    $createdAt = date("Y-m-d H:i:s", time());
    $_SESSION["token"] = $token;
    $_SESSION["id"] = $id;

    $conn->insert("tokens", [$id, hash_hmac("sha256", $token.$createdAt.$id, SECRET_CODE), $ip, $userAgent, $expiresAt, $createdAt]);
    unset($_SESSION["name"]);
    unset($_SESSION["email"]);
    unset($_SESSION["confirmation_id"]);
    unset($_SESSION["password"]);
    unset($_SESSION["bedrock"]);
    unset($_SESSION["premium"]);

    header("Location: ../../homepage");
    }elseif($result[4]>5){
        echo "erro demais. gera outro codigo";
    }else{
        echo "codigo ta errado";
    }
    

?>