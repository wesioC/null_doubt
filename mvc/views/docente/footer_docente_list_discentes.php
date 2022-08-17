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
                text-align: center;
                background-color: #38B6FF;
                text-decoration: none;
                display: inline-block;
                font-size: 14px;
                margin: 2px 1px;
                cursor: pointer;
                }
            .desativado{
                border: none;
                color: white;
                text-align: center;
                background-color: gray;
                text-decoration: none;
                display: inline-block;
                font-size: 14px;
                margin: 2px 1px;
                cursor: pointer;
                }
        </style>
    </xsl:template>
</xsl:stylesheet>

<h4 class="text-center mt-5">Atendimento</h4>

<table border="1" class="table table-striped custom-table">
    <thead>
        <tr>
            <th scope="col">Horário</th>
            <th scope="col">Dia</th>
            <th scope="col">Disciplina</th>
            <th scope="col">Local</th>
        </tr>
    </thead>
    <tbody>

<?php
$dao = new DaoAgendamento();
$cod_agendamento = $_GET['fk_agendamento'];
$agendamento = $dao->getAgendamentoObj($cod_agendamento);
$daodisciplina = new DaoDisciplina;
$disciplina = $daodisciplina->getDisciplinaObj($agendamento->fk_disciplina);
$daolocal = new DaoLocal;
$local = $daolocal->getLocalObj($agendamento->fk_local);
echo
    '

    <tr>
    <td>'. retornaHora($agendamento->horario) .'</td>
    <td>'. descobrirDia($agendamento->dia) .'</td>
    <td>'. $disciplina->nome .'</td>
    <td>'. $local->sala .'</td>
    </tr>

    ';
?>

    </tbody>
</table>

<h4 class="text-center mt-5">Discentes Agendados</h4>

<?php
$dao = new DaoAgendados();
$daoAgendamento = new DaoAgendamento();
$cod_agendamento = $_GET['fk_agendamento'];

$agendados = $dao->discentesAgendados($cod_agendamento);
echo '

<table border="1" class="table table-striped custom-table">
    <thead>
        <tr>
            <th scope="col">Matricula</th>
            <th scope="col">Nome</th>
            <th scope="col">Curso</th>
        </tr>
    </thead>
    <tbody>';

if ($agendados != null) {
        $daocurso = new DaoCurso;
        foreach ($agendados as $agendado) {
            $curso = $daocurso->getCursoObj($agendado->fk_curso);

            echo
                '

                <tr>
                <td>'. $agendado->matricula .'</td>
                <td>'. $agendado->nome .'</td>
                <td>'. $curso->nome .'</td>
                </tr>

                ';
        }
    
} else {
    echo '
                    <tr>
                        <td colspan="3">Nenhum discente por enquanto</td>
                    </tr>
        
                ';
}
?>
</tbody>
</table>