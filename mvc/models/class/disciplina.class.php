<?php

class Disciplina{
    private $id;
    private $nome;   
    private $cod_disciplina;    
    private $periodo;
    private $data_de_encerramento;
    private $ativo;
    private $fk_docente;
    private $monitor;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getCodDisciplina(){
        return $this->cod_disciplina;
    }

    public function setCodDisciplina($cod_disciplina){
        $this->cod_disciplina = $cod_disciplina;
    }

    public function getPeriodo(){
        return $this->periodo;
    }

    public function setPeriodo($periodo){
        $this->periodo = $periodo;
    }

    public function getDataDeEncerramento(){
        return $this->data_de_encerramento;
    }

    public function setDataDeEncerramento($data_de_encerramento){
        $this->data_de_encerramento = $data_de_encerramento;
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

    public function getFKDocente(){
        return $this->fk_docente;
    }

    public function setFKDocente($fk_docente){
        $this->fk_docente = $fk_docente;
    }
}
?>