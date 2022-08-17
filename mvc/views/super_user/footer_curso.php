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

<?php
$dao = new DaoCurso();
$courses_on = $dao->getAllActiveCoursers();
$courses_off = $dao->getAllInactiveCoursers();
echo '
<h4 class="text-center mt-5">Cursos</h4>

<table border="1" class="table table-striped custom-table">
    <thead>
        <tr>
            <th scope="col">Código</th>
            <th scope="col">Nome</th>
            <th scope="col">Ativo</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>';

if ($courses_on != null or $courses_off != null) {
    if ($courses_on != null) {
        foreach ($courses_on as $course) {
            echo '
                    <tr>
                    <td> ' . $course->cod_curso . '</td>
                    <td>' . $course->nome . '</td>
                    <td> <font color="green"> <b>' . retornaAtivoEmFormatoTexto($course->ativo) . '</b> </font> </td>
                    <td> 
                    <a href="?p=admin&adm=altern-curso&id='
                    . $course->cod_curso .
                    '" ><button type="submit" class="button_red">
                    Desativar</button> 
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
                    <td> ' . $course->cod_curso . '</td>
                    <td>' . $course->nome . '</td>
                    <td> <font color="red"> <b>' . retornaAtivoEmFormatoTexto($course->ativo) . '</b> </font> </td>
                    <td> 
                    <a href="?p=admin&adm=altern-curso&id='
                    . $course->cod_curso .
                    '" ><button type="submit" class="button_green">
                    Ativar</button> 
                    </a>
                    </td>
                    </tr>
                    ';
        }
    }
} else {
    echo '
                    <tr>
                        <td colspan="4">Nenhum curso por enquanto</td>
                    </tr>
        
                ';
}
echo '
        <tr>
        <form method="post">
        <td></td>
        <td>
            <input placeholder="Nome" type="text" id="nome_curso" name="nome_curso" size="16">
        </td>
            <td></td>   
            <td>               
                <button id="adicionar_curso" type="submit" name="adicionar_curso">
                    Adicionar                    
                </button>                          
            </td>
            </form>
        </tr>
        ';
?>
</tbody>
</table>