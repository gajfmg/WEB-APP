<?php

class Conexao
{
      private $servidor_mysql = 'localhost';
      private $nome_banco = 'git_data';
      private $usuario = 'gabriel';
      private $senha = 'Thudor95';
      private $con;

      public function getConexao()
      {
            $this->con = new PDO("mysql:host=$this->servidor_mysql;dbname=$this->nome_banco","$this->usuario","$this->senha");
            return $this->con;
      }
}


?>
