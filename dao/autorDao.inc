<?php
    // AutorDAO será responsável totalmente pela persistência do objeto Autor na tabela Autores,realizando, portanto, o seu mapeamento.
require_once("../dao/conexao.inc");
require_once("../model/autor.inc");

class AutorDao
{

    private $con;
	  public $porPagina;//Este atributo é utilizado para definirmos e armazenarmos o número de resultados que queremos por página

      function AutorDao()
       {
           $c = new Conexao();
           $this->con = $c->getConexao();
           $this->porPagina=10;    //No caso, serão 10 por página
       }

       public function incluirAutor(Autor $autor)
       {
                $sql = $this->con->prepare("insert into autores (nome, email, dt_nasc) values (:nom, :em, :data)");

                $sql->bindValue(':nom', $autor->getNome());
                $sql->bindValue(':em', $autor->getEmail());
                $sql->bindValue(':data', $this->converteDataMysql($autor->getDt_nasc()));
                $sql->execute();
                
 /* Neste método, observe que o SQL é parametrizado e o método utilizado é o bindValue() ao invés do bindParam()
aprendido.o Eles são análogos, porém, o bindParam não permite que se passa outra valor que não seja uma variável, sendo que
objetos, atributos de objetos, expressões, concatenação de strings e outros mais somente é aceito pelo
bindValue(). */

       }
       
       function converteDataMysql($data)
       {
               return date('Y-m-d',$data);
       }


/* responsável por capturar todos os registros de
autores cadastrados no BD. Neste método, após a query de consulta, coloca-se cada objeto Autor recebido (via
FETCH_OBJ) e adiciona-o num array, que será o retorno do método.
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
       
       
       
/*A exclusão será feita via método excluirAutor() que terá como parâmetro o autor_id e excluirá da tabela o
autor correspondente */

       public function excluirAutor($id)
       {
        $sql = $this->con->prepare("delete from autores where autor_id=:id");
        $sql->bindValue(':id',$id);
        $sql->execute();
       }
       
       
       
       
/*Alterar um autor:Serão adicionados 2 métodos para que a alteração seja processada. O método getAutor() que buscará na tabela
um determinado autor, o qual pretende-se altera-lo. O método atualizarAutor() que possui um objeto Autor
como parâmetro e atualizará seus dados na tabela, de acordo com seu ID. Observe que, no momento da
atualização, processa-se a conversão da data que estará no formato dd/mm/yyyy para o formato do MySql
yyyy-mm-aa, como foi feito no método de inserção*/
       
       public function getAutor($id)
       {
        $sql = $this->con->prepare("SELECT * FROM autores where autor_id=:id");
        $sql->bindValue(':id',$id);
        $sql->execute();

        return $sql->fetch(PDO::FETCH_OBJ);
       }
       
       
/*A atualização no BD será feita via método atualizarAutor() que terá como parâmetro o autor_id e excluirá da
tabela o autor correspondente. Observe que a data será formatada novamente para o formato do MySql, tal
como foi feito na inserção*/
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
cálculo é feito tendo como base o número da página em que se está
visualizando que é recebido via parâmetro de URL (index.php?pagina=2 por
exemplo), se tivermos na página 1 deve ser mostrados os resultado de 0 até
10, se tivermos na 2 será mostrado de 10 até 20, então o cálculo para o
resultado de inicio (fica pagina-1) * porPagina.*/
       $init= ($pagina -1) * $this-> porPagina;

/*utilizamos os valores de $porPagina e $init para construir a
consulta SQL utilizando o comando LIMIT e armazenamos os resultados na
variável $result.*/
       $result = $this->con->query("select * from autores limit $init, $this->porPagina");
       
       
/*Criamos um vetor e colocamos nele cada objeto autor, sendo o retorno do método
essa lista, a qual será enviada à página de exibição dos resultados.*/
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
comando LIMIT, que será necessário para construir os links de navegação da
paginação.*/
       $result_total = $this->con->query("SELECT count(*) as total FROM autores")->fetch(PDO::FETCH_OBJ);
       
       
/*calculamos o numero de páginas total que é dado pelo
total de resultados divido por quantos resultados será mostrado por página,
lembrando de se utilizar a função ceil para arredondar o resultado.*/
       $num_paginas = ceil ( $result_total->total / $this->porPagina);
       
       return $num_paginas;
       }
       
       
       //Função para adicionar 100 autores a mais na tabela
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
