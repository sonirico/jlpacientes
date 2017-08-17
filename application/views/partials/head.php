<!DOCTYPE html>
<html lang="es">
    <head>
        <?php if (isset($title)): ?>
            <title><?php echo $title; ?></title>
        <?php else: ?>
            <title>Bajas</title>
        <?php endif; ?>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="robots" content="noindex,nofollow" />
        <meta name="<?=$this->security->get_csrf_token_name();?>" content="<?=$this->security->get_csrf_hash();?>" />

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" />
        <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css" /> -->
        <link rel="stylesheet" href="<?php echo base_url('/assets/lib/font-awesome-4.7.0/css/font-awesome.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('/assets/css/common.css'); ?>" />

        <?php if (isset($extra_css)): ?>
            <?php foreach ($extra_css as $css_path): ?>
                <link href="<?php echo base_url($css_path); ?>" rel="stylesheet" />
            <?php endforeach; ?>
        <?php endif; ?>
    </head>
    <body>