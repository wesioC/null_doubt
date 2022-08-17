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
if ($_SESSION["super_user"]) {

    if (isset($_GET["adm"])) {
        $admin = $_GET["adm"];
    } else {
        $admin = "home";
    }
} else {
    echo "<script> window.location.href='index.php'</script> ";
}

if (isset($_POST['adicionar_docente'])) {
    $admin = "new-docente";
}

if (isset($_POST['editar_docente'])) {
    $admin = "edit-docente-2";
}

if (isset($_POST['adicionar_curso'])) {
    $admin = "new-curso";
}
if (isset($_POST['editar_curso'])) {
    $admin = "editar-curso";
}

if (isset($_POST['adicionar_discente'])) {
    $admin = "new-discente";
}
if (isset($_POST['editar_discente'])) {
    $admin = "edit-discente-2";
}

if (isset($_POST['adicionar_local'])) {
    $admin = "new-local";
}

if (isset($_POST['adicionar_disciplina'])) {
    $admin = "new-disciplina";
}




switch ($admin) {
    case "home":
        require_once $path . '/views/super_user/header.php';
        require_once $path . '/views/super_user/footer_super_user.php';
        break;
    case "cursos":
        require_once $path . '/views/super_user/header.php';
        require_once $path . '/views/super_user/footer_curso.php';
        break;
    case "docentes":
        require_once $path . '/views/super_user/header.php';
        require_once $path . '/views/super_user/footer_docente.php';
        break;
    case "discentes":
        require_once $path . '/views/super_user/header.php';
        require_once $path . '/views/super_user/footer_discente.php';
        break;
    case "monitores":
        require_once $path . '/views/super_user/header.php';
        require_once $path . '/views/super_user/footer_monitor.php';
        break;
    case "disciplinas":
        require_once $path . '/views/super_user/header.php';
        require_once $path . '/views/super_user/footer_disciplina.php';
        break;
    case "locais":
        require_once $path . '/views/super_user/header.php';
        require_once $path . '/views/super_user/footer_locais.php';
        break;

    case "altern-curso":
        require_once $path . '/controller/super_user/super_user.controller.curso.php';
        alternaStatusCurso();
        break;
    case "altern-docente":
        require_once $path . '/controller/super_user/super_user.controller.docente.php';
        alternaStatusDocente();
        break;
    case "altern-discente":
        require_once $path . '/controller/super_user/super_user.controller.discente.php';
        alternaStatusDiscente();
        break;
    case "altern-disciplina":
        require_once $path . '/controller/super_user/super_user.controller.disciplina.php';
        alternaStatusDisciplina();
        break;
    case "altern-local":
        require_once $path . '/controller/super_user/super_user.controller.local.php';
        alternaStatusLocal();
        break;
    case "altern-discente-monitor":
        require_once $path . '/controller/super_user/super_user.controller.discente.php';
        alternaStatusDiscenteMonitor();
        break;

    case "new-curso":
        require_once $path . '/views/super_user/header.php';
        require_once $path . '/controller/super_user/super_user.controller.curso.php';
        if (isset($_POST['nome_curso'])) {
            novoCurso();
        }
        require_once $path . '/views/super_user/footer_curso.php';
        break;
    case "new-local":
        require_once $path . '/views/super_user/header.php';
        require_once $path . '/controller/super_user/super_user.controller.local.php';
        if (isset($_POST['sala_local']) AND isset($_POST['departamento_local'])) {
            novoLocal();
        }
        require_once $path . '/views/super_user/footer_locais.php';
        break;
    case "new-docente":
        require_once $path . '/views/super_user/header.php';
        require_once $path . '/controller/super_user/super_user.controller.docente.php';
        if (isset($_POST['matricula_docente'])) {
            novoDocente();
        }
        require_once $path . '/views/super_user/footer_docente.php';
        break;

    case "new-discente":
        require_once $path . '/views/super_user/header.php';
        require_once $path . '/controller/super_user/super_user.controller.discente.php';
        if (isset($_POST['matricula_discente'])) {
            novoDiscente();
        }
        require_once $path . '/views/super_user/footer_discente.php';
        break;
    case "new-disciplina":
        require_once $path . '/views/super_user/header.php';
        require_once $path . '/controller/super_user/super_user.controller.disciplina.php';
            createDisciplina();
        require_once $path . '/views/super_user/footer_disciplina.php';
        break;

    case "edit-docente-1":
        require_once $path . '/views/super_user/header.php';
        require_once $path . '/controller/super_user/super_user.controller.docente.php';
        //alternaStatusDocente();
        require_once $path . '/views/super_user/footer_edit_docente.php';
        break;
    case "edit-docente-2":
        require_once $path . '/views/super_user/header.php';
        require_once $path . '/controller/super_user/super_user.controller.docente.php';
        if (isset($_POST['change_nome_docente'])) {
            //echo 'teste do edit-docente-two';
            //echo $_POST['change_nome_docente'];
            editarDocente();
        }
        require_once $path . '/views/super_user/footer_super_user.php';
        break;
    case "edit-discente-1":
        require_once $path . '/views/super_user/header.php';
        require_once $path . '/controller/super_user/super_user.controller.discente.php';
        //alternaStatusDocente();
        require_once $path . '/views/super_user/footer_edit_discente.php';
        break;
    case "edit-discente-2":
        require_once $path . '/views/super_user/header.php';
        require_once $path . '/controller/super_user/super_user.controller.discente.php';
        if (isset($_POST['change_nome_discente'])) {
            editarDiscente();
        }
        require_once $path . '/views/super_user/footer_super_user.php';
        break;
}
