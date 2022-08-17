<?php

$path = 'C:\xampp\htdocs\app\last\php\mvc';
require_once $path . '/models/class/matriculas.class.php';
require_once $path . '/models/db/conexao.php';

class DaoMatriculas{
    public function getAllMatriculasDiscentes($id)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT fk_discente FROM `disciplinas_discente` WHERE disciplinas_discente.fk_disciplina = $id";

        $result = $conn->query($sql);

        $matriculas_discentes = null;

        while ($data = $result->fetch_object()) {
            $matriculas_discentes[] = $data;
        }

        return $matriculas_discentes;
    }
}

?>