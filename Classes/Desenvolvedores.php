
<?php

 require_once ('C:\xampp\htdocs\PhpProject1\Classes\Crud.php');


class Desenvolvedores extends Crud{
    protected $table = 't_desenv';
    private $nm_desenv;
    private $sk_desenv;
    
    public function setNm_desenv($nm_desenv) {
        $this->nm_desenv = $nm_desenv;
      }
   
      public function getNm_desenv() {
        return $this->nm_desenv;
      }
      
      public function setSk_desenv($sk_desenv) {
        $this->sk_desenv = $sk_desenv;
      }
   
      public function getSk_desenv() {
        return $this->sk_desenv;
      }
    
      public function insert(){
          $sql = "insert into $this->table (sk_desenv,nm_desenv) values (:sk_desenv,:nm_desenv)";
          $stmt = DB::prepare($sql);
          $stmt->bindParam(':nm_desenv', $this->nm_desenv);
          $stmt->bindParam(':sk_desenv', $this->sk_desenv);
          return $stmt->execute();
         
      }
}   