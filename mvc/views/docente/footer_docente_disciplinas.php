<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <style>
            thead {
                font-weight: 300;
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
        </style>
    </xsl:template>
</xsl:stylesheet>

<h3 class="text-center mt-5"> Próximos Atendimentos </h3>

<h5 class="text-center mt-5">' Grafos '</h5>
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
                <td>
                    <font color="red"> <b>Não possui </b></font>
                </td>
                <td> <font color="green"> <b>' . retornaAtivoEmFormatoTexto($disciplina->ativo) . '</b> </font> </td>
                </td>
                <td> 
                    <a href="?p=admin&adm=altern-disciplina&id='
                . $disciplina->id .
                '" >    Desativar
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
                <td>
                    <font color="red"><b> Não possui </b></font>
                </td>
                <td> <font color="red"> <b>' . retornaAtivoEmFormatoTexto($disciplina->ativo) . '</b> </font> </td>
                </td>
                <td> 
                    <a href="?p=admin&adm=altern-disciplina&id='
                . $disciplina->id .
                '" >    Reativar
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