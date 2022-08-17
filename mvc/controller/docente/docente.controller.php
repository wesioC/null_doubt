<?php
if(!$_SESSION["docente"]){
    echo "<script> window.location.href='index.php?p=admin'</script> ";
}
require_once $path . '/controller/docente/docente.controller.functions.php';

if (isset($_SESSION["docente"])) {

    if (isset($_GET["doc"])) {
        $nav_docente = $_GET["doc"];
    } else {
        $nav_docente = "home";
    }
} else {
    echo "<script> window.location.href='/'</script> ";
}

if(isset($_POST['agendamento-docente'])){
    createAgendamentoDocente();
}

if(isset($_POST['add-monitor'])){
    ativaMonitor();
}

if(isset($_POST['novo-horario-monitor'])){
    createMonitoria($_GET['matricula'], $_GET['id']);
}

if(isset($_GET['action']) && $_GET['action'] == 'delete-monitor'){
    desativaMonitor($_GET['matricula'], $_GET['id']);
}
if(isset($_GET['action']) && $_GET['action'] == 'delete-horario-monitor'){
    excluirMonitoria($_GET['cod_monitoria']);
}
if(isset($_GET['action']) && $_GET['action'] == 'delete-agendamento'){
    // echo $_GET['cod_agendamento'];
    excluirAgendamentoDocente($_GET['cod_agendamento']);
}
if(isset($_GET['action']) && $_GET['action'] == 'finalizar-agendamento'){
    // echo $_GET['cod_agendamento'];
    finalizarAgendamentoDocente($_GET['fk_agendamento']);
}

switch ($nav_docente) {
    case "home":
        require_once $path . '/views/docente/header_docente.php';   
        require_once $path . '/views/docente/footer_docente_home.php'; 
        break;
    case "atendimentos":
        require_once $path . '/views/docente/header_docente.php';   
        require_once $path . '/views/docente/footer_docente_atendimentos.php'; 
        break;
    case "monitores":
        require_once $path . '/views/docente/header_docente.php';   
        require_once $path . '/views/docente/footer_docente_monitores.php'; 
        break;
    case "horarios-monitor":
        require_once $path . '/views/docente/header_docente.php';   
        require_once $path . '/views/docente/footer_docente_horarios_monitores.php'; 
        break;
    case "discentes_agendados":
        require_once $path . '/views/docente/header_docente.php';   
        require_once $path . '/views/docente/footer_docente_list_discentes.php'; 
        break;
    case "altern-agendamento":
        require_once $path . '/controller/docente/docente.controller.functions.php';
        alternaStatusAgendamento();
        break;
    default:
        break;
}
