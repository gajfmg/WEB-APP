<?php
require_once('../model/autor.inc');
require_once('../dao/autorDao.inc');

$opcao = (int)$_REQUEST['opcao'];

if($opcao==1)
{
	$autor = new Autor($_REQUEST['pNome'],$_REQUEST['pEmail'],$_REQUEST['pdataNasc']);
/*Cria-se um objeto Autor, atrav�s do construtor sem passagem do ID, devido ao fato de que, na tabela Autores, o autor_id
� auto-increment�vel.*/

	$autorDao = new AutorDao();
	$autorDao->incluirAutor($autor);
	header("Location:../controller/controllerAutor.php?opcao=2");
}
if($opcao==2)
{
	$autorDao=new AutorDao();
	$lista=$autorDao->getAutores();
	session_start();
	$_SESSION['autores']=$lista;
	header("Location:../view/exibirAutores.php");
	/*captura a lista de autores proveniente de getAutores() e a coloca na sess�o, a fim de que a p�gina
exibirAutores.php pegue essa lista na sess�o e exiba todos os autores. */
}


/*respons�vel pelo in�cio da atualiza��o de um
autor. Ele capturar� o id passado do autor e usar� esse como argumento para o m�todo getAutor() do
AutorDao que buscar� o objeto Autor que ser� atualizado. Este objeto � colocado na sess�o e o controlador
reencaminha para a p�gina formAutorAtualizar.php, que ser� respons�vel por alterar os dados do Autor
buscado.*/
if($opcao==3)
{
	$id=(int)$_REQUEST['id'];
	$autorDao=new AutorDao();
	$autor=$autorDao->getAutor($id);
	session_start();
	$_SESSION['autor']=$autor;
	header("Location:../view/formAutorAtualizar.php");
}


/*captura o id passado do autor e usa esse como argumento para o m�todo excluirAutor() do AutorDao. O
controlador reencaminha para a sua op��o 2, onde mostra os autores cadastrados, agora sem o autor que se
pretendeu excluir.*/
if($opcao==4)
{
	$id = (int)$_REQUEST['id'];
	$autorDao = new AutorDao();
	$autorDao->excluirAutor($id);
	header("Location:../controller/controllerAutor.php?opcao=2");
}


/*este metodo � respons�vel pela altera��o de um autor
diretamente no BD. Esta op��o captura os dados vindos do formul�rio da p�gina formAutorAtualizar.php e cria
um objeto Autor, setando inclusive o autor_id (via m�todo set, devido ao fato de n�o termos o construtor
passando todos os par�metros). Esse objeto ser� enviado ao m�todo atualizarAutor() do AutorDao e
reencaminhar� para a p�gina exibirAutores.php, onde se poder� verificar a atualiza��o feita no registro
especificado.*/
if($opcao==5)
{
	$autor = new Autor($_REQUEST['pNome'],$_REQUEST['pEmail'],$_REQUEST['pdataNasc']);
	$autor->setAutor_id($_REQUEST['pID']);
	$autorDao = new AutorDao();
	$autorDao->atualizarAutor($autor);
	header("Location:../controller/controllerAutor.php?opcao=2");
}

//pagina��o
if ($opcao==6)
{
//capturamos um par�metro a mais que � a p�gina de resultados que ser� mostrada, ou seja, se � a p�gina 2 ou 3 ou 4 e assim por diante.
$pagina = (int)$_REQUEST['pagina'];

$autorDao = new AutorDao();

/*O numero de Paginas � passado como parametro de getAutoresPagincao() para este calcule
qual a pagina inicial que ser� mostrada. E este � o valor utilizado para calcular o valor de $init no referido metodo */
$lista = $autorDao->getAutoresPaginacao($pagina);
$numpaginas = $autorDao->getPagina();

/*A lista de autores, de acordo com a p�gina indicada, � colocada na sess�o */
session_start();
$_SESSION['Autores'] = $lista;

/*encaminha-se para a p�gina exibirAutoresPaginacao.php, onde mostrar� os
resultados. Observe que tamb�m enviaremos como par�metro � p�gina o n�mero
de p�ginas calculado, que ser� usado para mostrarmos a guia de p�ginas*/
header("Location:../view/exibirAutoresPaginacao.php?paginas=".$numpaginas);
}

if ($opcao==7)
{
 $autorDao = new AutorDao();
 $autorDao->incluirVariosAutores();
 header("Location:../controller/controllerAutor.php?opcao=6");
}

?>
