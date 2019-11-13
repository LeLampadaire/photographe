<?php 
	require_once("configuration.php"); 
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $NomSite; ?> - Services</title>
    <link rel="icon" href="<?= $favicon ?>" />
    <?php require_once("link.php"); ?>
</head>
<body class="text-center">

    <!-- HEADER -->
    <?php require_once("header.php"); ?>
    <!-- HEADER -->

    <div class="container">
        <br><br>
        <div class="alert alert-success" role="alert">Demande envoyé avec succès, vous serez recontacté par mail !</div>

        <a href="information.php#services" alt="Accueil"><button class="btn btn-primary">Retour</button></a>
        <br><br>
    </div>

    <!-- FOOTER -->
    <?php require_once("footer.php"); ?>
    <!-- FOOTER -->

    <?php require_once("script.php"); ?>

</body>
</html>