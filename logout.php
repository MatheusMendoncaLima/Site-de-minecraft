<?php 
session_start();
if (!(isset($_SESSION["token"]) && isset($_SESSION["id"]))) {
    header("Location: /login");
    exit();
}

include("setup.php");



if($tokenId = validateToken($conn, SECRET_CODE, $_SESSION["token"], $_SESSION["id"])){
$conn->removeRow("tokens", "id", $tokenId);
}

setcookie("token","", $time, "/", $_SERVER["SERVER_NAME"], false, true);
setcookie("id","", $time, "/", $_SERVER["SERVER_NAME"], false, true);

unset($_SESSION["token"]);
unset($_SESSION["id"]);




header("Location: login");
?>