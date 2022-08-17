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
            .button_green {
            background-color: #32CD32;
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
            <th scope="col">Ativo</th>
            <th scope="col"></th>
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
                    <td> 
                    <a href="?p=admin&adm=altern-docente&id='. $docente->matricula .'"><button type="submit" class="button_red">
                    Desativar</button> 
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
                    <td> <font color="red"> <b>' . retornaAtivoEmFormatoTexto($docente->ativo) . '</b> </font> </td>
                    <td> 
                    <a href="?p=admin&adm=altern-docente&id='. $docente->matricula .'"><button type="submit" class="button_green">
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
     
            </form>
        </tr>
        ';
?>
</tbody>
</table>