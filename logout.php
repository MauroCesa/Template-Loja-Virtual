<?php

if(!isset($_SESSION['email'])) {
    //Se você possui algum cookie relacionado com o login dever ser removido
    echo "dentro";
    session_start();
    session_destroy();
    header("location: login.php");
}

echo "fora";
?>