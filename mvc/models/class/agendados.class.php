<?php
class Agendados{
    private $fk_discente;
    private $fk_agendamento;

    public function getFKDiscente(){
        return $this->fk_discente;
    }
    public function setFKDiscente($fk_discente){
        $this->fk_discente = $fk_discente;
    }

    public function getFKAgendamento(){
        return $this->fk_agendamento;
    }
    public function setFKAgendamento($fk_agendamento){
        $this->fk_agendamento = $fk_agendamento;
    }

}