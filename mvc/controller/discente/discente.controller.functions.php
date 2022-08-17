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

function agendar()
{
    $fk_discente = $_GET['fk_discente'];
    $fk_agendamento = $_GET['fk_agendamento'];
    $con = new Conexao();
    $dao = new DaoAgendados();
    $agendados = new Agendados($con->getConnection());
    $agendados->setFKDiscente($fk_discente);
    $agendados->setFKAgendamento($fk_agendamento);

    $dao->createAgenda($agendados);
}

function agendar_monitoria()
{
    $fk_discente = $_GET['fk_discente'];
    $fk_agendamento = $_GET['fk_agendamento'];
    $con = new Conexao();
    $dao = new DaoAgendadosMonitoria();
    $agendados = new AgendadosMonitoria($con->getConnection());
    $agendados->setFKDiscente($fk_discente);
    $agendados->setFKMonitoria($fk_agendamento);

    $dao->createAgenda($agendados);
}

function desmarcar()
{
    $fk_discente = $_GET['fk_discente'];
    $fk_agendamento = $_GET['fk_agendamento'];
    $con = new Conexao();
    $dao = new DaoAgendados();
    $agendados = new Agendados($con->getConnection());
    $agendados->setFKDiscente($fk_discente);
    $agendados->setFKAgendamento($fk_agendamento);

    $dao->deleteAgenda($agendados);
}

function desmarcar_monitoria()
{
    $fk_discente = $_GET['fk_discente'];
    $fk_agendamento = $_GET['fk_agendamento'];
    $con = new Conexao();
    $dao = new DaoAgendadosMonitoria();
    $agendados = new AgendadosMonitoria($con->getConnection());
    $agendados->setFKDiscente($fk_discente);
    $agendados->setFKMonitoria($fk_agendamento);

    $dao->deleteAgenda($agendados);
}

function finalizarAgendamentoMonitor()
{
    $fk_agendamento = $_GET['fk_agendamento'];
    $agendamento = new DaoAgendadosMonitoria();
    $agendamento->finalizar($fk_agendamento);

}
?>