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

// function descobrirDia($dia)
// {
//     echo $dia;
//     switch ($dia) {
//         case 1:
//             $diaFormatado = 'Segunda';
//             break;
//         case 2:
//             $diaFormatado = 'Terça';
//             break;
//         case 3:
//             $diaFormatado = 'Quarta';
//             break;
//         case 4:
//             $diaFormatado = 'Quinta';
//             break;
//         case 5:
//             $diaFormatado = 'Sexta';
//             break;
//         case 6:
//             $diaFormatado = 'Sábado';
//             break;
//     }

//     return $diaFormatado;
// }

// function descobrirDia($dia)
// {
//     setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
//     date_default_timezone_set('America/Sao_Paulo');
//     $dia_en = strftime('%A', strtotime($dia));
//     if ($dia_en == 'Monday') {
//         return 'Segunda';
//     }
//     if ($dia_en == 'Tuesday') {
//         return 'Terça';
//     }
//     if ($dia_en == 'Wednesday') {
//         return 'Quarta';
//     }
//     if ($dia_en == 'Thursday') {
//         return 'Quinta';
//     }
//     if ($dia_en == 'Friday') {
//         return 'Sexta';
//     }
//     if ($dia_en == 'Saturday') {
//         return 'Sábado';
//     }
//     if ($dia_en == 'Sunday') {
//         return 'Domingo';
//     }
// }
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
                .button_red {
                background-color: #FF0000;
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

echo '
<table border="1" class="table table-striped custom-table">
    <thead>
        <tr>
            <th scope="col">Horário</th>
            <th scope="col">Dia</th>
            <th scope="col">Disciplina</th>
            <th scope="col">Departamento</th>
            <th scope="col">Sala</th>
            <th scope="col">Status</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
';

if ($agendamentos_on == null and $agendamentos_off == null) {
    echo '
    <tr>
        <td colspan="8">Nenhum agendamento disponível</td>
    </tr>
    ';
}
if ($agendamentos_on != null) {
    foreach ($agendamentos_on as $agendamento) {
        $daodisciplina = new DaoDisciplina();
        $daoagendandos = new DaoAgendados();
        $disciplina = $daodisciplina->getDisciplinaObj(
            $agendamento->fk_disciplina
        );
        $daolocal = new DaoLocal();
        $local = $daolocal->getLocalObj($agendamento->fk_local);
        //var_dump($agendamento);
        echo '
        <tr>
            <td>' .
            retornaHora($agendamento->horario) .
            '</td>
            <td>' .
            descobrirDia($agendamento->dia) .
            '</td>
            <td>' .
            $disciplina->nome .
            '</td>
            <td> ' .
            $local->departamento .
            ' </td>
            <td> <a href="#">' .
            $local->sala .
            ' </a> </td>
            <td> <font color="green"> <b> Ativo </b> </font> </td>
            <td> 
            <a href="?p=docente&action=delete-agendamento&cod_agendamento=' .
            $agendamento->cod_agendamento .
            '"><button type="submit" class="button_red">
            Excluir</button> 
            </a>
            </td>
        </tr>
        ';
    }
}
if ($agendamentos_off != null) {
    foreach ($agendamentos_off as $agendamento) {
        $daodisciplina = new DaoDisciplina();
        $daoagendandos = new DaoAgendados();
        $disciplina = $daodisciplina->getDisciplinaObj(
            $agendamento->fk_disciplina
        );
        $daolocal = new DaoLocal();
        $local = $daolocal->getLocalObj($agendamento->fk_local);
        //var_dump($agendamento);
        echo '
        <tr>
            <td>' .
            retornaHora($agendamento->horario) .
            '</td>
            <td>' .
            descobrirDia($agendamento->dia) .
            '</td>
            <td>' .
            $disciplina->nome .
            '</td>
            <td> ' .
            $local->departamento .
            ' </td>
            <td> <a href="#">' .
            $local->sala .
            ' </a> </td>
            <td> <font color="red"> <b> Inativo </b> </font> </td>
            <td> 
            <a href="?p=docente&action=delete-agendamento&cod_agendamento=' .
            $agendamento->cod_agendamento .
            '"><button type="submit" class="button_red">
            Excluir</button> 
            </a>
            </td>
        </tr>
        ';
    }
}
?>
</tbody>
</table>

<h3 class="text-center mt-5">Novo Atendimento</h3>

<table border="1" class="table table-striped custom-table">
    <thead>
        <tr>
            <th scope="col">Horário</th>
            <th scope="col">Dia</th>
            <th scope="col">Disciplina</th>
            <th scope="col">Local</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <form  method="post">

    <tr>
        <td>
            <input placeholder="hora:minuto" type="time" id="horario" name="horario" size="6">
        </td>
        <td>
            <!-- <input placeholder="dia" type="date" id="dia" name="dia" size="6"> -->
            <select name="dia" id="dia">
                <option value="1">Segunda</option>
                <option value="2">Terça</option>
                <option value="3">Quarta</option>
                <option value="4">Quinta</option>
                <option value="5">Sexta</option>
                <option value="6">Sábado</option>
            </select>
        </td>

        <td>
            <select name="disciplinas" id="disciplinas">
                <?php
                $disciplina = new DaoDisciplina();
                $disciplinasDocente = $disciplina->getAllActiveFromDocente($_SESSION['docente']);
                // print_r($disciplinasDocente);
                // echo '<hr>';
                // print_r($disciplinasDocente[1]->nome);

                foreach ($disciplinasDocente as $dis) {
                    echo '<option value=' .
                        $dis->id .
                        '>' .
                        $dis->nome .
                        '</option>
                        ';
                }
                ?>
            </select>
        </td>
        <td>
            <select name="locais" id="locais">
                <?php
                $local = new DaoLocal();
                $locais = $local->getAllActiveLocal();

                foreach ($locais as $loc) {
                    echo '<option value=' .
                        $loc->cod_local .
                        '>' 
                        . $loc->departamento . '/' . $loc->sala .
                        '</option>
                        ';
                }
                ?>

            </select>
        </td>
        <td>  <a><button type="submit" class="button" name="agendamento-docente">Adicionar</button> </a> </td>
            
    </tr>
    </form>
    </tbody>
</table>

