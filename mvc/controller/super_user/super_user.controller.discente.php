<?php
function alternaStatusDiscente()
{
    $matricula = $_GET['id'];
    $dao = new DaoDiscente();
    $class_info = $dao->getDiscenteInfo($matricula);
    $ativo = $class_info['ativo'];

    $dao->alterarStatusAtivoDoDiscente($matricula, $ativo);
}

function alternaStatusDiscenteMonitor()
{
    $matricula = $_GET['id'];
    $dao = new DaoDiscente();
    $class_info = $dao->getDiscenteInfo($matricula);
    $ativo = $class_info['ativo'];

    $dao->alterarStatusAtivoDoDiscenteMonitor($matricula, $ativo);
}

function novoDiscente()
{
    $con = new Conexao();
    $dao = new DaoDiscente();
    $discente = new Discente($con->getConnection());
    $discente->setMatricula($_POST['matricula_discente']);
    $discente->setNome($_POST['nome_discente']);
    $discente->setSenha($_POST['senha_discente']);
    $discente->setFKCurso($_POST['codigo_do_curso_discente']);
    $discente->setMonitor(0);
    $discente->setAtivo(1);

    $dao->createDiscente($discente); 
}

function editarDiscente()
{
    $matricula = $_GET['id'];
    
    $nome = $_POST['change_nome_discente'];
    $senha = $_POST['change_senha_discente'];
    $fk_Curso = $_POST['change_curso_discente'];

    $dao = new DaoDiscente();

    $dao->editDiscente($matricula, $nome, $senha, $fk_Curso); 
}
