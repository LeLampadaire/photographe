<?php 
    require_once("configuration.php"); 
    require_once("bdd_connexion.php");

    $categories = mysqli_query($bdd, 'SELECT * FROM categories;');
    $categoriesTest = mysqli_fetch_array($categories, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $NomSite; ?> - Portefolio</title>
    <link rel="icon" href="<?= $favicon ?>" />
    <?php require_once("link.php"); ?>
</head>
<body onselectstart="return false" oncontextmenu="return false" ondragstart="return false" onMouseOver="window.status='..message perso .. '; return true;">

    <!-- HEADER -->
    <?php require_once("header.php"); ?>
    <!-- HEADER -->

    <div class="container espacePaddingGaucheDroite25px">
        <div class="row">

            <?php if($categoriesTest != NULL){ ?>
                <?php foreach($categories as $donnees){?>
                    <div class="col-md-6 col-lg-4 espaceEntreCol">
                        <div class="card text18rem">
                            <img src="<?php echo $donnees['image']; ?>" class="card-img-top" alt="<?php echo $donnees['nom']; ?>">
                            <div class="card-body">
                                <h3 class="card-title"><?php echo $donnees['nom']; ?></h3>
                                <p class="card-text"><?php echo $donnees['description']; ?></p>
                                <a href="portefolio.php?categorie=<?php echo $donnees['id']; ?>" class="btn btn-primary">S'y rendre</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php }else{ ?>
                <div class="container text-center"><div class="alert alert-danger" role="alert">Aucune catégorie pour le moment !</div></div>
            <?php } ?>

        </div>
    </div>

    <!-- FOOTER -->
    <?php require_once("footer.php"); ?>
    <!-- FOOTER -->

    <script src="script.js"></script>

</body>
</html>