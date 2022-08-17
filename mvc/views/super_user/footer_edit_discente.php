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
?>

<h5 class="text-center mt-5">Docentes</h5>

<table class="table table-striped custom-table">
    <thead>
        <tr>
            <th scope="col">Matricula</th>
            <th scope="col">Nome</th>
            <th scope="col">Ativo</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $dao = new DaoDocente();
        $docentes_on = $dao->getAllActiveTeachers();
        $docentes_off = $dao->getAllInactiveTeachers();

        if ($docentes_on != null or $docentes_off != null) {
            if ($docentes_on != null) {
                foreach ($docentes_on as $docente) {
                    echo '
                    <tr>
                    <td>' . $docente->matricula . '</td>
                    <td> ' . $docente->nome . '</td>
                    <td> <font color="green">' . retornaAtivoEmFormatoTexto($docente->ativo) . '</font> </td>
                    <td> 
                    <a href="?p=admin&adm=altern-docente&id='
                        . $docente->matricula .
                        '" >    Desativar
                    </a>
                    </td>
                    <td> 
                    <a href="?p=admin&adm=edit-docente-1&id='
                        . $docente->matricula .
                        '" >    Editar
                    </a>
                    </td>
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
                    <td> <font color="red">' . retornaAtivoEmFormatoTexto($docente->ativo) . '</font> </td>
                    <td> 
                    <a href="?p=admin&adm=altern-docente&id='
                        . $docente->matricula .
                        '" >
                                 Reativar
                                 </a>
                    </td>
                    <td> 
                    <a href="?p=admin&adm=edit-docente-1&id='
                        . $docente->matricula .
                        '" >    Editar
                    </a>
                    </td>
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

        echo '
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <tr>
        <form method="post">
            <td>
                <input placeholder="Matricula" type="text" id="matricula_docente" name="matricula_docente" size="16">
            </td>
            <td>
                <input placeholder="Nome" type="text" id="nome_docente" name="nome_docente" size="16">
            </td>
            <td>
                <input placeholder="Senha" type="password" id="senha_docente" name="senha_docente" size="4">
            </td>
           
            <td>
               
                <button id="adicionar_docente" type="submit" name="adicionar_docente">
                    Adicionar                    
                </button>
                
               
            </td>
     
            <td>

            </td>
            </form>
        </tr>
        ';
        ?>
    </tbody>
</table>

<h5 class="text-center mt-5">Discentes</h5>

<table class="table table-striped custom-table">
    <thead>
        <tr>
            <th scope="col">Matricula</th>
            <th scope="col">Nome</th>
            <th scope="col">Curso</th>
            <th scope="col">Ativo</th>
            <th scope="col">Monitor</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $matricula = $_GET['id'];
        $dao = new DaoDiscente();
        $discentes_on = $dao->getAllActiveDiscentes();
        $discentes_off = $dao->getAllInactiveDiscentes();

        if ($discentes_on != null or $discentes_off != null) {
            if ($discentes_on != null) {
                foreach ($discentes_on as $discente) {
                    if ($discente->matricula == $matricula) {
                        //<td style='background: {$color}; color: #fff;'>".$registro["ipaymentstatus"]."</td>";
                        echo '
                    <tr>
                   
                    <td> <font color="purple"> <b> '  . $discente->matricula . ' </b>  </font></td>
                    <td> <font color="purple"> <b>' . $discente->nome . ' </b> </font> </td>
                    <td> <font color="purple"> <b>' . retornaAtivoEmFormatoTexto($discente->ativo) . ' </b> </font> </td>
                    <td> 
                    <font color="purple"> <b> Editando</font> </b> </td>
                    </td>
                    <td> 
                    
                    </td>
                    </tr>
                    ';
                        echo '
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <tr>
        <form method="post">
            <td>
                
            </td>
            <td>
                <input placeholder="Novo nome" type="text" id="change_nome_discente" name="change_nome_discente" size="16">
            </td>
            <td>
                <input placeholder="Cód de curso" type="text" id="change_curso_discente" name="change_curso_discente" size="16">
            </td>
            <td>
                <input placeholder="Nova senha" type="password" id="change_senha_discente" name="change_senha_discente" size="7">
            </td>
           
            <td>
               
                <button id="editar_discente" type="submit" name="editar_discente">
                    Editar                    
                </button>
                
               
            </td>
     
            <td>

            </td>
            </form>
        </tr>
        ';
                    }
                    if ($discente->matricula != $matricula) {
                        $dao = new DaoCurso();
                        $curso = $dao->getCursoObj($discente->fk_Curso);

                        echo '
                    <tr>
                    <td>' . $discente->matricula . '</td>
                    <td> ' . $discente->nome . '</td>
                    <td> ' . $curso->nome . '</td>
                    <td> <font color="green">' . retornaAtivoEmFormatoTexto($discente->ativo) . '</font> </td>
                    <td> ' . $discente->monitor . '</td>
                    <td> 
                    <a href="?p=admin&adm=altern-discente&id='
                            . $discente->matricula .
                            '" >    Desativar
                    </a>
                    </td>
                    <td> 
                    <a href="?p=admin&adm=edit-discente-1&id='
                            . $discente->matricula .
                            '" >    Editar
                    </a>
                    </td>
                    </tr>
                    ';
                    }
                }
            }
            if ($discentes_off != null) {
                foreach ($discentes_off as $discente) {
                    if ($discente->matricula == $matricula) {
                        //<td style='background: {$color}; color: #fff;'>".$registro["ipaymentstatus"]."</td>";
                        echo '
                    <tr>
                   
                    <td> <font color="purple"> <b> '  . $discente->matricula . ' </b>  </font></td>
                    <td> <font color="purple"> <b>' . $discente->nome . ' </b> </font> </td>
                    <td> <font color="purple"> <b>' . retornaAtivoEmFormatoTexto($discente->ativo) . ' </b> </font> </td>
                    <td> 
                    <font color="purple"> <b> Editando</font> </b> </td>
                    </td>
                    <td> 
                    
                    </td>
                    </tr>
                    ';
                        echo '
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <tr>
        <form method="post">
            <td>
                
            </td>
            <td>
                <input placeholder="Novo nome" type="text" id="change_nome_discente" name="change_nome_discente" size="16">
            </td>
            <td>
                <input placeholder="Cód de curso" type="text" id="change_curso_discente" name="change_curso_discente" size="16">
            </td>
            <td>
                <input placeholder="Nova senha" type="password" id="change_senha_discente" name="change_senha_discente" size="7">
            </td>
           
            <td>
               
                <button id="editar_discente" type="submit" name="editar_discente">
                    Editar                    
                </button>
                
               
            </td>
     
            <td>

            </td>
            </form>
        </tr>
        ';
                    }
                    if ($discente->matricula != $matricula) {
                        $dao = new DaoCurso();
                        $curso = $dao->getCursoObj($discente->fk_Curso);

                        echo '
                    <tr>
                    <td>' . $discente->matricula . '</td>
                    <td> ' . $discente->nome . '</td>
                    <td> ' . $curso->nome . '</td>
                    <td> <font color="green">' . retornaAtivoEmFormatoTexto($discente->ativo) . '</font> </td>
                    <td> ' . $discente->monitor . '</td>
                    <td> 
                    <a href="?p=admin&adm=altern-discente&id='
                            . $discente->matricula .
                            '" >    Desativar
                    </a>
                    </td>
                    <td> 
                    <a href="?p=admin&adm=edit-discente-1&id='
                            . $discente->matricula .
                            '" >    Editar
                    </a>
                    </td>
                    </tr>
                    ';
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

        echo '
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <tr>
        <form method="post">
            <td>
                <input placeholder="Matricula" type="text" id="matricula_discente" name="matricula_discente" size="16">
            </td>
            <td>
                <input placeholder="Nome" type="text" id="nome_discente" name="nome_discente" size="16">
            </td>
            <td>
                <input placeholder="Cód do Curso" type="text" id="codigo_do_curso_discente" name="codigo_do_curso_discente" size="16">
            </td>
            <td>
                <input placeholder="Senha" type="password" id="senha_discente" name="senha_discente" size="4">
            </td>
           
            <td>
               
                <button id="adicionar_discente" type="submit" name="adicionar_discente">
                    Adicionar                    
                </button>
                
               
            </td>
     
            <td>

            </td>
            </form>
        </tr>
        ';
        ?>
    </tbody>
</table>

</table>


