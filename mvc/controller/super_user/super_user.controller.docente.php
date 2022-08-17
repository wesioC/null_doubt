<?php
function alternaStatusDocente()
{
    $matricula = $_GET['id'];
    $dao = new DaoDocente();
    $class_info = $dao->getDocenteInfo($matricula);
    $ativo = $class_info['ativo'];

    $dao->alterarStatusAtivoDoDocente($matricula, $ativo);
}

function novoDocente()
{
    $con = new Conexao();
    $dao = new DaoDocente();
    $docente = new Docente($con->getConnection());
    $docente->setMatricula($_POST['matricula_docente']);
    $docente->setNome($_POST['nome_docente']);
    $docente->setSenha($_POST['senha_docente']);
    $docente->setAtivo(1);

    $dao->createDocente($docente); 
}

function editarDocente()
{
    $matricula = $_GET['id'];
    
    $nome = $_POST['change_nome_docente'];
    $senha = $_POST['change_senha_docente'];

    $dao = new DaoDocente();

    $dao->editDocente($matricula, $nome, $senha); 
}

