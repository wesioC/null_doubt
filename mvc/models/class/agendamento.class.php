<?php
class Agendamento{
    private $horario;
    private $dia;
private $cod_Agendamento;
private $fk_Local;
private $fk_Historico;
private $fk_Discente;
private $fk_Docente;
private $fk_Disciplina;
private $fk_Monitor;
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


public function getCodAgendamento(){
    return $this->cod_Agendamento;
}

public function setCodAgendamento($cod_Agendamento){
    $this->cod_Agendamento = $cod_Agendamento;
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