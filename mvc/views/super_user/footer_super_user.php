<?php
function retornaAtivoEmFormatoTexto($ativo)
{
    if ($ativo == 1) {
        $ativo = "Ativo";
    } else {
        $ativo = "Inativo";
    }
    return $ativo;
}
function retornarmonitor($matricula) {
    if ($matricula == null){
        return "Não possui";
    }   else {
        $dao = new DaoDiscente();
        $monitor = $dao->getDiscenteObj($matricula);
        return $monitor->nome;
    }
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
            a {
                color: #0000ff;
                display:inline-block;
                text-decoration: none;
                font-weight: 500;
            }
    
        </style>
    </xsl:template>
</xsl:stylesheet>
<!------LOCAL--------------------------------------------------------------------------------------------------------------------------------------------------->
<?php
$dao = new DaoDocente();
$docentes_on = $dao->getAllActiveTeachers();
$docentes_off = $dao->getAllInactiveTeachers();

echo '
<h4 class="text-center mt-5">Docentes</h4>

<table border="1" class="table table-striped custom-table">
    <thead>
        <tr>
            <th scope="col">Matricula</th>
            <th scope="col">Nome</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
';

if ($docentes_on != null or $docentes_off != null) {
    if ($docentes_on != null) {
        foreach ($docentes_on as $docente) {
            echo '
                    <tr>
                    <td>' . $docente->matricula . '</td>
                    <td> ' . $docente->nome . '</td>
                    <td> <font color="green"> <b>' . retornaAtivoEmFormatoTexto($docente->ativo) . '</b> </font> </td>
                    </tr>
                    ';
        }
    }
    if ($docentes_off != null) {
        foreach ($docentes_off as $docente) {
            echo '
                    <tr>
                    <td>' . $docente->matricula . '</td>
                    <td> ' . $docente->nome . '</td>
                    <td> <font color="red"> <b>' . retornaAtivoEmFormatoTexto($docente->ativo) . '</b> </font> </td>
                    </tr>
                    ';
        }
    }
} else {
    echo '
                    <tr>
                        <td colspan="3">Nenhum docente por enquanto</td>
                    </tr>
        
                ';
}
?>
</tbody>
</table>

<!------------------------------------------------------------------Discente--------------------------------------------------------------------------------------->

<?php
$dao = new DaoDiscente();
$discentes_on = $dao->getAllActiveDiscentesMonitor();
$discentes_off = $dao->getAllInactiveDiscentesMonitor();
echo '
<h4 class="text-center mt-5">Monitores</h4>

<table border="1" class="table table-striped custom-table">
    <thead>
        <tr>
            <th scope="col">Matricula</th>
            <th scope="col">Nome</th>
            <th scope="col">Curso</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>';

if ($discentes_on != null or $discentes_off != null) {
    if ($discentes_on != null) {
        foreach ($discentes_on as $discente) {
            $dao = new DaoCurso();
            $curso = $dao->getCursoObj($discente->fk_curso);

            echo '
                    <tr>
                    <td>' . $discente->matricula . '</td>
                    <td> ' . $discente->nome . '</td>
                    <td> ' . $curso->nome . '</td>
                    <td> <font color="green"> <b>' . retornaAtivoEmFormatoTexto($discente->ativo) . '</b> </font> </td>
                    </tr>
                    ';
        }
    }
    if ($discentes_off != null) {
        foreach ($discentes_off as $discente) {
            $dao = new DaoCurso();
            $curso = $dao->getCursoObj($discente->fk_curso);
            echo '
                    <tr>
                    <td>' . $discente->matricula . '</td>
                    <td> ' . $discente->nome . '</td>
                    <td> ' . $curso->nome . '</td>
                    <td> <font color="red"> <b>' . retornaAtivoEmFormatoTexto($discente->ativo) . '</b> </font> </td>
                    </tr>
                    ';
        }
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
<!------LOCAL--------------------------------------------------------------------------------------------------------------------------------------------------->

<?php
$dao = new DaoDiscente();
$discentes_on = $dao->getAllActiveDiscentes();
$discentes_off = $dao->getAllInactiveDiscentes();
echo '
<h4 class="text-center mt-5">Discentes</h4>

<table border="1" class="table table-striped custom-table">
    <thead>
        <tr>
            <th scope="col">Matricula</th>
            <th scope="col">Nome</th>
            <th scope="col">Curso</th>
            <th scope="col">Status</th>
            <th scope="col">Monitor</th>
        </tr>
    </thead>
    <tbody>';

if ($discentes_on != null or $discentes_off != null) {
    if ($discentes_on != null) {
        foreach ($discentes_on as $discente) {
            $dao = new DaoCurso();
            $curso = $dao->getCursoObj($discente->fk_curso);
                if($discente->monitor == 1){
                    $monitor = 'Sim';

                    echo '
                    <tr>
                    <td>' . $discente->matricula . '</td>
                    <td> ' . $discente->nome . '</td>
                    <td> ' . $curso->nome . '</td>
                    <td> <font color="green"> <b>' . retornaAtivoEmFormatoTexto($discente->ativo) . '</b> </font> </td>
                    <td> <font color="green"> <b>' . $monitor . '</b></td>
                    </tr>
                    ';
                }else{
                    $monitor = 'Não';
                    echo '
                    <tr>
                    <td>' . $discente->matricula . '</td>
                    <td> ' . $discente->nome . '</td>
                    <td> ' . $curso->nome . '</td>
                    <td> <font color="green"> <b>' . retornaAtivoEmFormatoTexto($discente->ativo) . '</b> </font> </td>
                    <td> <font color="red"> <b>' . $monitor . '</b></td>
                    </tr>';
                    
                }


            
        }
    }
    if ($discentes_off != null) {
        foreach ($discentes_off as $discente) {
            $dao = new DaoCurso();
            $curso = $dao->getCursoObj($discente->fk_curso);
            if($discente->monitor == 1){
                $monitor = 'Sim';
                echo '
                    <tr>
                    <td>' . $discente->matricula . '</td>
                    <td> ' . $discente->nome . '</td>
                    <td> ' . $curso->nome . '</td>
                    <td> <font color="red"> <b>' . retornaAtivoEmFormatoTexto($discente->ativo) . '</b> </font> </td>
                    <td> <font color="green"> <b>' . $monitor . '</b></td>
                    </tr>
                    ';
            }else{
                $monitor = 'Não';

                echo '
                <tr>
                <td>' . $discente->matricula . '</td>
                <td> ' . $discente->nome . '</td>
                <td> ' . $curso->nome . '</td>
                <td> <font color="red"> <b>' . retornaAtivoEmFormatoTexto($discente->ativo) . '</b> </font> </td>
                <td> <font color="red"> <b>' . $monitor . '</b></td>
                </tr>';
            }
    
        }
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
<!------LOCAL--------------------------------------------------------------------------------------------------------------------------------------------------->
<?php
$dao = new DaoCurso();
$courses_on = $dao->getAllActiveCoursers();
$courses_off = $dao->getAllInactiveCoursers();
echo '
<h4 class="text-center mt-5">Cursos</h4>

<table border="1" class="table table-striped custom-table">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Código</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>';

if ($courses_on != null or $courses_off != null) {
    if ($courses_on != null) {
        foreach ($courses_on as $course) {
            echo '
                    <tr>
                    <td>' . $course->nome . '</td>
                    <td> ' . $course->cod_curso . '</td>
                    <td> <font color="green"> <b>' . retornaAtivoEmFormatoTexto($course->ativo) . '</b> </font> </td>
                    </tr>
                    ';
        }
    }
    if ($courses_off != null) {
        foreach ($courses_off as $course) {
            echo '
                    <tr>
                    <td>' . $course->nome . '</td>
                    <td> ' . $course->cod_curso . '</td>
                    <td> <font color="red"> <b>' . retornaAtivoEmFormatoTexto($course->ativo) . '</b> </font> </td>
                    </tr>
                    ';
        }
    }
} else {
    echo '
                    <tr>
                        <td colspan="3">Nenhum curso por enquanto</td>
                    </tr>
        
                ';
}

?>
</tbody>
</table>
<!----------------------------------------------------------------LOCAL----------------------------------------------------------------------------------------->

<?php
$dao = new Daolocal();
$local_on = $dao->getAllActiveLocal();
$local_off = $dao->getAllInactiveLocal();
echo '
<h4 class="text-center mt-5">Locais</h4>

<table border="1" class="table table-striped custom-table">
    <thead>
        <tr>
            <th scope="col">Código</th>
            <th scope="col">Departamento</th>
            <th scope="col">Sala</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>';

if ($local_on != null or $local_off != null) {
    if ($local_on != null) {
        foreach ($local_on as $local) {
            echo '
                    <tr>
                    <td>' . $local->cod_local . '</td>
                    <td>'. $local->departamento . '</td>
                    <td><a href=#> ' . $local->sala . '</a></td>
                    <td> <font color="green"> <b>' . retornaAtivoEmFormatoTexto($local->ativo) . '</b> </font> </td>
                    </tr>
                    ';
        }
    }
    if ($local_off != null) {
        foreach ($local_off as $local) {
          
            echo '
            <tr>
            <td>' . $local->cod_local . '</td>
            <td> ' . $local->departamento  . '</td>
            <td><a href=#> ' . $local->sala . '</a></td>
            <td> <font color="green"> <b>' . retornaAtivoEmFormatoTexto($local->ativo) . '</b> </font> </td>
            </tr>
            ';
        }
    }
} else {
    echo '
                    <tr>
                        <td colspan="3">Nenhum local por enquanto</td>
                    </tr>
        
                ';
}
?>
</tbody>
</table>

<!----------------------------------------------------------------LOCAL----------------------------------------------------------------------------------------->

<h4 class="text-center mt-5">Disciplinas</h4>
<?php

$dao = new DaoDisciplina();
$disciplinas_on = $dao->getAllActiveDisciplinas();
$disciplinas_off = $dao->getAllInactiveDisciplinas();

if ($disciplinas_on != null or $disciplinas_off != null) {
    if ($disciplinas_on != null) {
        foreach ($disciplinas_on as $disciplina) {
            $dao = new DaoDocente();
            $docente = $dao->getDocenteObj($disciplina->fk_docente);          
            echo '

    <h5 class="text-center mt-5"> <b>' . $disciplina->nome . '</b></h5>
        <table border=1 class="table table-striped custom-table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Código</th>
                <th scope="col">Período</th>
                <th scope="col">Data de encerramento</th>
                <th scope="col">Docente</th>
                <th scope="col">Monitor</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>' . $disciplina->id . '</td>
                <td>' . $disciplina->cod_disciplina . '</td>
                <td>' . $disciplina->periodo . '</td>
                <td>' . $disciplina->data_de_encerramento . '</td>
                <td>' . $docente->nome . '</td>
                <td>
                    '. retornarmonitor($disciplina->monitor) .'
                </td>
                <td> <font color="green"> <b>' . retornaAtivoEmFormatoTexto($disciplina->ativo) . '</b> </font> </td>
                </td>
            </tr>
        </tbody>
    </table>

    <table border=1 class="table table-striped custom-table">
    <thead>
        <tr>
            <th scope="col">Matricula</th>
            <th scope="col">Nome</th>
            <th scope="col">Curso</th>
        </tr>
    </thead>
    <tbody>
        ';
        $dao = new DaoMatriculas();
        $matriculas_discentes = $dao->getAllMatriculasDiscentes($disciplina->id);
        if ($matriculas_discentes != null) {
            foreach ($matriculas_discentes as $matricula_discente) {
                $dao = new DaoDiscente();
                $discente = $dao->getDiscenteObj($matricula_discente->fk_discente);
                $dao = new DaoCurso();
                $curso = $dao->getCursoObj($discente->fk_curso);
                echo
                '

                <tr>
                <td>'. $discente->matricula .'</td>
                <td>'. $discente->nome .'</td>
                <td>'. $curso->nome .'</td>
                </tr>

                ';
            }
        
        }   else {
            echo
            '
            <tr>
                <td colspan="3">Nenhum discente nessa disciplina</td>
            </tr>
            ';
        }

        
        echo '     
        </tbody>
        </table>
            ';

            
            
        }
    }
    if ($disciplinas_off != null) {
        foreach ($disciplinas_off as $disciplina) {
            $dao = new DaoDocente();
            $docente = $dao->getDocenteObj($disciplina->fk_docente);            
            echo '

    <h5 class="text-center mt-5"><b>' . $disciplina->nome . '</b></h5>
        <table border=1 class="table table-striped custom-table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Código</th>
                <th scope="col">Período</th>
                <th scope="col">Data de encerramento</th>
                <th scope="col">Docente</th>
                <th scope="col">Monitor</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>' . $disciplina->id . '</td>
                <td>' . $disciplina->cod_disciplina . '</td>
                <td>' . $disciplina->periodo . '</td>
                <td>' . $disciplina->data_de_encerramento . '</td>
                <td>' . $docente->nome . '</td>
                <td>'. retornarmonitor($disciplina->monitor) . '  </td>
                <td> <font color="red"> <b>' . retornaAtivoEmFormatoTexto($disciplina->ativo) . '</b> </font> </td>
                </td>
            </tr>
        </tbody>
    </table>

    <table border=1 class="table table-striped custom-table">
    <thead>
        <tr>
            <th scope="col">Matricula</th>
            <th scope="col">Nome</th>
            <th scope="col">Curso</th>
        </tr>
    </thead>
    <tbody>
        ';

        $dao = new DaoMatriculas();
        $matriculas_discentes = $dao->getAllMatriculasDiscentes($disciplina->id);
        if ($matriculas_discentes != null) {
            foreach ($matriculas_discentes as $matricula_discente) {
                $dao = new DaoDiscente();
                $discente = $dao->getDiscenteObj($matricula_discente->fk_discente);
                $dao = new DaoCurso();
                $curso = $dao->getCursoObj($discente->fk_curso);
                echo
                '

                <tr>
                <td>'. $discente->matricula .'</td>
                <td>'. $discente->nome .'</td>
                <td>'. $curso->nome .'</td>
                </tr>

                ';
            }
        
        }   else {
            echo
            '
            <tr>
                <td colspan="3">Nenhum discente nessa disciplina</td>
            </tr>
            ';
        }

        
        echo '     
        </tbody>
        </table>
            ';

            
            
        }
        }
    }
    else {
    echo
    '
        <tr>
            <td colspan="3">Nenhuma disciplina cadastrada</td>
        </tr>
    ';
}

?>

