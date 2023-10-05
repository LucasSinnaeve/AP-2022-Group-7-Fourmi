<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>BoxFourmie</title>
    <!-- Intégration des fichiers CSS de Bootstrap -->
    <link rel="stylesheet" href="bootstrap-5.3.0-alpha1-dist/css/bootstrap.css">
</head>
<body>
<header>
    <!-- Contenu de votre en-tête -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Fourmie</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php if (isset($_SESSION["connection"])) { ?>
                <li class="nav-item active">
                    <a class="nav-link" href="mesbox.php">Mes Boxes</a>
                </li>
                <?php } ?>
                <?php if (!isset($_SESSION["connection"])) {  ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                <?php } ?>
                <div style="margin-left: 800px">
                <?php if (!isset($_SESSION["connection"])) {  ?>
                    <li class="nav-item">
                        <a class="nav-link" href="conn.php">Connexion</a>
                    </li>
                </div>
                <?php }else{ ?>
                <li class="nav-item">
                    <a class="nav-link" href="Deco.php">Deconnexion</a>
                </li>
                </div>

                <?php } ?>

            </ul>
        </div>
    </nav>
</header>
