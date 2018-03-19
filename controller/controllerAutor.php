<?php
require_once('../model/autor.inc');
require_once('../dao/autorDao.inc');

$opcao = (int)$_REQUEST['opcao'];

if($opcao==1)
{
	$autor = new Autor($_REQUEST['pNome'],$_REQUEST['pEmail'],$_REQUEST['pdataNasc']);
/*Cria-se um objeto Autor, através do construtor sem passagem do ID, devido ao fato de que, na tabela Autores, o autor_id
é auto-incrementável.*/

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
	/*captura a lista de autores proveniente de getAutores() e a coloca na sessão, a fim de que a página
exibirAutores.php pegue essa lista na sessão e exiba todos os autores. */
}


/*responsável pelo início da atualização de um
autor. Ele capturará o id passado do autor e usará esse como argumento para o método getAutor() do
AutorDao que buscará o objeto Autor que será atualizado. Este objeto é colocado na sessão e o controlador
reencaminha para a página formAutorAtualizar.php, que será responsável por alterar os dados do Autor
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


/*captura o id passado do autor e usa esse como argumento para o método excluirAutor() do AutorDao. O
controlador reencaminha para a sua opção 2, onde mostra os autores cadastrados, agora sem o autor que se
pretendeu excluir.*/
if($opcao==4)
{
	$id = (int)$_REQUEST['id'];
	$autorDao = new AutorDao();
	$autorDao->excluirAutor($id);
	header("Location:../controller/controllerAutor.php?opcao=2");
}


/*este metodo é responsável pela alteração de um autor
diretamente no BD. Esta opção captura os dados vindos do formulário da página formAutorAtualizar.php e cria
um objeto Autor, setando inclusive o autor_id (via método set, devido ao fato de não termos o construtor
passando todos os parâmetros). Esse objeto será enviado ao método atualizarAutor() do AutorDao e
reencaminhará para a página exibirAutores.php, onde se poderá verificar a atualização feita no registro
especificado.*/
if($opcao==5)
{
	$autor = new Autor($_REQUEST['pNome'],$_REQUEST['pEmail'],$_REQUEST['pdataNasc']);
	$autor->setAutor_id($_REQUEST['pID']);
	$autorDao = new AutorDao();
	$autorDao->atualizarAutor($autor);
	header("Location:../controller/controllerAutor.php?opcao=2");
}

//paginação
if ($opcao==6)
{
//capturamos um parâmetro a mais que é a página de resultados que será mostrada, ou seja, se é a página 2 ou 3 ou 4 e assim por diante.
$pagina = (int)$_REQUEST['pagina'];

$autorDao = new AutorDao();

/*O numero de Paginas é passado como parametro de getAutoresPagincao() para este calcule
qual a pagina inicial que será mostrada. E este é o valor utilizado para calcular o valor de $init no referido metodo */
$lista = $autorDao->getAutoresPaginacao($pagina);
$numpaginas = $autorDao->getPagina();

/*A lista de autores, de acordo com a página indicada, é colocada na sessão */
session_start();
$_SESSION['Autores'] = $lista;

/*encaminha-se para a página exibirAutoresPaginacao.php, onde mostrará os
resultados. Observe que também enviaremos como parâmetro à página o número
de páginas calculado, que será usado para mostrarmos a guia de páginas*/
header("Location:../view/exibirAutoresPaginacao.php?paginas=".$numpaginas);
}

if ($opcao==7)
{
 $autorDao = new AutorDao();
 $autorDao->incluirVariosAutores();
 header("Location:../controller/controllerAutor.php?opcao=6");
}

?>
