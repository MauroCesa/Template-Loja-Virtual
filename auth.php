<?php
//Inicie a sessão, sempre no início
session_start();
include "assets/src/cfg.php";

//Recebendo email e senha de index.php
$email = $_POST['email'];
$senha = $_POST['senha'];

//Verifica o email e senha informado se encontram no banco.
$sql = "Select * from usuarios where emailUser = '$email' and passUser = '$senha'";

$result = $con->query($sql);

if ($result->num_rows > 0) {
    //Se houver, retornou um registo
    //Transformo meu resultado em um Array
    while($row = $result->fetch_assoc()) {
        $_SESSION["email"] = $row ['emailUser'];
        header('Location: cad_produto.php');


    }
  }else{
    header('location: login.php');
}
?>