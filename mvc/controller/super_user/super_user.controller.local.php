<?php

function alternaStatusLocal()
{
    $cod_local = $_GET['id'];
    $dao = new DaoLocal();
    $class_info = $dao->getLocalInfo($cod_local);
    $ativo = $class_info['ativo'];

    $dao->alterarStatusAtivoDoLocal($cod_local, $ativo);
}

//if (isset($_POST['adicionar_curso'])) {
function novoLocal()
{
    $con = new Conexao();
    $dao = new DaoLocal();
    $local = new Local($con->getConnection());
    $cod = $dao->getMaxId();
    $local->setCodLocal($cod);
    $local->setDepartamento($_POST['departamento_local']);
    $local->setSala($_POST['sala_local']);
    $local->setAtivo(1);

    $dao->createlocal($local);

}
    //novoCurso();
//}
?>