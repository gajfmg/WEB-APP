<?php
    // AutorDAO ser� respons�vel totalmente pela persist�ncia do objeto Autor na tabela Autores,realizando, portanto, o seu mapeamento.
require_once("../dao/conexao.inc");
require_once("../model/autor.inc");

    $nome = $_POST["nome"];  
      
    $sql = "insert into cliente values('".$nome."')";
    //echo $sql;
      
    if(mysql_query($sql,$con)){
        $msg = "Gravado com sucesso!";
    }else{
        $msg = "Erro ao gravar!";
    }
    mysql_close($con);    
?>
