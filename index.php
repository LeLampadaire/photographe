<!DOCTYPE html>
<?php 
    require_once("configuration.php"); 
    require_once("bdd_connexion.php");

    $categories = mysqli_query($bdd, 'SELECT * FROM categories;');
    $categoriesTest = mysqli_fetch_array($categories, MYSQLI_ASSOC);
?>

<html>
<head>
  <title><?php echo $NomSite; ?> - Portefolio</title>
  <link rel="icon" href="<?= $favicon ?>" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link rel="stylesheet" href="styles.css">
</head>
<body onselectstart="return false" oncontextmenu="return false" ondragstart="return false" onMouseOver="window.status='..message perso .. '; return true;">

    <?php 
      // HEADER //
      require_once("header.php"); 
    ?>

    <div class="container" style="padding-bottom: 25px;padding-top: 20px;">
        <div class="row">

            <?php if($categoriesTest != NULL){ ?>
                <?php foreach($categories as $donnees){?>
                    <div class="col-md-6 col-lg-4" style="padding-bottom: 20px;padding-right: 20px;padding-left: 20px;">
                        <div class="card" style="width: 18rem;">
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

    

    <div style="clear:both;"></div>   

    <?php 
      // FOOTER //
      require_once("footer.php"); 
    ?>

</body>

<script>
    function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
    }

    function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
    }
</script>
</html>