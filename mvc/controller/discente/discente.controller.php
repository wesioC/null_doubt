<?php
if(!$_SESSION["discente"]){
    echo "<script> window.location.href='index.php?p=admin'</script> ";
}

require_once $path . '/controller/discente/discente.controller.functions.php';

if (isset($_SESSION["discente"])) {
    if (isset($_GET["dis"])) {
        $nav_discente = $_GET["dis"];
    } else {
        $dao = new DaoDiscente;
        $discente = $dao->getDiscenteObj($_SESSION['discente']);
        if ($discente->monitor == 1) {
            $nav_discente = "home-monitor";
        }  
        else {
        $nav_discente = "home";
        }
    }
} else {
    echo "<script> window.location.href='/'</script> ";
}
if(isset($_GET['action']) && $_GET['action'] == 'finalizar-agendamento'){
    // echo $_GET['cod_agendamento'];
    finalizarAgendamentoMonitor($_GET['fk_agendamento']);
}
switch ($nav_discente) {
    case "home":
        require_once $path . '/views/discente/header_discente.php';   
        require_once $path . '/views/discente/footer_discente_home.php'; 
        break;
    case "agendar":
        require_once $path . '/controller/discente/discente.controller.functions.php';
        agendar();
        break;
    case "agendar-monitoria":
        require_once $path . '/controller/discente/discente.controller.functions.php';
        agendar_monitoria();
        break;
    case "desmarcar":
        require_once $path . '/controller/discente/discente.controller.functions.php';
        desmarcar();
        break;
    case "desmarcar-monitoria":
        require_once $path . '/controller/discente/discente.controller.functions.php';
        desmarcar_monitoria();
        break;
    case "home-monitor":
        require_once $path . '/views/discente/header_monitor.php';   
        require_once $path . '/views/discente/footer_discente_home.php'; 
        break;
    case "minha-monitoria":
        require_once $path . '/views/discente/header_monitor.php';   
        require_once $path . '/views/discente/footer_monitor_home.php'; 
        break;
    case "discentes_agendados":
        require_once $path . '/views/discente/header_discente.php';     
        require_once $path . '/views/discente/footer_discente_list_discentes.php'; 
        break;
}
