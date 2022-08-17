<?php

$path = 'C:\xampp\htdocs\app\last\php\mvc';
require_once $path . '/models/class/discente.class.php';
require_once $path . '/models/class/docente.class.php';
require_once $path . '/controller/dao/daosuperuser.php';
require_once $path . '/controller/dao/daodocente.php';
require_once $path . '/controller/dao/daodiscente.php';

if (isset($_POST['login'])) {
    if ($_POST['tipo'] == 4) {
        $_POST['admin'] = true;
    }
    if ($_POST['tipo'] == 2) {
        $_POST['docente'] = true;
    }
    if ($_POST['tipo'] == 1) {
        $_POST['discente'] = true;
    }
}

if (isset($_POST['admin'])) {
    $matricula = $_POST['matricula'];
    $senha = $_POST['senha'];

    $dao = new DaoSuperUser();
    $dao->login($matricula, $senha);
} elseif (isset($_POST['docente'])) {
    $matricula = $_POST['matricula'];
    $senha = $_POST['senha'];

    $dao = new DaoDocente();
    $dao->login($matricula, $senha);
} elseif (isset($_POST['discente'])) {
    $matricula = $_POST['matricula'];
    $senha = $_POST['senha'];

    $dao = new DaoDiscente();
    $dao->login($matricula, $senha);
} else {
    $page = 'login_errado';
}
