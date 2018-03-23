<?php

 require_once ('C:\xampp\htdocs\PhpProject1\Classes\Crud.php');


class Repositorios extends Crud{
    protected $table = 't_repo_proj';
    private $ds_repo_proj;
    private $sk_repo_proj;
    
    public function setDs_repo_proj($ds_repo_proj) {
        $this->ds_repo_proj = $ds_repo_proj;
      }
   
      public function getDs_repo() {
        return $this->ds_repo_proj;
      }
      
       public function setSk_repo_proj($ds_repo_proj) {
        $this->sk_repo_proj = $ds_repo_proj;
      }
   
      public function getSk_repo_proj() {
        return $this->sk_repo_proj;
      }
    
      public function insert(){
          $sql = "insert into $this->table (sk_repo_proj,ds_repo_proj) values (:sk_repo_proj,:ds_repo_proj)";
          $stmt = DB::prepare($sql);
          $stmt->bindParam(':sk_repo_proj', $this->sk_repo_proj);
          $stmt->bindParam(':ds_repo_proj', $this->ds_repo_proj);
          return $stmt->execute();
         
      }
      
        
      
}

