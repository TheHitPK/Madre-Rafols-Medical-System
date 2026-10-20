<nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color: #001d3d;">

    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="home.php"><img src="../../assets/img/main_logo.png" alt="MODINES" width="50" height="50"></a>

    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></form>
    <div class="small text-light">Bienvenido (a): <strong><?php echo e($_SESSION["nombre_usuario"]." ".$_SESSION["apellido_usuario"]);?></strong></div>&nbsp;
    
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li>
                    <form action="../controllers/sessions/userLogout.php" method="post" class="m-0">
                        <input type="hidden" name="csrf_token" value="<?php echo e(csrf_token());?>">
                        <button type="submit" class="dropdown-item"><i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar Sesión</button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color: #001d3d;">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Inicio</div>
                    <a class="nav-link" href="home.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-table-columns"></i></div>
                        Dashboard
                    </a>

                    <div class="sb-sidenav-menu-heading">Exámenes</div>

                    <a class="nav-link" href="ecocardiogramas.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-heart-circle-check"></i></div>
                        Ecocardiogramas
                    </a>

                    <a class="nav-link" href="holters.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-file-waveform"></i></div>
                        Holters
                    </a>

                    <a class="nav-link" href="mapas.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-stethoscope"></i></div>
                        Mapas
                    </a>

                    <a class="nav-link" href="pacientes.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-hospital-user"></i></div>
                        Historial de pacientes
                    </a>

                    <?php
                        if (es_admin()) {
                    ?>
                            <div class="sb-sidenav-menu-heading">Módulos</div>

                                <a class="nav-link" href="users.php">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                                    Usuarios
                                </a>

                                <a class="nav-link" href="auditoria.php">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-clipboard-list"></i></div>
                                    Auditoría
                                </a>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="sb-sidenav-footer" style="background-color: #003566;">
                <div class="small">Sesión Activa:</div>
                <i class="fa-solid fa-user"></i> <?php echo e($_SESSION["rol"]);?>
            </div>
        </nav>
    </div>