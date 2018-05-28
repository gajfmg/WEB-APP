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
      <link rel="stylesheet" type="text/css" href="View/css/style.css">
   </head>
   <body>
      <div class="container">
         <?php
            $repositorio = new Repositorios();
            $gerente = new Gerentes();
            $desenvolvedor = new Desenvolvedores();
            $repo_grnte = new Repositorio_gerente();
            
               if(isset($_POST['cadastrar'])):
                   
                   $cargo=$_POST['cargo'];
              
               
                  if($cargo=='desenvolvedor'){
                      
                     
                       
                       $sk_desenv = $_POST['txt_codigo_pessoal'];
                       $nm_desenv = $_POST['txt_nome'];
                       
                       $sk_repo_proj = $_POST['txt_sk_repo_proj'];
                       $ds_repo_proj = $_POST['txt_repo'];
               
               
                       $desenvolvedor->setNm_desenv($nm_desenv);
                       $desenvolvedor->setSk_desenv($sk_desenv);
                
                       $repositorio->setSk_repo_proj($sk_repo_proj);
                       $repositorio->setDs_repo_proj($ds_repo_proj);
                       
                       $repositorio->insert();
                       $desenvolvedor->insert();
                  
                  } 
                  if($cargo=='gerente') {
                      
                       
                       $sk_grnte_proj = $_POST['txt_codigo_pessoal'];
                       $nm_grnte_proj = $_POST['txt_nome'];
                       
                       $sk_repo_proj = $_POST['txt_sk_repo_proj'];
                       $ds_repo_proj = $_POST['txt_repo'];
               
               
                       $gerente->setNm_grnte_proj($nm_grnte_proj);
                       $gerente->setSk_grnte_proj($sk_grnte_proj);
                
                       $repositorio->setSk_repo_proj($sk_repo_proj);
                       $repositorio->setDs_repo_proj($ds_repo_proj);
                       
                       $repo_grnte->setSk_repo_proj($sk_repo_proj);
                       $repo_grnte->setSk_grnte_proj($sk_grnte_proj);
                      
                       $repositorio->insert();
                       $gerente->insert();
                       $repo_grnte->insert();
                       
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
               <h4>Controle WEB</h4>
               <div class="input-group input-group-icon">
                  <input type="text" name="txt_nome" placeholder="Nome Completo"/>
                  <div class="input-icon"><i class="fa fa-user"></i></div>
               </div>
               <div class="input-group input-group-icon">
                  <input type="text" name="txt_codigo_pessoal" placeholder="Código Pessoal"/>
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
                  <input type="text" name="txt_sk_repo_proj" placeholder="ID do Repositório"/>
                  <div class="input-icon"><i class="fab fa-slack"></i></div>
               </div>
               <div class="input-group input-group-icon">
                  <input type="text" name="txt_repo" placeholder="Nome do Repositório"/>
                  <div class="input-icon"><i class="fa fa-archive"></i></div>
               </div>
            </div>
            <input type="submit" name="cadastrar" class="botao" value="Cadastrar dados">
         </form>
         <table class="table table-hover">
            <thead>
               <tr>
                  <th>ID do repositório</th>
                  <th>Nome do repositório</th>
              <!--    <th>Ações:</th> -->
               </tr>
            </thead>
            <?php foreach($repositorio->findAll() as $key => $value): ?>
            <tbody>
               <tr>
                  <td><?php echo $value->sk_repo_proj; ?></td>
                  <td><?php echo $value->ds_repo_proj; ?></td>
                  <td>
                     <?php //echo "<a href='index.php?acao=deletar&sk_repo_proj=" . $value->sk_repo_proj . "' onclick='return confirm(\"Deseja realmente deletar?\")'>Deletar</a>"; ?>
                  </td>
               </tr>
             
            </tbody>
            <?php endforeach; ?>
                     
         </table>
          <div class="input-group">
           <a class="links" href="https://app.powerbi.com/view?r=eyJrIjoiNzQ5OGUyMDYtMTU3OS00MzZkLWIyZTItNThkYmYwNDFjMzUyIiwidCI6IjEwNGZhNGI4LTg1MmYtNDBiZC1hZTkwLTdhNWIzMGRiOWFlNSJ9
            " target="_blank">DashBoard</a><br>
          </div>
    
              

      </div>
    
      </div>
   </body>
</html>