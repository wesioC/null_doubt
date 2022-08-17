<?php

$path = 'C:\xampp\htdocs\app\last\php\mvc';
require_once $path . '/models/class/monitoria.class.php';
require_once $path . '/models/db/conexao.php';

class DaoMonitoria
{
    public function createMonitoria($monitoria)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $qntRegistrosNaTabela = 'SELECT MAX(M.cod_monitoria) FROM monitoria M';

        $result = $conn->query($qntRegistrosNaTabela);

        $qnt = $result->fetch_row();

        $sql =
            "INSERT INTO `monitoria` (`horario`, `dia`, `cod_monitoria`, `fk_local`, `fk_discente`, `fk_disciplina`, `ativo`) VALUES (?, ?, ?, ?, ?, ?, 1);";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssiiii', $horario, $dia, $cod_monitoria, $fk_local, $fk_discente, $fk_disciplina);

        $horario = $monitoria->getHorario();
        $dia = $monitoria->getDia();
        $cod_monitoria = $qnt[0]+1;
        $fk_local = $monitoria->getFKLocal();
        $fk_discente = $monitoria->getFKDiscente();
        $fk_disciplina = $monitoria->getFKDisciplina();


        if($stmt->execute()){
            echo "<script> window.location.href='?p=docente&doc=horarios-monitor&matricula=' 
            . $fk_discente .'&id='. $fk_disciplina .''</script> ";
        }else{
            echo $conn->error;
        }
        
    }

    public function delete($cod_monitoria)
    {
        $con = new Conexao();

        $con = $con->getConnection();
        $dao = new DaoMonitoria();
        $monitoria_obj = $dao->getMonitoriaObj($cod_monitoria);
        $sql = "DELETE FROM `monitoria` WHERE `monitoria`.`cod_monitoria` = $cod_monitoria";
        $matricula = $monitoria_obj->fk_discente;
        $id = $monitoria_obj->fk_disciplina;
        //echo $matricula;
        if($con->query($sql)){
            echo '<script> window.location.href="index.php?p=docente&doc=horarios-monitor&matricula='.$matricula.'&id='.$id.'"</script> ';
        }else{
            echo $con->error;
        }
    }

    public function desativaMonitor($matricula)
    {
        $con = new Conexao();

        $con = $con->getConnection();
 
        $sql = "DELETE FROM `monitoria` WHERE `monitoria`.`fk_discente` = $matricula";

        if($con->query($sql)){
            echo "<script> window.location.href='?p=docente&doc=monitores'</script> ";
        }else{
            echo $con->error;
        }
    }

    public function readAgendamentosDiscente($matricula)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT DISTINCT M.* FROM disciplina D, disciplinas_discente DD, discente DT, monitoria M where DD.fk_discente = $matricula AND D.ativo = 1 AND D.id = DD.fk_disciplina AND M.fk_disciplina = D.id ORDER BY M.dia, M.horario;";
        //$sql = "SELECT DISTINCT A.* FROM disciplina D, disciplinas_discente DD, discente DT, agendamento A, agendados G where DD.fk_discente = $matricula AND D.ativo = 1 AND D.id = DD.fk_disciplina AND A.fk_disciplina = D.id AND G.fk_agendamento != A.cod_agendamento;";
        $result = $conn->query($sql);

        $disciplinas = null;

        while ($data = $result->fetch_object()) {
            $disciplinas[] = $data;
        }

        return $disciplinas;
    }

    public function readAgendasDiscente($matricula)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT DISTINCT M.* FROM disciplina D, disciplinas_discente DD, discente DT, monitoria M, agendados_monitoria AM where DD.fk_discente = $matricula AND D.ativo = 1 AND D.id = DD.fk_disciplina AND M.fk_disciplina = D.id AND AM.fk_monitoria = M.cod_monitoria AND AM.fk_discente = $matricula ORDER BY M.dia, M.horario;";

        $result = $conn->query($sql);

        $disciplinas = null;

        while ($data = $result->fetch_object()) {
            $disciplinas[] = $data;
        }

        return $disciplinas;
    }

    public function readAllFromMonitor($matricula)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();
        //echo $matricula;
        $sql = "SELECT DISTINCT M.* FROM monitoria M WHERE M.fk_discente = $matricula ORDER BY dia";
        $result = $conn->query($sql);

        $monitorias = null;

        while ($data = $result->fetch_object()) {
            $monitorias[] = $data;
        }

        return $monitorias;
    }

    public function getMonitoriaObj($cod_monitoria)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT * FROM monitoria WHERE cod_monitoria = " . $cod_monitoria;

        $result = $conn->query($sql);
        //echo $result;
        if ($result->num_rows == 1) {            
            $row = $result->fetch_object();
            $conn->close();
            return $row;
        } else {
            echo $conn->error;
        }
    }
    
}
