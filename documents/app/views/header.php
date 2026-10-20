<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token());?>">

    <title>Cardiología - <?php echo e(isset($pageTitle) ? $pageTitle : 'Inicio');?></title>

    <!--FAVICON-->
    <link rel="shortcut icon" href="../../assets/img/logo.png" type="image/x-icon">

    <!--BOOTSTRAP-->
    <link rel="stylesheet" href="../../assets/css/bootstrap/bootstrap.min.css">

    <!--FONTAWESOME (local, no depende de internet)-->
    <link rel="stylesheet" href="../../assets/css/fontawesome/all.min.css">

    <!--ANIMATE-->
    <link rel="stylesheet" href="../../assets/css/animate/animate.min.css">

    <?php if (!empty($usaTablas)) { ?>
    <!--DATATABLES-->
    <link rel="stylesheet" href="../../assets/css/datatables/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../../assets/css/datatables/responsive.dataTables.min.css">
    <link rel="stylesheet" href="../../assets/css/datatables/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="../../assets/css/datatables/buttons.bootstrap5.min.css">
    <?php } ?>

    <!--CSS-->
    <link rel="stylesheet" href="../../assets/css/estilos/estilos.css?v=<?php echo ASSET_VERSION;?>">
    <link rel="stylesheet" href="../../assets/css/estilos/accesibilidad.css?v=<?php echo ASSET_VERSION;?>">
</head>
<body class="sb-nav-fixed">
    <a href="#contenido" class="saltar-contenido">Saltar al contenido</a>
