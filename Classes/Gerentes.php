
<?php

 require_once ('C:\xampp\htdocs\PhpProject1\Classes\Crud.php');


class Gerentes extends Crud{
    protected $table = 't_grnte_proj';
    private $nm_grnte_proj;
    private $sk_grnte_proj;
    
    public function setNm_grnte_proj($nm_grnte_proj) {
        $this->nm_grnte_proj = $nm_grnte_proj;
      }
   
      public function getNm_grnte_proj() {
        return $this->nm_grnte_proj;
      }
      
      public function setSk_grnte_proj($sk_grnte_proj) {
        $this->sk_grnte_proj = $sk_grnte_proj;
      }
   
      public function getSk_grnte_proj() {
        return $this->sk_grnte_proj;
      }
    
      public function insert(){
          $sql = "insert into $this->table (sk_grnte_proj,nm_grnte_proj) values (:sk_grnte_proj,:nm_grnte_proj)";
          $stmt = DB::prepare($sql);
          $stmt->bindParam(':sk_grnte_proj', $this->sk_grnte_proj);
          $stmt->bindParam(':nm_grnte_proj', $this->nm_grnte_proj);
          return $stmt->execute();
         
      }
}   