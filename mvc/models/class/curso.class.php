<?php
class Curso{
    private $cod_Curso;
    private $ativo;
    private $nome;

    public function getCodCurso(){
        return $this->cod_Curso;
    }

    public function setCodCurso($cod_Curso){
        $this->cod_Curso = $cod_Curso;
    }

    public function getAtivo(){
        return $this->ativo;
    }
    public function setAtivo($ativo){
        $this->ativo = $ativo;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }
}