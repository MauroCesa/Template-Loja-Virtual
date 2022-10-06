<?php

//Arquivo de Configuração com o Banco de Dados
include "assets/src/cfg.php";

$id = $_GET["id"];

    $delProd = "delete from produtos where id = ".$id;

    if(mysqli_query($con,$delProd)){
        $msg = "Deletado com sucesso!";
    }else{
        $msg = "Erro ao deletar!";
    }

    header("Location: http://localhost:8080/lojasenac/cad_produto.php");
    ?>