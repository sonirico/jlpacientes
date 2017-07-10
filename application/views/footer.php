        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

        <!-- DT dependencies -->

        <script src="//code.jquery.com/jquery-1.12.4.js" ></script>
        <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js" ></script>
        <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js" ></script>

        <!-- Editor -->
        <script src="https://mindmup.github.io/bootstrap-wysiwyg/bootstrap-wysiwyg.js" ></script>
        <script src="assets/js/jquery.hotkeys.js" ></script>

        <?php foreach ($extra_js as $script_path): ?>
            <script src="<?php echo $script_path; ?>" ></script>
        <?php endforeach; ?>
    </body>
</html>