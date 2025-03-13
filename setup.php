<?php 
        include("validateToken.php");
        include("setupDB.php");

        session_start();

        if((isset($_COOKIE["token"]) && isset($_COOKIE["id"])) && !(isset($_SESSION["token"]) && isset($_SESSION["id"]))){
            $_SESSION["token"] = $_COOKIE["token"];
            $_SESSION["id"] = $_COOKIE["id"];

        }
        //it's better to use ENV and change this sometimes
        const SECRET_CODE = "codigo secreto";
?>