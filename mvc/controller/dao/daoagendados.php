<?php
$path = 'C:\xampp\htdocs\app\last\php\mvc';
require_once $path . '/models/class/agendados.class.php';
require_once $path . '/models/db/conexao.php';

class DaoAgendados
{
    public function createAgenda($agendados)
    {
        $con = new Conexao();

        $con = $con->getConnection();

        $sql = "INSERT INTO agendados(fk_discente, fk_agendamento, concluido) VALUES(?,?,?);";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssi", $fk_discente, $fk_agendamento, $concluido);

        $fk_discente = $agendados->getFKDiscente();
        $fk_agendamento = $agendados->getFKAgendamento();
        $concluido = 0;
        

        $stmt->execute();
        echo "<script> window.location.href='?p=discente'</script> ";
    }

    public function discentesAgendados($cod_agendamento){
        //SELECT DISTINCT D.nome , D.fk_curso FROM discente D, agendamento AG , agendados A WHERE D.matricula = A.fk_discente AND A.fk_agendamento=2 ORDER BY D.nome, D.fk_curso;
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT DISTINCT D.matricula, D.nome , D.fk_curso FROM discente D, agendamento AG , agendados A WHERE D.matricula = A.fk_discente AND A.fk_agendamento=$cod_agendamento AND D.ativo = 1 ORDER BY D.nome, D.fk_curso;";
        $result = $conn->query($sql);

        $Discagendados = null;

        while ($data = $result->fetch_object()) {
            $Discagendados[] = $data;
        }

        return $Discagendados;
    }
    
    public function deleteAgenda($agendados)
    {
        $con = new Conexao();

        $con = $con->getConnection();

        $fk_discente = $agendados->getFKDiscente();
        $fk_agendamento = $agendados->getFKAgendamento();

        $sql = "DELETE FROM `agendados` WHERE `agendados`.`fk_discente` = $fk_discente AND `agendados`.`fk_agendamento` = $fk_agendamento";

        if ($con->query($sql)) {
            echo "<script> window.location.href='?p=discente'</script> ";
        }
    }

    public function countDiscentesAgendados($fk_agendamento)
    {
        $con = new Conexao();

        $con = $con->getConnection();

        $sql = "SELECT count(*) AS contagem FROM agendados WHERE fk_agendamento = $fk_agendamento;";

        $result = $con->query($sql);

        $cont = $result->fetch_object();

        return $cont->contagem;
    }

    public function finalizar($fk_agendamento){
        $con = new Conexao();
        $con = $con->getConnection();
        //$sql = "UPDATE `agendados` SET `concluido`='1' WHERE fk_agendamento = $fk_agendamento;";
        $sql = "DELETE FROM `agendados` WHERE fk_agendamento = $fk_agendamento;";
        $con->query($sql);

        if ($con->query($sql)) {
            echo "<script> window.location.href='?p=docente'</script>";
        }
    }
}
