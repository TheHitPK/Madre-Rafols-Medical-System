        <!--JQUERY-->
        <script src="../../assets/js/jquery/jquery-3.6.3.min.js"></script>

        <!--BOOTSTRAP (el bundle ya incluye Popper)-->
        <script src="../../assets/js/bootstrap/bootstrap.bundle.min.js"></script>

        <!--SWEETALERT-->
        <script src="../../assets/js/sweetalert/sweetalert.min.js"></script>

        <?php if (!empty($usaTablas)) { ?>
        <!--DATATABLES: solo en las páginas que muestran tablas-->
        <script src="../../assets/js/datatables/jquery.dataTables.min.js"></script>
        <script src="../../assets/js/datatables/dataTables.bootstrap5.min.js"></script>
        <script src="../../assets/js/datatables/dataTables.responsive.min.js"></script>
        <script src="../../assets/js/moment/moment.min.js"></script>
        <script src="../../assets/js/datatables/dataTables.dateTime.min.js"></script>
        <script src="../../assets/js/datatables/dataTables.buttons.min.js"></script>
        <script src="../../assets/js/datatables/buttons.bootstrap5.min.js"></script>
        <script src="../../assets/js/datatables/jszip.min.js"></script>
        <script src="../../assets/js/datatables/buttons.html5.min.js"></script>
        <script src="../../assets/js/datatables/buttons.print.min.js"></script>
        <script src="../../assets/js/datatables/buttons.colVis.min.js"></script>

        <!--PDFMAKE-->
        <script src="../../assets/js/pdfmake/pdfmake.min.js"></script>
        <script src="../../assets/js/pdfmake/vfs_fonts.js"></script>

        <!--CONFIGURACIÓN COMÚN DE TABLAS Y LOGO DE LOS PDF-->
        <script src="../../assets/js/tables/pdfLogo.js?v=<?php echo ASSET_VERSION;?>"></script>
        <script src="../../assets/js/tables/dataTablesConfig.js?v=<?php echo ASSET_VERSION;?>"></script>
        <?php } ?>

        <!--JS-->
        <script src="../../assets/js/scripts/app.js?v=<?php echo ASSET_VERSION;?>"></script>
        <script src="../../assets/js/scripts/scripts.js?v=<?php echo ASSET_VERSION;?>"></script>
    </body>
</html>
