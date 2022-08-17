<?php

class Super_User{
    private $id_admin;
    private $matricula;
    private $senha;

    public function getIdAdmin(){
        return $this->id_admin;
    }

    public function setIdAdmin($id_admin){
        $this->id_admin = $id_admin;
    }

    public function getMatricula(){
        return $this->matricula;
    }

    public function setMatricula($matricula){
        $this->matricula = $matricula;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    }
}