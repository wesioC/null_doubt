<?php
function descobrirDia($dia)
{
    // echo $dia;
    switch ($dia) {
        case 1:
            $diaFormatado = 'Segunda';
            break;
        case 2:
            $diaFormatado = 'Terça';
            break;
        case 3:
            $diaFormatado = 'Quarta';
            break;
        case 4:
            $diaFormatado = 'Quinta';
            break;
        case 5:
            $diaFormatado = 'Sexta';
            break;
        case 6:
            $diaFormatado = 'Sábado';
            break;
    }

    return $diaFormatado;
}


function alternaStatusAgendamento()
{
    $fk_agendamento = $_GET['fk_agendamento'];
    $ativo = $_GET['ativo'];
    $dao = new DaoAgendamento();

    $dao->alterarStatusAtivoDoAgendamento($fk_agendamento, $ativo);
}

function createAgendamentoDocente()
{
    $agendamento = new Agendamento();

    $agendamento->setHorario($_POST['horario']);
    $agendamento->setDia($_POST['dia']);
    $agendamento->setFKLocal($_POST['locais']);
    $agendamento->setFKDocente($_SESSION['docente']);
    $agendamento->setFKDisciplina($_POST['disciplinas']);

    $daoAgendamentos = new DaoAgendamento();

    $daoAgendamentos->createAgendamentoDocente($agendamento);
}

function createMonitoria($matricula, $id)
{
    $monitoria = new Monitoria();

    $monitoria->setHorario($_POST['horario']);
    $monitoria->setDia($_POST['dia']);
    $monitoria->setFKLocal($_POST['locais']);
    $monitoria->setFKDiscente($matricula);
    $monitoria->setFKDisciplina($id);

    $daomonitoria = new DaoMonitoria();

    $daomonitoria->createMonitoria($monitoria);
}

function ativaMonitor()
{
    $matricula = $_POST['matricula_discente'];

    $dao = new DaoDiscente();
    $discente = $dao->getDiscenteObj($matricula);
    if ($discente->monitor == 0) {
        $dao->ativarMonitor($matricula);

        $id = $_POST['disciplinas'];
        $dao = new DaoDisciplina();
        $dao->ativarMonitor($matricula, $id);
        echo "<script>alert('Promoção do discente realizada com sucesso!')</script>";
    }
    else {
        echo "<script>alert('O discente já é monitor')</script>";
        
    }
    
}

function desativaMonitor($matricula, $id)
{
    $dao = new DaoDiscente();
    $dao->desativarMonitor($matricula);

    $dao = new DaoDisciplina();
    $dao->desativarMonitor($matricula, $id);

    $dao = new DaoMonitoria();
    $dao->desativaMonitor($matricula);
}

function editarAgendamentoDocente($cod_atendimento)
{
}

function excluirAgendamentoDocente($cod_atendimento)
{
    $agendamento = new DaoAgendamento();
    $agendamento->deleteAgendamentoDocente($cod_atendimento);

}

function excluirMonitoria($cod_monitoria)
{
    $monitoria = new DaoMonitoria();
    $monitoria->delete($cod_monitoria);

}


function finalizarAgendamentoDocente()
{
    $fk_agendamento = $_GET['fk_agendamento'];
    $agendamento = new DaoAgendados();
    $agendamento->finalizar($fk_agendamento);

}


?>
