<?php

function alternaStatusDisciplina()
{
    $id = $_GET['id'];
    $dao = new DaoDisciplina();
    $class_info = $dao->getDisciplinaInfo($id);
    $ativo = $class_info['ativo'];

    $dao->alterarStatusAtivoDaDisciplina($id, $ativo);
}

function createDisciplina()
{
    $disciplina = new Disciplina();
    $daodisciplina = new DaoDisciplina();
    $disciplina->setId($daodisciplina->getMaxId());
    $disciplina->setNome($_POST['nome_da_disciplina']);
    $disciplina->setCodDisciplina($_POST['codigo_disciplina']);
    $disciplina->setPeriodo($_POST['periodo_disciplina']);
    $disciplina->setDataDeEncerramento($_POST['data_disciplina']);
    $disciplina->setFKDocente($_POST['docente_disciplina']);
    $disciplina->setAtivo(1);
    $disciplina->setMonitor(null);
    $daodisciplina->create($disciplina);
}
?>