<?php
class Autor{
	private $autor_id;
	private $nome;
	private $email;
	private $dt_nasc;

	function Autor($nome,$email,$dt_nasc){
		$this->nome=$nome;
		$this->email=$email;
		$this->dt_nasc=strtotime(str_replace('/','-',$dt_nasc));
	}
	public function setAutor($autor_id,$nome,$email,$dt_nasc){
		$this->autor_id= $autor_id;
		$this->nome=$nome;
		$this->email=$email;
		$this->dt_nasc=strtotime($dt_nasc);
	}


	 public function getAutor_id() {
            return $this->autor_id;
        }

     public function getNome() {
            return $this->nome;
        }

      public  function getEmail() {
            return $this->email;
        }

        public function getDt_nasc() {
            return $this->dt_nasc;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function setDt_nasc($dt_nasc) {
            $this->dt_nasc = strtotime($dt_nasc);
        }
        public function setAutor_id($autor_id) {
            $this->autor_id = $autor_id;
        }

}
?>
