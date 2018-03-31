<?php

 require_once ('C:\xampp\htdocs\PhpProject1\Classes\Crud.php');


class Repositorio_gerente extends Crud{
    protected $table = 't_repo_proj_grnte';
    private $sk_repo_proj;
    private $sk_grnte_proj;
    
    public function setSk_grnte_proj($sk_grnte_proj) {
        $this->sk_grnte_proj = $sk_grnte_proj;
      }
   
      public function getSk_grnte_proj() {
        return $this->sk_grnte_proj;
      }
      
       public function setSk_repo_proj($ds_repo_proj) {
        $this->sk_repo_proj = $ds_repo_proj;
      }
   
      public function getSk_repo_proj() {
        return $this->sk_repo_proj;
      }
    
      public function insert(){
          $sql = "insert into $this->table values (:sk_repo_proj,:sk_grnte_proj)";
          $stmt = DB::prepare($sql);
          $stmt->bindParam(':sk_repo_proj', $this->sk_repo_proj);
          $stmt->bindParam(':sk_grnte_proj', $this->sk_grnte_proj);
          return $stmt->execute();
         
      }
      
        
      
}