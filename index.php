<!DOCTYPE html>
<?php
function __autoload($class_name){
    require_once 'Classes/' . $class_name . '.php';
}

require_once 'classes/repositorio.php';
?>
<html lang="en" >

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
            $repositorio = new repositorio();
            
            
            if(isset($_POST['cadastrar'])):
                
          
            $ds_repo = $_POST['txt_repo'];
            
            $repositorio->setDs_repo($ds_repo);
            $repositorio->insert();
            
            
            endif; 
          
        ?>
    
  <form method="post" action="">
    <div class="row">
      <h4>WEB APP Repositório</h4>
      <div class="input-group input-group-icon">
        <input type="text" placeholder="Nome Completo"/>
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
        <a <input type="submit" class="botao" value="Cadastrar dados">Cadastrar</a>

    </div>
  
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

  <script  src="View/js/index.js"></script>



</body>

</html>
