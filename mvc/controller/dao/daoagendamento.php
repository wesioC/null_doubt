<?php

//use LDAP\Result;

$path = 'C:\xampp\htdocs\app\last\php\mvc';
require_once $path . '/models/class/curso.class.php';
require_once $path . '/models/db/conexao.php';

class DaoAgendamento
{
    public function deleteAgendamentoDocente($cod_agendamento){
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "DELETE FROM agendamento WHERE agendamento.cod_agendamento = " . $cod_agendamento;

        if($conn->query($sql)){
            echo "<script>alert('Atendimento excluído com sucesso!')</script>";
            echo "<script> window.location.href='?p=docente&doc=atendimentos'</script> ";
        }else{
            echo $conn->error;
        }

    }


    public function createAgendamentoDocente($agendamento)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $qntRegistrosNaTabela = 'SELECT MAX(A.cod_agendamento) FROM agendamento A';

        $result = $conn->query($qntRegistrosNaTabela);

        $qnt = $result->fetch_row();

        $sql =
            "INSERT INTO `agendamento` (`horario`, `dia`, `cod_agendamento`, `fk_local`, `fk_docente`, `fk_disciplina`, `ativo`) VALUES (?, ?, ?, ?, ?, ?, 1);";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssiiii', $horario, $dia, $cod_agendamento, $fk_local, $fk_docente, $fk_disciplina);

        $horario = $agendamento->getHorario();
        $dia = $agendamento->getDia();
        $cod_agendamento = $qnt[0]+1;
        $fk_local = $agendamento->getFKLocal();
        $fk_docente = $agendamento->getFKDocente();
        $fk_disciplina = $agendamento->getFKDisciplina();

        //print_r($agendamento);
        //echo '<hr>';


        if($stmt->execute()){
            echo "<script>alert('Atendimento criado com sucesso!')</script>";
            echo "<script> window.location.href='?p=docente&doc=atendimentos'</script> ";
        }else{
            echo $conn->error;
        }
        
    }

    public function readAgendamentosDiscente($matricula)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT DISTINCT A.* FROM disciplina D, disciplinas_discente DD, discente DT, agendamento A where DD.fk_discente = $matricula AND D.ativo = 1 AND D.id = DD.fk_disciplina AND A.fk_disciplina = D.id AND A.ativo = 1 ORDER BY A.dia, A.horario;";
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

        $sql = "SELECT DISTINCT A.* FROM disciplina D, disciplinas_discente DD, discente DT, agendamento A, agendados G where DD.fk_discente = $matricula AND D.ativo = 1 AND D.id = DD.fk_disciplina AND A.fk_disciplina = D.id AND G.fk_agendamento = A.cod_agendamento AND G.fk_discente = $matricula AND A.ativo = 1 ORDER BY A.dia, A.horario;";

        $result = $conn->query($sql);

        $disciplinas = null;

        while ($data = $result->fetch_object()) {
            $disciplinas[] = $data;
        }

        return $disciplinas;
    }

    public function readAllActiveAgendamentosDocente($matricula)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT DISTINCT A.* FROM agendamento A WHERE A.fk_docente = $matricula AND A.ativo = 1 ORDER BY dia";
        $result = $conn->query($sql);

        $disciplinas = null;

        while ($data = $result->fetch_object()) {
            $disciplinas[] = $data;
        }

        return $disciplinas;
    }

    public function readAllInactiveAgendamentosDocente($matricula)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT DISTINCT A.* FROM agendamento A WHERE A.fk_docente = $matricula AND A.ativo = 0";
        $result = $conn->query($sql);

        $disciplinas = null;

        while ($data = $result->fetch_object()) {
            $disciplinas[] = $data;
        }

        return $disciplinas;
    }

    public function alterarStatusAtivoDoAgendamento($cod_agendamento, $ativo)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();
        if ($ativo == 1) {
            $ativo = 0;
        } else {
            $ativo = 1;
        }

        $sql = "UPDATE `agendamento` SET `ativo` = $ativo WHERE `agendamento`.`cod_agendamento` = $cod_agendamento";
        if ($conn->query($sql)) {
            echo "<script>alert('Atendimento reajustado com sucesso!')</script>";
            echo "<script> window.location.href='?p=docente'</script> ";
        } else {
            echo '
                <div class="fixed-top mt-2 mx-5">
                <div class="position-relative col-4">
                <div class="alert alert-danger  position-absolute top-0 start-0 " role="alert">
                Ocorreu um erro ao reajustar o agendamento.
                <br>
                <span class="badge bg-primary">contato: gustavomourago@gmail.com</span>
              </div>
              <a href="/" name="voltar" class="button btn  btn-outline-primary d-block w-100 mt-3">Voltar</a>
            </div>
              </div>
              </div>';
        }
    }
    public function delete($cod_agendamento)
    {
        $con = new Conexao();

        $con = $con->getConnection();

        $sql = "DELETE FROM `agendamento` WHERE `agendamento`.`cod_agendamento` = $cod_agendamento";

        if ($con->query($sql)) {
            echo "<script> window.location.href='?p=docente&doc=atendimentos'</script> ";
        }
    }

    public function getAgendamentoObj($cod_agendamento)
    {
        $conexao = new Conexao();
        $conn = $conexao->getConnection();

        $sql = "SELECT * FROM agendamento WHERE cod_agendamento = " . $cod_agendamento;

        $result = $conn->query($sql);
        //echo $result;
        if ($result->num_rows == 1) {
            
            $row = $result->fetch_object();
          //$row = $result->fetch_assoc();     ANTES


            $conn->close();

            return $row;
        } else {
            echo $conn->error;
        }
    }
    
}
