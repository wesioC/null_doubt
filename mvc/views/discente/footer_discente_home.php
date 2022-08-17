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
            .button_red {
                background-color: #FF0000;
                }
            a {
            color: #0000ff;
            display:inline-block;
            text-decoration: none;
            font-weight: 500;
            }
        </style>
    </xsl:template>
</xsl:stylesheet>

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
<h3 class="text-center mt-5">Atendimentos Disponíveis</h3>

<?php
$dao = new DaoAgendamento();
$agendamentos_disponiveis = $dao->readAgendamentosDiscente($matricula);
$agendados = $dao->readAgendasDiscente($matricula);
//var_dump($agendamentos_disponiveis);
//var_dump($agendados);
echo 
'
<table border="1" class="table table-striped custom-table">
    <thead>
        <tr>
            <th scope="col">Horário</th>
            <th scope="col">Dia</th>
            <th scope="col">Disciplina</th>
            <th scope="col">Local</th>
            <th scope="col">Docente</th>
            <th scope="col"></th>
            </tr>
    </thead>
    <tbody>
';
if ($agendamentos_disponiveis == null and $agendados == null) {
    echo 
    '
    <tr>
        <td colspan="3">Nenhum agendamento disponível</td>
    </tr>
    ';
}
else if ($agendados == null) {
    //var_dump($agendamentos_disponiveis);
    //echo'entrou 1';
    foreach ($agendamentos_disponiveis as $agendamento) {
        $daodisciplina = new DaoDisciplina;
        $disciplina = $daodisciplina->getDisciplinaObj($agendamento->fk_disciplina);
        $daodocente = new DaoDocente;
        $docente = $daodocente->getDocenteObj($agendamento->fk_docente);
        $daolocal = new DaoLocal;
        $local = $daolocal->getLocalObj($agendamento->fk_local);
        echo 
        '
        <tr>
        <td>'. retornaHora($agendamento->horario) .'</td>
        <td>'. descobrirDia($agendamento->dia) .'</td>
        <td>'. $disciplina->nome .'</td>
        <td> <a href="#">'. $local->sala .' </a> </td>
        <td>'. $docente->nome .'</td>
        <td> 
        <a href="?p=discente&dis=agendar&fk_discente='. $matricula .'&fk_agendamento='. $agendamento->cod_agendamento.'"><button type="submit" class="button">
        Agendar</button> 
        </a>
        </td>
        </tr>
        ';
    }    
}
else{
    foreach ($agendados as $agendamento) {
        $daodisciplina = new DaoDisciplina;
        $disciplina = $daodisciplina->getDisciplinaObj($agendamento->fk_disciplina);
        $daodocente = new DaoDocente;
        $docente = $daodocente->getDocenteObj($agendamento->fk_docente);
        $daolocal = new DaoLocal;
        $local = $daolocal->getLocalObj($agendamento->fk_local);
        echo 
        '
        <tr>
        <td>'. retornaHora($agendamento->horario) .'</td>
        <td>'. descobrirDia($agendamento->dia) .'</td>
        <td>'. $disciplina->nome .'</td>
        <td> <a href="#">'. $local->sala .' </a> </td>
        <td>'. $docente->nome .'</td>
        <td> 
        <a href="?p=discente&dis=desmarcar&fk_discente='. $matricula .'&fk_agendamento='. $agendamento->cod_agendamento.'"><button type="submit" class="button_red">
        Desmarcar</button> 
        </a>
        </td>
        </tr>
        ';
    }
    foreach ($agendamentos_disponiveis as $agendamento) {
        $c = 0;
        foreach ($agendados as $agendado) {
            if ($agendado->cod_agendamento == $agendamento->cod_agendamento){
                $c++;
            }
        }
        if($c == 0){
            $daodisciplina = new DaoDisciplina;
            $disciplina = $daodisciplina->getDisciplinaObj($agendamento->fk_disciplina);
            $daodocente = new DaoDocente;
            $docente = $daodocente->getDocenteObj($agendamento->fk_docente);
            $daolocal = new DaoLocal;
            $local = $daolocal->getLocalObj($agendamento->fk_local);
            echo 
            '
            <tr>
            <td>'. retornaHora($agendamento->horario) .'</td>
            <td>'. descobrirDia($agendamento->dia) .'</td>
            <td>'. $disciplina->nome .'</td>
            <td> <a href="#">'. $local->sala .' </a> </td>
            <td>'. $docente->nome .'</td>
            <td> 
            <a href="?p=discente&dis=agendar&fk_discente='. $matricula .'&fk_agendamento='. $agendamento->cod_agendamento.'"><button type="submit" class="button">
            Agendar</button> 
            </a>
            </td>
            </tr>
            ';
        }
    }    
}

