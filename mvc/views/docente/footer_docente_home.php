<style>
    a {
        color: #0000ff;
        display:inline-block;
        text-decoration: none;
        font-weight: 500;
    }
</style>
<?php
function retornaHora($hora)
{   
    $hora_mod = substr_replace($hora, '', 5);
    return $hora_mod;
}

?>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
    <a href="https://biblioteca.ifgoiano.edu.br/biblioteca/index.php">
      <img class="d-block w-100" src="https://ifgoiano.edu.br/home/images/REITORIA/Imagens/2022/Fevereiro/bannerBiblioteca_Virtual_Webbanner-arte-df1d5dbd1cd04c60a9d65ba1507a5ac0.png" alt="Primeiro Slide">
    </a>
    </div>
    <div class="carousel-item">
    <a href="https://www.ifgoiano.edu.br/home/index.php/component/content/article/57-destaque/14118">
      <img class="d-block w-100" src="https://ifgoiano.edu.br/home/images/banners/Covid-19_Prancheta_1-6466f6fb43f949418811024c95165d93.png" alt="Segundo Slide">
    </a>
    </div>
    <div class="carousel-item">
    <a href="https://www.ifgoiano.edu.br/home/index.php/component/content/article/160-noticias-anteriores/20157-divulgado-edital-de-selecao-para-producao-de-cursos-mooc.html">
      <img class="d-block w-100" src="https://ifgoiano.edu.br/home/images/REITORIA/Imagens/2022/Maio/Banner_rotativo.png" alt="Terceiro Slide">
    </a>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Anterior</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Próximo</span>
  </a>
</div>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <style>
            thead {
                font-weight: 300px;
                color: white;
                border-radius: 10px;
                margin-top: 1px;
                margin-bottom: 1px;
                border: 1;
                padding-bottom: 1px;
                padding-top: 1px;
                background-color: #38B6FF;
            }
            td {
                background-color: #d3d3d3;
                color: black;
                border-radius: 1px;
                font-weight: 300px;
                font-size: 16px;
                padding-bottom: 1px;
                padding-top: 1px;
                border: 1;
                font-style: normal;
                font-family: sans-serif;
            }
            button {
                border: none;
                color: white;
                padding: 5px 20px;
                text-align: center;
                background-color: #38B6FF;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
                }
            .desativado{
                border: none;
                color: white;
                padding: 5px 20px;
                text-align: center;
                background-color: gray;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
                }
        </style>
    </xsl:template>
</xsl:stylesheet>

<!--
<h3 class="text-center mt-5">Atendimentos Semanais</h3>
<table border="1" class="table table-striped custom-table">
            <thead>
                <tr>
                    <th scope="col">Horário</th>
                    <th scope="col">Dia</th>
                    <th scope="col">Disciplina</th>
                    <th scope="col">Local</th>
                    <th scope="col">Alunos</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>15:45</td>
                    <td>Quarta</td>
                    <td>Grafos</td>
                    <td>Hospital</td>
                    <td> <a href="#"> 4 </a> </td>
                    <td>Ativo</td>
                    <td> <a href="#"> Desativar </a> </td>
                </tr>
                <tr>
                    <td>11:00</td>
                    <td>Sexta</td>
                    <td>Autômatos</td>
                    <td>Laboratório VI</td>
                    <td> <a href="#"> 0 </a> </td>
                    <td>Inativo</td>
                    <td> <a href="#"> Reativar </a> </td>
                </tr>
            </tbody>
        </table>
        -->
<h3 class="text-center mt-5">Atendimentos Semanais</h3>
<?php
$dao = new DaoAgendamento();
$agendamentos_on = $dao->readAllActiveAgendamentosDocente($matricula);
$agendamentos_off = $dao->readAllInactiveAgendamentosDocente($matricula);

echo 
'
<table border="1" class="table table-striped custom-table">
    <thead>
        <tr>
            <th scope="col">Horário</th>
            <th scope="col">Dia</th>
            <th scope="col">Disciplina</th>
            <th scope="col">Local</th>
            <th scope="col">Alunos</th>
            <th scope="col">Status</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
';

if ($agendamentos_on == null and $agendamentos_off == null) {
    echo 
    '
    <tr>
        <td colspan="8">Nenhum agendamento disponível</td>
    </tr>
    ';
}
if ($agendamentos_on != null) {
    foreach ($agendamentos_on as $agendamento) {
        $daodisciplina = new DaoDisciplina;
        $daoagendandos = new DaoAgendados;
        $disciplina = $daodisciplina->getDisciplinaObj($agendamento->fk_disciplina);
        $daolocal = new DaoLocal;
        $local = $daolocal->getLocalObj($agendamento->fk_local);    

        echo 
        '
        <tr>
            <td>'. retornaHora($agendamento->horario) .'</td>
            <td>'. descobrirDia($agendamento->dia) .'</td>
            <td>'. $disciplina->nome .'</td>
            <td> <a href="#">'. $local->sala .' </a> </td>
            <td> <a href="?p=docente&doc=discentes_agendados&fk_agendamento='.$agendamento->cod_agendamento.'">' . $daoagendandos->countDiscentesAgendados($agendamento->cod_agendamento).' </a> </td>
            <td> <font color="green"> <b> Ativo </b> </font> </td>
            <td> <a href="?p=docente&action=finalizar-agendamento&fk_agendamento=' .
            $agendamento->cod_agendamento .
            '"><button type="submit" class="button">Finalizar</button> </a></td>
            <td> 
            <a 
            href="?p=docente&doc=altern-agendamento&fk_agendamento='. $agendamento->cod_agendamento .'&ativo='.$agendamento->ativo.'" > Desativar
            </a>
            </td>
        </tr>
        ';
    }
}
if ($agendamentos_off != null) {
    foreach ($agendamentos_off as $agendamento) {
        $daodisciplina = new DaoDisciplina;
        $daoagendandos = new DaoAgendados;
        $disciplina = $daodisciplina->getDisciplinaObj($agendamento->fk_disciplina);
        $daolocal = new DaoLocal;
        $local = $daolocal->getLocalObj($agendamento->fk_local);
        //var_dump($agendamento);
        echo 
        '
        <tr>
            <td>'. retornaHora($agendamento->horario) .'</td>
            <td>'. descobrirDia($agendamento->dia) .'</td>
            <td>'. $disciplina->nome .'</td>
            <td> <a href="#">'. $local->sala .' </a> </td>
            <td>'. $daoagendandos->countDiscentesAgendados($agendamento->cod_agendamento).'</td>
            <td> <font color="red"> <b> Inativo </b> </font> </td>
            <td> <button  class="desativado" disabled >Finalizar</button> </td>
            <td> 
            <a 
            href="?p=docente&doc=altern-agendamento&fk_agendamento='. $agendamento->cod_agendamento .'&ativo='.$agendamento->ativo.'" > Ativar
            </a>
            </td>
        </tr>
        ';
    }
}
?>