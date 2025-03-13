<?php 
        if ($_POST == null ) return;
        
        include("../setup.php");

        if($_POST["name"] == "" || $_POST["email"] == "" || $_POST["password"]== ""){
            echo "<div class=\"d-flex w-100 border rounded border-danger  align-items-center\" style=\" height: 100px; background-color:rgb(253, 138, 138);\">";
            echo " <p class=\"m-3\">Fill all the necessary fields.</p> ";
            echo "</div>";
            return;
        }



        $result = $conn->get("registros", "nome", $_POST["name"]);
        
        if (sizeof($result) > 0){
            echo "<div class=\"d-flex w-100 border rounded border-danger  align-items-center\" style=\" height: 100px; background-color:rgb(253, 138, 138);\">";
            echo " <p class=\"m-3\">this name already have been registered.</p> ";
            echo "</div>";
        }else{
        $_SESSION["name"] = $_POST["name"];
        $_SESSION["email"] = $_POST["email"];
        $_SESSION["password"] = $_POST["password"];
        $_SESSION["bedrock"] = isset($_POST["bedrock"]);
        $_SESSION["premium"] = isset($_POST["premium"]);
        header("Location: emailConfirmation");
        exit();
        

        }
                            
        
        $conn->disconnect();




        ?>