?>
</tbody>
</table>

<h3 class="text-center mt-5">Monitorias Disponíveis</h3>

<?php
$dao = new DaoMonitoria();
$agendamentos_disponiveis = $dao->readAgendamentosDiscente($matricula);
$agendados = $dao->readAgendasDiscente($matricula);

echo 
'
<table border="1" class="table table-striped custom-table">
    <thead>
        <tr>
            <th scope="col">Horário</th>
            <th scope="col">Dia</th>
            <th scope="col">Disciplina</th>
            <th scope="col">Local</th>
            <th scope="col">Monitor</th>
            <th scope="col"></th>
            </tr>
    </thead>
    <tbody>
';

if ($agendamentos_disponiveis == null and $agendados == null) {
    echo 
    '
    <tr>
        <td colspan="6">Nenhum agendamento disponível</td>
    </tr>
    ';
}
else if ($agendados == null) {
    //var_dump($agendamentos_disponiveis);
    //echo'entrou 1';
    foreach ($agendamentos_disponiveis as $agendamento) {
        //echo 'entrou no laço 1';
        $daodisciplina = new DaoDisciplina;
        $disciplina = $daodisciplina->getDisciplinaObj($agendamento->fk_disciplina);
        $daodiscente = new DaoDiscente;
        $discente = $daodiscente->getDiscenteObj($agendamento->fk_discente);
        $daolocal = new DaoLocal;
        $local = $daolocal->getLocalObj($agendamento->fk_local);
        echo 
        '
        <tr>
        <td>'. retornaHora($agendamento->horario) .'</td>
        <td>'. descobrirDia($agendamento->dia) .'</td>
        <td>'. $disciplina->nome .'</td>
        <td> <a href="#">'. $local->sala .' </a> </td>
        <td>'. $discente->nome .'</td>
        <td> 
        <a href="?p=discente&dis=agendar-monitoria&fk_discente='. $matricula .'&fk_agendamento='. $agendamento->cod_monitoria.'"><button type="submit" class="button">
        Agendar</button> 
        </a>
        </td>
        </tr>
        ';
    }    
}
else{
    foreach ($agendados as $agendamento) {
        //echo 'entrou no laço 2';
        $daodisciplina = new DaoDisciplina;
        $disciplina = $daodisciplina->getDisciplinaObj($agendamento->fk_disciplina);
        $daodiscente = new DaoDiscente;
        $discente = $daodiscente->getDiscenteObj($agendamento->fk_discente);
        $daolocal = new DaoLocal;
        $local = $daolocal->getLocalObj($agendamento->fk_local);
        echo 
        '
        <tr>
        <td>'. retornaHora($agendamento->horario) .'</td>
        <td>'. descobrirDia($agendamento->dia) .'</td>
        <td>'. $disciplina->nome .'</td>
        <td> <a href="#">'. $local->sala .' </a> </td>
        <td>'. $discente->nome .'</td>
        <td> 
        <a href="?p=discente&dis=desmarcar-monitoria&fk_discente='. $matricula .'&fk_agendamento='. $agendamento->cod_monitoria.'"><button type="submit" class="button_red">
        Desmarcar</button> 
        </a>
        </td>
        </tr>
        ';
    }
    foreach ($agendamentos_disponiveis as $agendamento) {
        $c = 0;
        foreach ($agendados as $agendado) {
            if ($agendado->cod_monitoria == $agendamento->cod_monitoria){
                $c++;
            }
        }
        if($c == 0){
            //echo 'entrou no laço 3';
            $daodisciplina = new DaoDisciplina;
            $disciplina = $daodisciplina->getDisciplinaObj($agendamento->fk_disciplina);
            $daodiscente = new DaoDiscente;
            $discente = $daodiscente->getDiscenteObj($agendamento->fk_discente);
            $daolocal = new DaoLocal;
            $local = $daolocal->getLocalObj($agendamento->fk_local);
            echo 
            '
            <tr>
            <td>'. retornaHora($agendamento->horario) .'</td>
            <td>'. descobrirDia($agendamento->dia) .'</td>
            <td>'. $disciplina->nome .'</td>
            <td> <a href="#">'. $local->sala .' </a> </td>
            <td>'. $discente->nome .'</td>
            <td> 
            <a href="?p=discente&dis=agendar-monitoria&fk_discente='. $matricula .'&fk_agendamento='. $agendamento->cod_monitoria.'"><button type="submit" class="button">
            Agendar</button> 
            </a>
            </td>
            </tr>
            ';
        }
    }    
}


?>
</tbody>
</table>
     