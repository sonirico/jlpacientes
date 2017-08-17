        <script>
            var DT_LANGUAGE_URL = 'https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json';
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