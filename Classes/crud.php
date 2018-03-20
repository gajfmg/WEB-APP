<?php

require_once 'DB.php';
abstract class crud extends DB{
    
    protected $table;   
    abstract public function insert();
    abstract public function update($id); 
      
    //encontrar por id
    public function find($id){
        $sql = "SELECT * FROM  $this->table where id = id";
        $stmt = DB::prepare(sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
        
    }
    //encontrar tudo
    public function findAll(){
     $sql = "select *from $this->table";   
     $stmt = DB::prepare(sql);
     $stmt->execute();
     return $stmt->fetchAll();
    }
    
    //delete
     public function delete($id){
     $sql = "delete *from $this->table where id = :id";   
     $stmt = DB::prepare(sql);
     $stmt->execute();
     return $stmt->fetchAll();
    }
    
}
