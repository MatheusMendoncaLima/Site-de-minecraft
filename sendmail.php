<?php 
const email = "testesdeemail123456@gmail.com";

function sendCodeMail(string $email, string $code){
    $headers = "MIME-Version: 1.1\n";
    $headers .= "Content-type: text/plain; charset=iso-8859-1\n";
    $headers .= "From: ".email."\n"; // remetente
    $headers .= "Return-Path: $email \n"; // return-path
    $headers .= "Reply-To: $email\n"; // Endereço (devidamente validado) que o seu usuário informou no contato
    $envio = mail($email, "Assunto", "$code", $headers, "-f$email");

    if ($envio){
        echo "mandado";
    }else {
        echo "error";
    }
}

?>