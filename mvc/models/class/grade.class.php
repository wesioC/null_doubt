<?php
class Grade{
    private $fk_Disciplina;
    private $fk_Curso;
    
    public function getFKDisciplina(){
        return $this->fk_Disciplina;
    }
    public function setFKDisciplina($fk_Disciplina){
        $this->fk_Disciplina = $fk_Disciplina;
    }
    public function getFKCurso(){
        return $this->fk_Curso;
    }
    public function setFKCurso($fk_Curso){
        $this->fk_Curso = $fk_Curso;
    }
}