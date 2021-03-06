<!DOCTYPE html>
<html>
    <head>
        <title>La Cagette &rsaquo; Mon Espace</title>
        <link href="<?php echo URL; ?>css/bootstrap.min.css" rel="stylesheet" type='text/css'>
        <link href="<?php echo URL; ?>css/louve-styles.css" rel="stylesheet" type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,700,900,300' rel='stylesheet' type='text/css'>
        <!-- TODO_NOW: pour les deux feuilles de style suivantes, elles ne servent que pour les pages d'ajout d'urgence
         +> faire un import uniquement pour ces pages -->
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>css/easyui.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>css/icon.css">
        <!--
        Lien vers les differentes favicons
        -->
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="/manifest.json">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="theme-color" content="#b96e51">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Boostrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- TODO_LATER pour les librairies easyui et edatagrid ne les importer que dans les pages de management -->
        <script type="text/javascript" src="<?php echo URL . 'js/jquery.easyui.min.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo URL . 'js/jquery.edatagrid.js'; ?>"></script>
        <meta charset="UTF-8">
        <style type="text/css">
            @font-face {
                font-family: 'Glyphicons Halflings';
                src: url('public/fonts/glyphicons-halflings-regular.eot');
            }
        </style>
    </head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo URL; ?>"><img alt="La Cagette" src="<?php echo URL; ?>img/Cagette_logo.png" width="37px"/></a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#louvenav" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="nav navbar-nav collapse navbar-collapse" id="louvenav">
            <li><a href="<?php echo URL . 'home/participation'; ?>"><span class="glyphicon glyphicon-time" style="color:grey"></span> MES SERVICES</a></li>
            <li><a href="<?php echo URL . 'home/tdb'; ?>"><span class="glyphicon glyphicon-check" style="color:grey"></span> TABLEAU DE BORD</a></li>
            <li><a href="<?php echo URL . 'home/comites'; ?>"><span class="glyphicon glyphicon-thumbs-up" style="color:grey"></span> COMITÉS</a></li>
            <li><a href="<?php echo URL . 'home/calendar'; ?>"><span class="glyphicon glyphicon-calendar" style="color:grey"></span> AGENDA</a></li>
             <li><a href="https://forum.lacagette-coop.fr"><span class="glyphicon glyphicon-edit" style="color:grey"></span> FORUM EN LIGNE</a></li>
            <!--
             <li><a href="<?php echo URL . 'home/wiki'; ?>"><span class="glyphicon glyphicon-blackboard" style="color:grey"></span> ORGANISATION</a></li>
            -->
             <!--
            <li><a href="<?php echo URL . 'shift/ftopshifts'; ?>"><span class="glyphicon glyphicon-ok" style="color:grey"></span> VOLANTS</a></li>
            
           
            <li><a href="<?php echo URL . 'home/services'; ?>"><span class="glyphicon glyphicon-ok" style="color:grey"></span> OUTILS</a></li>
            <li><a href="<?php echo URL . 'forum'; ?>"><span class="glyphicon glyphicon-earphone" style="color:grey"></span> FORUM</a></li>
           
            -->
            <?php
            /**
            if ($user->isAdmin()) {
                echo(' <li><a href="'.URL . 'management"><span class="glyphicon glyphicon-plus" style="color:grey"></span> GESTION </a></li>');
            }
            if ($emergency->isActive()) {
                $emergencyStyle = "color:lightcoral";
                echo '<li><a href="' . URL . 'emergency/" style="' . $emergencyStyle . ';"><span class="glyphicon glyphicon-alert urgences"></span> URGENCES</a></li>';
            }
            **/
        ?>
        </div>
        <ul class="nav navbar-inverse navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Bonjour,
                     <?php echo $user->getFirstName(); ?>
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo URL . 'home/myinfo/'; ?>">Mes informations</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?php echo URL . 'login/logout/'; ?>">Déconnexion</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

