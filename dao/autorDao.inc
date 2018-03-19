<?php
    // AutorDAO ser� respons�vel totalmente pela persist�ncia do objeto Autor na tabela Autores,realizando, portanto, o seu mapeamento.
require_once("../dao/conexao.inc");
require_once("../model/autor.inc");

class AutorDao
{

    private $con;
	  public $porPagina;//Este atributo � utilizado para definirmos e armazenarmos o n�mero de resultados que queremos por p�gina

      function AutorDao()
       {
           $c = new Conexao();
           $this->con = $c->getConexao();
           $this->porPagina=10;    //No caso, ser�o 10 por p�gina
       }

       public function incluirAutor(Autor $autor)
       {
                $sql = $this->con->prepare("insert into autores (nome, email, dt_nasc) values (:nom, :em, :data)");

                $sql->bindValue(':nom', $autor->getNome());
                $sql->bindValue(':em', $autor->getEmail());
                $sql->bindValue(':data', $this->converteDataMysql($autor->getDt_nasc()));
                $sql->execute();
                
 /* Neste m�todo, observe que o SQL � parametrizado e o m�todo utilizado � o bindValue() ao inv�s do bindParam()
aprendido.o Eles s�o an�logos, por�m, o bindParam n�o permite que se passa outra valor que n�o seja uma vari�vel, sendo que
objetos, atributos de objetos, express�es, concatena��o de strings e outros mais somente � aceito pelo
bindValue(). */

       }
       
       function converteDataMysql($data)
       {
               return date('Y-m-d',$data);
       }


/* respons�vel por capturar todos os registros de
autores cadastrados no BD. Neste m�todo, ap�s a query de consulta, coloca-se cada objeto Autor recebido (via
FETCH_OBJ) e adiciona-o num array, que ser� o retorno do m�todo.
public function getAutores()     */

       public function getAutores()
       {
          $rs = $this->con->query("SELECT*FROM autores");
          $lista = array();
          while($autor=$rs->fetch(PDO::FETCH_OBJ))
          {
            $lista[]=$autor;
          }
          return $lista;
       }
       
       
       
/*A exclus�o ser� feita via m�todo excluirAutor() que ter� como par�metro o autor_id e excluir� da tabela o
autor correspondente */

       public function excluirAutor($id)
       {
        $sql = $this->con->prepare("delete from autores where autor_id=:id");
        $sql->bindValue(':id',$id);
        $sql->execute();
       }
       
       
       
       
/*Alterar um autor:Ser�o adicionados 2 m�todos para que a altera��o seja processada. O m�todo getAutor() que buscar� na tabela
um determinado autor, o qual pretende-se altera-lo. O m�todo atualizarAutor() que possui um objeto Autor
como par�metro e atualizar� seus dados na tabela, de acordo com seu ID. Observe que, no momento da
atualiza��o, processa-se a convers�o da data que estar� no formato dd/mm/yyyy para o formato do MySql
yyyy-mm-aa, como foi feito no m�todo de inser��o*/
       
       public function getAutor($id)
       {
        $sql = $this->con->prepare("SELECT * FROM autores where autor_id=:id");
        $sql->bindValue(':id',$id);
        $sql->execute();

        return $sql->fetch(PDO::FETCH_OBJ);
       }
       
       
/*A atualiza��o no BD ser� feita via m�todo atualizarAutor() que ter� como par�metro o autor_id e excluir� da
tabela o autor correspondente. Observe que a data ser� formatada novamente para o formato do MySql, tal
como foi feito na inser��o*/
       public function atualizarAutor(Autor $autor){
        $sql = $this->con->prepare("update autores set nome=:nom, email=:em, dt_nasc=:data where autor_id=:id");
                $sql->bindValue(':nom', $autor->getNome());
                $sql->bindValue(':em', $autor->getEmail());
                $sql->bindValue(':data', $this->converteDataMysql($autor->getDt_nasc()));
                $sql->bindValue(':id', $autor->getAutor_id());
                $sql->execute();
       }

       public function getAutoresPaginacao($pagina)
       {
/*calculamos a partir de qual resultado deve ser mostrado. Esse
c�lculo � feito tendo como base o n�mero da p�gina em que se est�
visualizando que � recebido via par�metro de URL (index.php?pagina=2 por
exemplo), se tivermos na p�gina 1 deve ser mostrados os resultado de 0 at�
10, se tivermos na 2 ser� mostrado de 10 at� 20, ent�o o c�lculo para o
resultado de inicio (fica pagina-1) * porPagina.*/
       $init= ($pagina -1) * $this-> porPagina;

/*utilizamos os valores de $porPagina e $init para construir a
consulta SQL utilizando o comando LIMIT e armazenamos os resultados na
vari�vel $result.*/
       $result = $this->con->query("select * from autores limit $init, $this->porPagina");
       
       
/*Criamos um vetor e colocamos nele cada objeto autor, sendo o retorno do m�todo
essa lista, a qual ser� enviada � p�gina de exibi��o dos resultados.*/
       $lista = array();
       while($row = $result->fetch(PDO::FETCH_OBJ))
       {
           $lista[] = $row;
       }
          return $lista;

       }
       
       public function getPagina()
       {
/*consultamos o total de resultados da consulta sem o
comando LIMIT, que ser� necess�rio para construir os links de navega��o da
pagina��o.*/
       $result_total = $this->con->query("SELECT count(*) as total FROM autores")->fetch(PDO::FETCH_OBJ);
       
       
/*calculamos o numero de p�ginas total que � dado pelo
total de resultados divido por quantos resultados ser� mostrado por p�gina,
lembrando de se utilizar a fun��o ceil para arredondar o resultado.*/
       $num_paginas = ceil ( $result_total->total / $this->porPagina);
       
       return $num_paginas;
       }
       
       
       //Fun��o para adicionar 100 autores a mais na tabela
       public function incluirVariosAutores()
       {
        for($i=1;$i<=100;$i++)
        {

         $sql = $this->con->prepare("insert into autores (nome, email, dt_nasc) values (:nom, :em, :data)");
         $sql->bindValue(':nom', 'nome '.$i);
         $sql->bindValue(':em', 'email'.$i.'@Gabriel.com.br');
         $sql->bindValue(':data','2100-12-29');
         $sql->execute();
       }
      }
       
       
       
       
       
}


?>