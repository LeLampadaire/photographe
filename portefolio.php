<?php 
    require_once("configuration.php"); 
    require_once("bdd_connexion.php"); 

    if(!isset($_GET['categorie'])){
      header('Location: index.php');
    }

    $photo = mysqli_query($bdd, 'SELECT * FROM portefolio INNER JOIN categories ON(categories.id = portefolio.categorie) WHERE categorie='.$_GET['categorie'].';');
    $photoTest = mysqli_fetch_array($photo, MYSQLI_ASSOC);

    $titre = mysqli_query($bdd, 'SELECT nom FROM categories WHERE id='.$_GET['categorie'].';');
    $titre = mysqli_fetch_array($titre, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $NomSite.' - '.$titre['nom']; ?></title>
    <link rel="icon" href="<?= $favicon ?>" />
    <?php require_once("link.php"); ?>
</head>
<body onselectstart="return false" oncontextmenu="return false" ondragstart="return false" onMouseOver="window.status='..message perso .. '; return true;">

    <!-- HEADER -->
    <?php require_once("header.php"); ?>
    <!-- HEADER -->

    <h1 class="text-center"><?php echo $titre['nom']; ?></h1>
    
    <div class="container-fluid">
      <a href="javascript:history.back()"><button type="button" class="btn btn-info">Retour</button></a>

      <?php if($photoTest != NULL){ ?>
        <div id="portfolio">
            <?php foreach($photo as $donnees){ ?>
                <div id="myDiv">
                    <img class="opacity" src="<?php echo $donnees['lien']; ?>" alt="<?php echo $donnees['nom']; ?>" onclick="onClick(this)" />
                </div>
            <?php } ?>
        </div>
      <?php }else{ ?>
        <div class="container text-center"><div class="alert alert-danger" role="alert">Aucune photo pour le moment !</div></div>
      <?php } ?>

      <div id="modal01" class="w3-modal fondModal" onclick="this.style.display='none'">
        <span class="w3-button w3-black w3-xlarge w3-display-topright">×</span>
        <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent tailleBlocImage">
          <img id="img01" class="w3-image tailleImage">
          <p id="caption"></p>
        </div>
      </div>
      
      <a href="javascript:history.back()"><button type="button" class="btn btn-info">Retour</button></a>
    </div>
    
    <br>

    <!-- FOOTER -->
    <?php require_once("footer.php"); ?>
    <!-- FOOTER -->

    <?php require_once("script.php"); ?>

    <script> 
      // Ajout de la fonction pour cliquer sur l'image et l'agrandir
      function onClick(element) {
        document.getElementById("img01").src = element.src;
        document.getElementById("modal01").style.display = "block";
      }
    </script>

</body>
</html>