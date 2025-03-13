<?php 
include("../setup.php");

if (!(isset($_SESSION["token"]) && isset($_SESSION["id"]))) {
    header("Location: ../login");
    exit();
}



if(!(validateToken($conn, SECRET_CODE, $_SESSION["token"], $_SESSION["id"]))) {
    header("Location: ../logout.php");
    exit();
};

echo var_dump($_SERVER["HTTP_USER_AGENT"]);


$result = $conn->get("registros", "id", $_SESSION["id"])[0];

$name = $result[1];
$email = $result[2];
$original = $result[4];
$bedrock = $result[5];
$avatar = $result[6];



?>