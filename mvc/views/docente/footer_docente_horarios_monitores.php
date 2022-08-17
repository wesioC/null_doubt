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
            .button_red {
            background-color: #FF0000;
            }
        </style>
    </xsl:template>
</xsl:stylesheet>

<?php
$dao = new DaoDiscente();
$monitor = $dao->getDiscenteObj($_GET['matricula']);
echo
'
<h3 class="text-center mt-5">Horários de '.$monitor->nome.'</h3>
';
?>

<table border="1" class="table table-striped custom-table">
            <thead>
                <tr>
                    <th scope="col">Horário</th>
                    <th scope="col">Dia</th>
                    <th scope="col">Local</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <!--
                <tr>
                    <td>15:45</td>
                    <td>Quarta</td>
                    <td>Hospital</td>
                    <td> 
                    <a href="#"><button type="submit" class="button_red">
                    Remover</button> 
                    </a>
                    </td>
                </tr>
                <tr>
                    <td>11:00</td>
                    <td>Sexta</td>
                    <td>Laboratório VI</td>
                    <td> 
                    <a href="#"><button type="submit" class="button_red">
                    Remover</button> 
                    </a>
                    </td>
                </tr>
        -->
<?php
$dao = new DaoMonitoria();
$monitorias = $dao->readAllFromMonitor($monitor->matricula);
$c = 0;
if ($monitorias == null) {
    echo'
    <tr>
    <td colspan="4">Nenhum horário cadastrado</td>
    </tr>  
    ';
}
else {
    foreach ($monitorias as $monitoria){
        $c++;
        $daodisciplina = new DaoDisciplina();
        $disciplina = $daodisciplina->getDisciplinaObj($monitoria->fk_disciplina);
        $daolocal = new DaoLocal();
        $local = $daolocal->getLocalObj($monitoria->fk_local);
        echo '
        <tr>
            <td>'.retornaHora($monitoria->horario).'</td>
            <td>'.descobrirDia($monitoria->dia).'</td>
            <td>'.$local->sala.'</td>         
            <td> 
            <a href="?p=docente&action=delete-horario-monitor&cod_monitoria='.$monitoria->cod_monitoria.'"><button type="submit" class="button_red">
                Remover</button> 
            </a>      
            </td>
        </tr>
        ';
    }
}
if ($c < 3) {
    echo 
    '

    <form  method="post">

    <tr>
        <td>
            <input placeholder="hora:minuto" type="time" id="horario" name="horario" size="6">
        </td>
        <td>
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
            <select name="locais" id="locais">
    ';
                
                $local = new DaoLocal();
                $locais = $local->getAllActiveLocal();
                foreach ($locais as $loc) {
                    echo '<option value=' .
                        $loc->cod_local .
                        '>' .
                        $loc->sala .
                        '</option>';
                }
    echo 
    '
            </select>
        </td>
        <td>  <a><button type="submit" class="button" name="novo-horario-monitor">Adicionar</button> </a> </td>
            
    </tr>
    </form>

    ';
}
?>
                

