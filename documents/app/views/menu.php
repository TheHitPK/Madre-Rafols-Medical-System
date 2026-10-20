<?php
    // Marca el enlace de la página actual (visualmente y para lectores de pantalla)
    function atributos_menu($archivo){
        $actual = basename($_SERVER['SCRIPT_NAME']);
        return $actual === $archivo ? 'class="nav-link active" aria-current="page"' : 'class="nav-link"';
    }
?>
<nav class="sb-topnav navbar navbar-expand navbar-dark" aria-label="Barra superior" style="background-color: #001d3d;">

    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="home.php"><img src="../../assets/img/main_logo.png" alt="<?php echo e(nombre_sistema());?> - ir al inicio" width="50" height="50"></a>

    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" type="button" aria-label="Mostrar u ocultar el menú lateral"><i class="fas fa-bars"></i></button>

    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></form>
    <div class="small text-light">Bienvenido (a): <strong><?php echo e($_SESSION["nombre_usuario"]." ".$_SESSION["apellido_usuario"]);?></strong></div>&nbsp;
    
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Menú de usuario"><i class="fas fa-user fa-fw" aria-hidden="true"></i></a>
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
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" aria-label="Menú principal" style="background-color: #001d3d;">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Inicio</div>
                    <a <?php echo atributos_menu('home.php');?> href="home.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-table-columns" aria-hidden="true"></i></div>
                        Dashboard
                    </a>

                    <?php
                        if (puede_ver_area(AREA_CARDIOLOGIA)) {
                    ?>
                    <div class="sb-sidenav-menu-heading">Cardiología</div>

                    <a <?php echo atributos_menu('ecocardiogramas.php');?> href="ecocardiogramas.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-heart-circle-check" aria-hidden="true"></i></div>
                        Ecocardiogramas
                    </a>

                    <a <?php echo atributos_menu('holters.php');?> href="holters.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-file-waveform" aria-hidden="true"></i></div>
                        Holters
                    </a>

                    <a <?php echo atributos_menu('mapas.php');?> href="mapas.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-stethoscope" aria-hidden="true"></i></div>
                        Mapas
                    </a>
                    <?php
                        }
                        if (puede_ver_area(AREA_IMAGENES)) {
                    ?>
                    <div class="sb-sidenav-menu-heading">Imágenes</div>

                    <a <?php echo atributos_menu('imagenes.php');?> href="imagenes.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-x-ray" aria-hidden="true"></i></div>
                        Estudios de imágenes
                    </a>
                    <?php
                        }
                    ?>

                    <div class="sb-sidenav-menu-heading">Pacientes</div>

                    <a <?php echo atributos_menu('pacientes.php');?> href="pacientes.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-hospital-user" aria-hidden="true"></i></div>
                        Historial de pacientes
                    </a>

                    <?php
                        if (es_admin()) {
                    ?>
                            <div class="sb-sidenav-menu-heading">Módulos</div>

                                <a <?php echo atributos_menu('users.php');?> href="users.php">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users" aria-hidden="true"></i></div>
                                    Usuarios
                                </a>

                                <a <?php echo atributos_menu('auditoria.php');?> href="auditoria.php">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-clipboard-list" aria-hidden="true"></i></div>
                                    Auditoría
                                </a>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="sb-sidenav-footer" style="background-color: #003566;">
                <div class="small">Sesión Activa:</div>
                <i class="fa-solid fa-user" aria-hidden="true"></i> <?php echo e($_SESSION["rol"]);?><?php if (!es_admin() && isset($_SESSION["departamento"])) { echo " - " . e($_SESSION["departamento"]); }?>
            </div>
        </nav>
    </div>