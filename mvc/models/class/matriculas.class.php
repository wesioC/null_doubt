<?php
class Matricula{
    private $fk_Disciplina;
    private $fk_Discente;

    public function getFKDisciplina(){
        return $this->fk_Disciplina;
    }
    public function setFKDisciplina($fk_Disciplina){
        $this->fk_Disciplina = $fk_Disciplina;
    }

    public function getFKDiscente(){
        return $this->fk_Discente;
    }
    public function setFKDiscente($fk_Discente){
        $this->fk_Discente = $fk_Discente;
    }

}