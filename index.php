<!DOCTYPE html>
<?php 
    require_once("configuration.php"); 
    require_once("bdd_connexion.php"); 

    $categories = mysqli_query($bdd, 'SELECT * FROM categories;');
?>

<html>
<head>
  <title><?php echo $NomSite; ?> - Portefolio</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link rel="stylesheet" href="styles.css">
</head>
<body>

    <?php 
      // HEADER //
      require_once("header.php"); 
    ?>

    <div class="container" style="padding-bottom: 25px;padding-top: 20px;">
        <div class="row">

            <?php foreach($categories as $donnees){?>
                <div class="col-sm-4" style="padding-bottom: 20px;">
                    <div class="card" style="width: 18rem;">
                        <img src="<?php echo $donnees['image']; ?>" class="card-img-top" alt="<?php echo utf8_encode($donnees['nom']); ?>">
                        <div class="card-body">
                            <h3 class="card-title"><?php echo utf8_encode($donnees['nom']); ?></h3>
                            <p class="card-text"><?php echo utf8_encode($donnees['description']); ?></p>
                            <a href="portefolio.php?categorie=<?php echo $donnees['id']; ?>" class="btn btn-primary">S'y rendre</a>
                        </div>
                    </div>
                </div>
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