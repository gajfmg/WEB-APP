<?php

 require_once ('C:\xampp\htdocs\PhpProject1\Classes\DB.php');

abstract class Crud extends DB{
	protected $table;
        
	abstract public function insert();
	
	

   	public function findAll(){
		$sql  = "SELECT * FROM $this->table";
		$stmt = DB::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function delete($sk_repo_proj){
		$sql  = "DELETE FROM $this->table WHERE SK_REPO_PROJ = :sk_repo_proj";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':sk_repo_proj', $sk_repo_proj, PDO::PARAM_INT);
		return $stmt->execute(); 
	}
}