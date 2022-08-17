<?php
class AgendadosMonitoria{
    private $fk_discente;
    private $fk_monitoria;

    public function getFKDiscente(){
        return $this->fk_discente;
    }
    public function setFKDiscente($fk_discente){
        $this->fk_discente = $fk_discente;
    }

    public function getFKMonitoria(){
        return $this->fk_monitoria;
    }
    public function setFKMonitoria($fk_monitoria){
        $this->fk_monitoria = $fk_monitoria;
    }

}