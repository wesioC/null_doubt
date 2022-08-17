<?php
class Local{
    private $departamento;
    private $sala;
    private $cod_Local;
    private $ativo;

    public function getDepartamento(){
        return $this->departamento;
    }

    public function setDepartamento($departamento){
        $this->departamento = $departamento;
    }

    public function getSala(){
        return $this->sala;
    }
    public function setSala($sala){
        $this->sala = $sala;
    }

    public function getCodLocal(){
        return $this->cod_Local;
    }

    public function setCodLocal($cod_Local){
        $this->cod_Local = $cod_Local;
    }

    public function getAtivo(){
        return $this->ativo;
    }
    public function setAtivo($ativo){
        $this->ativo = $ativo;
    }
}