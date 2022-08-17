<?php
class Monitoria{
    private $horario;
    private $dia;
private $cod_Monitoria;
private $fk_Local;
private $fk_Historico;
private $fk_Discente;
private $fk_Disciplina;
private $ativo;

public function setAtivo($ativo){
    $this->ativo = $ativo;
}

public function getAtivo(){
    return $this->ativo;
}

public function getHorario(){
    return $this->horario;
}

public function setHorario($horario){
    $this->horario = $horario;
}

public function getDia(){
    return $this->dia;
}

public function setDia($dia){
    $this->dia = $dia;
}


public function getCodMonitoria(){
    return $this->cod_Monitoria;
}

public function setCodMonitoria($cod_Monitoria){
    $this->cod_Monitoria = $cod_Monitoria;
}

public function getFKLocal(){
    return $this->fk_Local;
}

public function setFKLocal($fk_Local){
    $this->fk_Local = $fk_Local;
}

public function getFKHistorico(){
    return $this->fk_Historico;
}

public function setFKHistorico($fk_Historico){
    $this->fk_Historico = $fk_Historico;
}

public function getFKDiscente(){
    return $this->fk_Discente;
}

public function setFKDiscente($fk_Discente){
    $this->fk_Discente = $fk_Discente;
}

public function getFKDocente(){
    return $this->fk_Docente;
}

public function setFKDocente($fk_Docente){
    $this->fk_Docente = $fk_Docente;
}
public function getFKDisciplina(){
    return $this->fk_Disciplina;
}

public function setFKDisciplina($fk_Disciplina){
    $this->fk_Disciplina = $fk_Disciplina;
}

public function getFKMonitor(){
    return $this->fk_Monitor;
}

public function setFKMonitor($fk_Monitor){
    $this->fk_Monitor = $fk_Monitor;
}

}