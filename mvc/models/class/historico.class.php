<?php
class Historico{
    private $presenca;
    private $cod_Historico;
    
    public function getPresenca(){
        return $this->presenca;
    }
    public function setPresenca($presenca){
        $this->presenca = $presenca;
    }

    public function getCodHistorico(){
        return $this->cod_Historico;
    }
    public function setCodHistorico($cod_Historico){
        $this->cod_Historico = $cod_Historico;
    }
}