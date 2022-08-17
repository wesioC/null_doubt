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

<h3 class="text-center mt-5">Monitorias Semanais</h3>
<?php

$dao = new DaoMonitoria();
$agendamentos_on = $dao->readAllFromMonitor($_SESSION['discente']);

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
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
';

if ($agendamentos_on == null) {
    echo 
    '
    <tr>
        <td colspan="6">Nenhuma monitoria disponível</td>
    </tr>
    ';
}
if ($agendamentos_on != null) {
    foreach ($agendamentos_on as $agendamento) {
        $daodisciplina = new DaoDisciplina;
        $daoagendandos = new DaoAgendadosMonitoria;
        $disciplina = $daodisciplina->getDisciplinaObj($agendamento->fk_disciplina);
        $daolocal = new DaoLocal;
       // $finalizar = $daoagendandos->finalizar($cod_agendamento);
        $local = $daolocal->getLocalObj($agendamento->fk_local);
        //var_dump($agendamento);

        echo 
        '
        <tr>
            <td>'. retornaHora($agendamento->horario) .'</td>
            <td>'. descobrirDia($agendamento->dia) .'</td>
            <td>'. $disciplina->nome .'</td>
            <td> <a href="#">'. $local->sala .' </a> </td>
            <td> <a href="?p=discente&dis=discentes_agendados&fk_agendamento='.$agendamento->cod_monitoria.'">' . $daoagendandos->countDiscentesAgendados($agendamento->cod_monitoria).' </a> </td>
            <td> <a href="?p=discente&action=finalizar-agendamento&fk_agendamento=' .
            $agendamento->cod_monitoria .
            '"><button type="submit" class="button">Finalizar</button> </a></td>
        </tr>
        ';
    }
}
?>
</tbody>
</table>