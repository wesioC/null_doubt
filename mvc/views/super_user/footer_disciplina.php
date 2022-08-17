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

    <h5 class="text-center mt-5">' . $disciplina->nome . '</h5>
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
                <th scope="col"></th>
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
                <td> <font color="green"> <b>' . retornaAtivoEmFormatoTexto($disciplina->ativo) . '</b> </font> </td>
                <td> 
                    <a href="?p=admin&adm=altern-disciplina&id='
                    . $disciplina->id .
                    '"><button type="submit" class="button_red">
                    Desativar</button> 
                    </a>
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

    <h5 class="text-center mt-5">' . $disciplina->nome . '</h5>
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
                <th scope="col"></th>
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
                <td> 
                    <a href="?p=admin&adm=altern-disciplina&id='
                    . $disciplina->id .
                    '"><button type="submit" class="button_green">
                    Ativar</button> 
                    </a>
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

<h3 class="text-center mt-5">Nova Disciplina</h3>

<table border="1" class="table table-striped custom-table">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Código</th>
            <th scope="col">Período</th>
            <th scope="col">Data de encerramento</th>
            <th scope="col">Docente</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <form  method="post">
    <tr>
        <td>
            <input placeholder="Nome" type="text" id="nome_da_disciplina" name="nome_da_disciplina" size="16">
        </td>
        <td>
            <input placeholder="Código" type="text" id="codigo_disciplina" name="codigo_disciplina" size="16">
        </td>
        <td>
            <select name="periodo_disciplina" id="periodo_disciplina">
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
        </td>
        <td>
            <input placeholder="Data" type="date" id="data_disciplina" name="data_disciplina" size="16">
        </td>
        <td>
            <select name="docente_disciplina" id="docente_disciplina">
                <?php
                $dao = new DaoDocente();
                $docentes = $dao->getAllActiveTeachers();

                foreach ($docentes as $docente) {
                    echo '<option value=' .
                        $docente->matricula .
                        '>' .
                        $docente->nome .
                        '</option>
                        ';
                }
                ?>
            </select>
        </td>
        <td>  
            <button id="adicionar_disciplina" type="submit" name="adicionar_disciplina">
                Adicionar                    
            </button>     
        </td>
            
    </tr>
    </form>
    </tbody>
</table>


