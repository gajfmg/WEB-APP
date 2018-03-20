<?php

require_once 'crud.php';

class repositorio extends crud{
    protected $table = 'T_REPO_PROJ';
    private $ds_repo;
    
    public function setDs_repo($ds_repo) {
        $this->ds_repo = $ds_repo;
      }
   
      public function getDs_repo() {
        return $this->ds_repo;
      }
    
      public function insert(){
          $sql = "insert into $this->table (ds_repo) values (:ds_repo)";
          $stmt = DB::prepare($sql);
          $stmt->bindParam(':ds_repo', $this->ds_repo);
          return $stmt->execute();
      }
      
        public function update($id){
          $sql = "update $this->table set ds_repo = :ds_repo where id=:id";
          $stmt = DB::prepare($sql);
          $stmt->bindParam(':ds_repo', $this->ds_repo);
          $stmt->bindParam(':id', $id);
          return $stmt->execute();
      }
      
}

