<?php
class Discente{
    private $matricula;
    private $nome;   
    private $senha;
    private $ativo;
    private $monitor;
    private $fk_curso;

    public function getMatricula(){
        return $this->matricula;
    }

    public function setMatricula($matricula){
        $this->matricula = $matricula;
    }

    public function getAtivo(){
        return $this->ativo;
    }

    public function setAtivo($ativo){
        $this->ativo = $ativo;
    }

    public function getMonitor(){
        return $this->monitor;
    }

    public function setMonitor($monitor){
        $this->monitor = $monitor;
    }


    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    }
    
    public function getFKCurso(){
        return $this->fk_curso;
    }

    public function setFKCurso($fk_curso){
        $this->fk_curso = $fk_curso;
    }  
}
?>