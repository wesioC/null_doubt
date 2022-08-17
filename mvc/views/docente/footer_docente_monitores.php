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
            .button_red {
                background-color: #FF0000;
                }
        </style>
    </xsl:template>
</xsl:stylesheet>
<!--
<h3 class="text-center mt-5">Monitores</h3>

<table border="1" class="table table-striped custom-table">
    <thead>
        <tr>
            <th scope="col">Matricula</th>
            <th scope="col">Nome</th>
            <th scope="col">Disciplina</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>2020102201940040</td>
            <td>Gus</td>
            <td>Ciências da Computação</td>
            <td> <a href="#"><button type="submit" class="button_red">Remover</button> </a></td>
        </tr>
    </tbody>
</table>
            -->
<h3 class="text-center mt-5">Monitores</h3>

<table border="1" class="table table-striped custom-table">
    <thead>
        <tr>
            <th scope="col">Matricula</th>
            <th scope="col">Nome</th>
            <th scope="col">Disciplina</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>

<?php
$dao = new DaoDiscente();
$monitores = $dao->getMonitoresFromDocente($_SESSION["docente"]);

if ($monitores != null) {
        foreach ($monitores as $monitor) {
            $daodisciplina = new DaoDisciplina();
            $disciplina = $daodisciplina->getDisciplinaObjFromMonitor($monitor->matricula);
            echo
                '
                <tr>
                <td>'. $monitor->matricula .'</td>
                <td>'. $monitor->nome .'</td>
                <td>'. $disciplina->nome .'</td>
                <td> 
                <a href="?p=docente&doc=horarios-monitor&matricula=' 
                . $monitor->matricula .'&id='. $disciplina->id .'"><button type="submit" class="button">
                Horários</button> 
                </a>
                </td>
                <td> 
                <a href="?p=docente&action=delete-monitor&matricula=' 
                . $monitor->matricula .'&id='. $disciplina->id .'"><button type="submit" class="button_red">
                Remover</button> 
                </a>
                </td>
                </tr>
                ';
        }
    
} else {
    echo 
    '
    <tr>
        <td colspan="3">Nenhum monitor em suas disciplinas</td>
    </tr>   
    ';
}
?>

</tbody>
</table>

<h3 class="text-center mt-5">Novo Monitor</h3>

<table border="1" class="table table-striped custom-table">
    <thead>
        <tr>
            <th scope="col">Matricula</th>
            <th scope="col">Disciplina</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <form  method="post">
        <tr>
        <?php
            $disciplina = new DaoDisciplina();
            $disciplinasDocente = $disciplina->getAllActiveFromDocenteWithoutScheduling($_SESSION['docente']);
            if ($disciplinasDocente == null) {
                echo'
                <tr>
                    <td colspan="3">Todas as suas disciplinas já possuem monitores</td>
                </tr>
                ';
            }
            else {
                echo
                '
                <tr>
                <td><input placeholder="Matrícula" type="text" id="matricula_discente" name="matricula_discente" size="16"></td>
                <td>
                <select name="disciplinas" id="disciplinas">
                ';
                foreach ($disciplinasDocente as $dis) {
                    echo '<option value=' .
                        $dis->id .
                        '>' .
                        $dis->nome .
                        '</option>';
                }
                echo
                '
                </select>
                </td>
                <td> <a><button type="submit" name="add-monitor" class="button">Adicionar</button> </a></td>
                </tr>
                ';
            }
        ?>
                
        </form>
    </tbody>
</table>