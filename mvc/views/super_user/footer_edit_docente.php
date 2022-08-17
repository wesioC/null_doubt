<head>

<?php

    $path = $_SERVER['DOCUMENT_ROOT'];
    require_once $path . '/views/super_user/style.php';

?>

</head>
        

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

</table>
<div class="jumbotron">
    <h5 class="text-center mt-5">Docentes</h5>
</div>


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

        // FUNC EDIT
        $matricula = $_GET['id'];
        //echo $matricula;
        //

        $dao = new DaoDocente();
        $teachers_on = $dao->getAllActiveTeachers();
        $teachers_off = $dao->getAllInactiveTeachers();

        if ($teachers_on != null or $teachers_off != null) {
            if ($teachers_on != null) {
                foreach ($teachers_on as $teacher) {
                    if ($teacher->matricula == $matricula) {
                        //<td style='background: {$color}; color: #fff;'>".$registro["ipaymentstatus"]."</td>";
                        echo '
                    <tr>
                   
                    <td> <font color="purple"> <b> '  . $teacher->matricula . ' </b>  </font></td>
                    <td> <font color="purple"> <b>' . $teacher->nome . ' </b> </font> </td>
                    <td> <font color="purple"> <b>' . retornaAtivoEmFormatoTexto($teacher->ativo) . ' </b> </font> </td>
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
                <input placeholder="Novo nome" type="text" id="change_nome_docente" name="change_nome_docente" size="16">
            </td>
            <td>
                <input placeholder="Nova senha" type="password" id="change_senha_docente" name="change_senha_docente" size="7">
            </td>
           
            <td>
               
                <button id="editar_docente" type="submit" name="editar_docente">
                    Editar                    
                </button>
                
               
            </td>
     
            <td>

            </td>
            </form>
        </tr>
        ';
                    }
                    if ($teacher->matricula != $matricula) {

                        echo '
                    <tr>
                    <td>' . $teacher->matricula . '</td>
                    <td> ' . $teacher->nome . '</td>
                    <td> <font color="green">' . retornaAtivoEmFormatoTexto($teacher->ativo) . '</font> </td>
                    <td> 
                    <a href="?p=admin&adm=altern-docente&id='
                            . $teacher->matricula .
                            '" >    Desativar
                    </a>
                    </td>
                    <td> 
                    <a href="?p=admin&adm=edit-docente&id='
                            . $teacher->matricula .
                            '" >    Editar
                    </a>
                    </td>
                    </tr>
                    ';
                    }
                }
            }
            if ($teachers_off != null) {
                foreach ($teachers_off as $teacher) {
                    if ($teacher->matricula == $matricula) {
                        //<td style='background: {$color}; color: #fff;'>".$registro["ipaymentstatus"]."</td>";
                        echo '
                    <tr>
                   
                    <td> <font color="purple"> <b> '  . $teacher->matricula . ' </b>  </font></td>
                    <td> <font color="purple"> <b>' . $teacher->nome . ' </b> </font> </td>
                    <td> <font color="purple"> <b>' . retornaAtivoEmFormatoTexto($teacher->ativo) . ' </b> </font> </td>
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
                <input placeholder="Novo nome" type="text" id="change_nome_docente" name="change_nome_docente" size="16">
            </td>
            <td>
                <input placeholder="Nova senha" type="password" id="change_senha_docente" name="change_senha_docente" size="7">
            </td>
           
            <td>
               
                <button id="editar_docente" type="submit" name="editar_docente">
                    Editar                    
                </button>
                
               
            </td>
     
            <td>

            </td>
            </form>
        </tr>
        ';
                    }
                    if ($teacher->matricula != $matricula) {

                        echo '
                    <tr>
                    <td>' . $teacher->matricula . '</td>
                    <td> ' . $teacher->nome . '</td>
                    <td> <font color="green">' . retornaAtivoEmFormatoTexto($teacher->ativo) . '</font> </td>
                    <td> 
                    <a href="?p=admin&adm=altern-docente&id='
                            . $teacher->matricula .
                            '" >    Desativar
                    </a>
                    </td>
                    <td> 
                    <a href="?p=admin&adm=edit-docente&id='
                            . $teacher->matricula .
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

        //if (isset($_POST['adicionar_docente'])) {


        /*echo "<script>
            document.getElementById('adicionar_docente').addEventListener('click', function(event){
                event.preventDefault()
              });
              </script>";*/

        //echo "<script>
        //document.getElementById('adicionar_docente').addEventListener('click');
        //  </script>";

        // window.location.href='?p=admin&adm=new-docente'
        //}

        ?>
        <!-- <input placeholder="Matrícula" required type="number" name="matricula_docente" step="false" id="matricula_docente" aria-describedby="Matrícula"> -->

    </tbody>
</table>

</table>

<h5 class="text-center mt-5">Discentes</h5>

<table class="table table-striped custom-table">
    <thead>
        <tr>
            <th scope="col">Matricula</th>
            <th scope="col">Nome</th>
            <th scope="col">Monitor</th>
            <th scope="col">Ativo</th>
            <th scope="col">##</th>
        </tr>
    </thead>
    <tbody>



    </tbody>
</table>

<h5 class="text-center mt-5">Cursos</h5>

<table class="table table-striped custom-table">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">cod_curso</th>
            <th scope="col">Ativo</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $dao = new DaoCurso();
        $courses_on = $dao->getAllActiveCoursers();
        $courses_off = $dao->getAllInactiveCoursers();

        if ($courses_on != null or $courses_off != null) {
            if ($courses_on != null) {
                foreach ($courses_on as $course) {
                    echo '
                    <tr>
                    <td>' . $course->nome . '</td>
                    <td> ' . $course->cod_Curso . '</td>
                    <td> <font color="green">' . retornaAtivoEmFormatoTexto($course->ativo) . '</font> </td>
                    <td> 
                    <a href="?p=admin&adm=altern-curso&id='
                        . $course->cod_Curso .
                        '" >    Desativar
                    </a>
                    </td>
                    </tr>
                    ';
                }
            }
            if ($courses_off != null) {
                foreach ($courses_off as $course) {
                    echo '
                    <tr>
                    <td>' . $course->nome . '</td>
                    <td> ' . $course->cod_Curso . '</td>
                    <td> <font color="red">' . retornaAtivoEmFormatoTexto($course->ativo) . '</font> </td>
                    <td> 
                    <a href="?p=admin&adm=altern-curso&id='
                        . $course->cod_Curso .
                        '" >
                                 Reativar
                                 </a>
                    </td>
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

        echo '
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <tr>
        <form method="post">
            <td>
                <input placeholder="Nome do curso" type="text" id="nome_curso" name="nome_curso" size="16">
            </td>
            <td>
                <input placeholder="Código do curso" type="number" id="codigo_curso" name="codigo_curso" size="16">
            </td>         
            <td>
               
                <button id="adicionar_curso" type="submit" name="adicionar_curso" >
                    Adicionar                    
                </button>
                               
            </td>
     
            <td>

            </td>
            </form>
        </tr>
        ';
        //if (isset($_POST['adicionar_curso'])) {


        /*echo "<script>
            document.getElementById('adicionar_curso').addEventListener('click', function(event){
                event.preventDefault()
              });
              </script>";*/
        // window.location.href='?p=admin&adm=new-docente'
        //}
        ?>
    </tbody>
</table>

</div>
<!--
</table>

<h3 class="text-center mt-5">Solicitações Pendentes</h3>

<table class="table text-center table-hover">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Grupo</th>
            <th scope="col">##</th>
        </tr>
    </thead>
    <tbody>

        

    </tbody>
</table>
-->
</div>



