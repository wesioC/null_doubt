<?php
session_start();


require_once './views/header.php';
require_once './models/class/docente.class.php';
require_once './models/class/super_user.class.php';
require_once './models/class/discente.class.php';
require_once './models/class/curso.class.php';
require_once './models/class/agendados.class.php';
require_once $path . '/models/class/agendamento.class.php';
require_once $path . '/models/class/monitoria.class.php';
require_once 'dao/daocurso.php';
require_once 'dao/daolocal.php';
require_once 'dao/daodocente.php';
require_once 'dao/daodiscente.php';
require_once 'dao/daodisciplina.php';
require_once 'dao/daomatriculas.php';
require_once 'dao/daoagendamento.php';
require_once 'dao/daomonitoria.php';
require_once 'dao/daoagendados.php';
require_once 'dao/daoagendadosmonitoria.php';
$path = 'C:\xampp\htdocs\app\last\php\mvc';

if (isset($_GET['p'])) {
    $page = $_GET['p'];
} else {
    $page = 'login';
}

if (isset($_POST['logout'])) {
    $page = 'logout';
}

switch ($page) {
    case 'login':
        require_once './views/login.php';
        require_once $path . '/controller/login.controller.php';
        break;
    case 'admin':
        if ($_SESSION['super_user']) {
            require_once $path .
                '/controller/super_user/super_user.controller.php';
        } else {
            echo "<script> window.location.href='/'</script> ";
        }
        break;
    case 'docente':
        if (isset($_SESSION['docente'])) {
            $id_docente = $_SESSION['docente'];
            $matricula = $id_docente;
            require_once $path . '/controller/docente/docente.controller.php';
        } else {
            echo "<script> window.location.href='/'</script> ";
        }
        break;
    case 'discente':
        if (isset($_SESSION['discente'])) {
            $id_discente = $_SESSION['discente'];
            $matricula = $id_discente;
            require_once $path . '/controller/discente/discente.controller.php';
        } else {
            echo "<script> window.location.href='/'</script> ";
        }
        break;
    case 'logout':
        session_unset();
        $_SESSION['super_user'] = false;
        $_SESSION['docente'] = false;
        $_SESSION['discente']= false;
        echo "<script> window.location.href='/'</script> ";
        break;
    default:
    echo "<script> window.location.href='/'</script> ";
        break;
}
?>

<?php require_once './views/footer.php';
?>
