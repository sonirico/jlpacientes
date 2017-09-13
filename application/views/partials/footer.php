        <script>
            var DT_LANGUAGE_OPTIONS = {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            };
        </script>

        <script src="//code.jquery.com/jquery-1.12.4.js" ></script>
        <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <!-- DT dependencies -->


        <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js" ></script>
        <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js" ></script>

        <!-- Editor -->
        <script src="<?php echo base_url('/assets/lib/tinymce/js/tinymce/tinymce.min.js'); ?>" ></script>

        <script src="<?php echo base_url('/assets/js/utils.js'); ?>" ></script>

        <script>tinymce.init({ selector:'textarea' });</script>

        <?php if (isset($extra_js)): ?>
            <?php foreach ($extra_js as $script_path): ?>
                <script src="<?php echo base_url($script_path); ?>" ></script>
            <?php endforeach; ?>
        <?php endif; ?>
    </body>
</html>