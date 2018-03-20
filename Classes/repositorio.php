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
    
}

