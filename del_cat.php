<?php

//Arquivo de Configuração com o Banco de Dados
include "assets/src/cfg.php";

$id = $_GET["id"];

    $delCat = "delete from categorias where id = ".$id;

    if(mysqli_query($con,$delCat)){
        $msg = "Deletado com sucesso!";
    }else{
        $msg = "Erro ao deletar!";
    }

    header("Location: http://localhost:8080/lojasenac/cad_categoria.php");
    ?>