<?php 

function validateToken(database $conn, string $secret_code, string $token, string $user_id){
    $result = $conn->get("tokens", "user_id", $_SESSION["id"]);
    $tokenId = null;
    foreach ($result as $row){
        if ($row[5] < date("Y-m-d H:i:s",time())){
            $conn->removeRow("tokens", "id", $row[0]);
        }elseif($row[5] < date("Y-m-d H:i:s", time() + 60*15)){
            $conn->update("tokens", $row[0], "expires_at", date("Y-m-d H:i:s", time() + 60*30));
        }
        
        if (hash_hmac("sha256",$_SESSION["token"].$row[6].$_SESSION["id"],$secret_code) == $row[2] && $row[5] > date("Y-m-d H:i:s",time())){
            $userAgent= $_SERVER["HTTP_USER_AGENT"];
            if($userAgent != $row[4]){
                header("Location: ../logout.php");
            }
            $tokenId = $row[0];
        }
    }
    return $tokenId; 
}

?>