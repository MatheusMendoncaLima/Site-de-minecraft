<?php 
        include("_utils/db.php");



        $serverip= "127.0.0.1";
        $username= "root";
        $password= "";
        $database= "minezin";


        $conn = new database($serverip,$username,$password, $database) ;
        $conn->add_table("registros", ["nome", "email", "senha", "original", "bedrock", "avatar"]);
        $conn->add_table("tokens", ["user_id", "token_hash", "ip_address","user_agent", "expires_at", "created_at"]);
        $conn->add_table("2FA", ["user_id", "code_hash", "expires_at","attempts", "used_at"]);
        $conn->add_table("confirmacao_de_email", ["nome", "email", "code_hash", "expires_at","attempts", "confirmed_at"]);


?>