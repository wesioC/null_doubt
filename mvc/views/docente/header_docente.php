<head>
<?php

$path = 'C:\xampp\htdocs\app\last\php\mvc';
    require_once $path . '/views/super_user/style.php';

    ?>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark navbar-offcanvas" style="background-color: #38B6FF">
        <div class="container-fluid">
            <a href='index.php?p=docente' class="thumbnail">
                <!-- https://i.ibb.co/MZLxpBq/avatar-null-doubt-VERTICAL-COM-NOME-BRANCO.png -->
                <img class="img-200-200" src="https://raw.githubusercontent.com/pedroLimaifg/nulldoubt/main/atividade/NullDoubt/avatar%20null%20doubt%20-%20VERTICAL%20COM%20NOME%20-%20BRANCO.png" />
            </a>


            <ul class="navbar-nav navbar-top">
                <b>
                    <li class="nav-item active">
                        <a class="nav-link" href='index.php?p=docente' type="submit" name="home"> Home <span class="sr-only"></span></a>
                    </li>
                </b>
                <b>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" href="#!" id="dropdownExample" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Atendimentos</a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownExample">
                        <a class="dropdown-item" href="index.php?p=docente&doc=atendimentos">Gerenciar Atendimentos</a>
                        <!--
                        <a class="dropdown-item" href="">Histórico de Atendimentos</a>-->
                    </div>
                </li>
                </b>
                <b>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" href="#!" id="dropdownExample" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Monitoria</a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownExample">
                        <a class="dropdown-item" href="index.php?p=docente&doc=monitores">Gerenciar Monitores</a>
                    </div>
                </li>
                </b>
                <b>
                    <!--
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" href="#!" id="dropdownExample" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Históricos</a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownExample">
                        <a class="dropdown-item" href="">Histórico Recentes</a>
                        <a class="dropdown-item" href="">Histórico Completo</a>
                    </div>
                </li>
-->
                </b>
                <li class="nav-item active">
                    <a class="nav-link" href='?p=logout' type="submit" name="logout">Sair<span class="sr-only"></span></a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="wrapper mt-4">
        <div class="container">
            <div class="row">
                <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
                <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js'></script>
                <script src="../script.js"></script>

