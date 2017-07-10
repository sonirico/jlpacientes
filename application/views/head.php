<!DOCTYPE html>
<html lang="es">
    <head>
        <?php if (isset($title)): ?>
            <title><?php echo $title; ?></title>
        <?php else: ?>
            <title>Pacientes</title>
        <?php endif; ?>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="robots" content="noindex,nofollow" />

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css" />

        <?php foreach ($extra_css as $css_path): ?>
            <link href="<?php echo $css_path; ?>" rel="stylesheet" />
        <?php endforeach; ?>
    </head>
    <body>