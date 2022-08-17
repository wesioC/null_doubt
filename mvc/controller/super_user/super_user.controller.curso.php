<?php

function alternaStatusCurso()
{
    $cod_Curso = $_GET['id'];
    $dao = new DaoCurso();
    $class_info = $dao->getCursoInfo($cod_Curso);
    $ativo = $class_info['ativo'];

    $dao->alterarStatusAtivoDoCurso($cod_Curso, $ativo);
}

//if (isset($_POST['adicionar_curso'])) {
function novoCurso()
{
    $con = new Conexao();
    $dao = new DaoCurso();
    $curso = new Curso($con->getConnection());
    $cod = $dao->getMaxId();
    $curso->setCodCurso($cod);
    $curso->setNome($_POST['nome_curso']);
    $curso->setAtivo(1);

    $dao->createCurso($curso);

}
    //novoCurso();
//}
?>