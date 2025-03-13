<?php 

include("../setup.php");

if (isset($_SESSION["token"]) && isset($_SESSION["id"])) {
    header("Location: ../homepage");
    exit();
}

if (!(isset($_POST["name"]) && isset($_POST["password"]))) return;


$result = $conn->get("registros", "nome", $_POST["name"]);
if(sizeof($result) >= 1 && password_verify($_POST["password"], $result[0][3])){

    $_SESSION["name"]=$_POST["name"];
    $_SESSION["user_id"]=$result[0][0];
    $_SESSION["password"] = $_POST["password"];
    $_SESSION["remember"] = isset($_POST["remember"]);

    header("Location: 2factor");


}else{
    echo "<div class=\"d-flex w-100 border rounded border-danger  align-items-center\" style=\" height: 100px; background-color:rgb(253, 138, 138);\">";
    echo " <p class=\"m-3\">Nome ou senha incorretos.</p> ";
    echo "</div>";
}
?>