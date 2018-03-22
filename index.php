


  <?php
  
  
	function __autoload($class_name){
		require_once 'C:\xampp\htdocs\PhpProject1\Classes/' . $class_name . '.php';
	}
?>
            
<!DOCTYPE html>



<html lang="pt-BR" >

<head>
  <meta charset="UTF-8">
  <title>Projeto</title>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

  <link rel="stylesheet" href="View/css/style.css">

  
</head>

<body>

  
<div class="container">
    
        <?php
            $repositorio = new Repositorios();
            
            
            if(isset($_POST['cadastrar'])):
                
          
            $ds_repo_proj = $_POST['txt_repo'];
            
            $repositorio->setDs_repo_proj($ds_repo_proj);
                        
            if ($repositorio->insert()){
                
                echo "inserido com sucesso!";
            }
            
         endif; 
          
        ?>
    

    
    
             <?php
             
		if(isset($_GET['acao']) && $_GET['acao'] == 'deletar'):
			$sk_repo_proj = (int)$_GET['sk_repo_proj'];
			if($repositorio->delete($sk_repo_proj)){
				echo "Deletado com sucesso!";
			}
		endif;
            ?>
    
  <form method="post" action="">
    <div class="row">
      <h4>WEB APP Repositório</h4>
      <div class="input-group input-group-icon">
        <input type="text" name="txt_nome" placeholder="Nome Completo"/>
        <div class="input-icon"><i class="fa fa-user"></i></div>
      </div>
       <h4>Cargo</h4>
      <div class="input-group">
        <input type="radio" name="cargo" value="gerente" id="payment-method-card" checked="true"/>
        <label for="payment-method-card"><span><i class="fa fa-user-plus"></i>Gerente</span></label>
        <input type="radio" name="cargo" value="desenvolvedor" id="payment-method-paypal"/>
        <label for="payment-method-paypal"> <i class="fa fa-user"></i>Desenvolvedor</span></label>
      </div>
       
      <div class="input-group input-group-icon">
        <input type="text" name="txt_repo" placeholder="Nome do Repositório"/>
        <div class="input-icon"><i class="fa fa-archive"></i></div>
      </div>
     
    </div>
    <div class="row">
    
        <h4>Data</h4>
        <div class="input-group">
          <div class="col-third">
            <input type="text" placeholder="DD"/>
          </div>
          <div class="col-third">
            <input type="text" placeholder="MM"/>
          </div>
          <div class="col-third">
            <input type="text" placeholder="AAAA"/>
          </div>
        </div>
    </div>
        <input type="submit" name="cadastrar" class="botao" value="Cadastrar dados">
    </form>
    
   
        <table class="table table-hover">
            <thead>
				<tr>
                                        <th>ID do repositório:</th>
					<th>Nome do repositório:</th>
                                        <th>Ações:</th>
                                </tr>
            </thead>
			
			<?php foreach($repositorio->findAll() as $key => $value): ?>

			<tbody>
				<tr>
					
                                    <td><?php echo $value->sk_repo_proj; ?></td>
                                    <td><?php echo $value->ds_repo_proj; ?></td>
					
					<td>
                                        	<?php echo "<a href='index.php?acao=deletar&sk_repo_proj=" . $value->sk_repo_proj . "' onclick='return confirm(\"Deseja realmente deletar?\")'>Deletar</a>"; ?>
					</td>
				</tr>
			</tbody>

			<?php endforeach; ?>

		</table>

	</div>

  
</div>
  


</body>

</html>
