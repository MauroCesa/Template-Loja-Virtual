<?php
//Se não existir email, redireciona para index
// isset -> Verifica se foi criada
session_start();
if(!isset($_SESSION["email"])){
    header("Location: login.php");
    exit();
}
?>