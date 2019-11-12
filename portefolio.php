<!DOCTYPE html>
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
<html>
<head>
  <title><?php echo $NomSite.' - '.$titre['nom']; ?></title>
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

    <h1 style="text-align: center;"><?php echo $titre['nom']; ?></h1>
    
    <div class="container-fluid">
      <a href="index.php"><button type="button" class="btn btn-info">Retour</button></a>

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

      <div id="modal01" class="w3-modal" style="padding-top:0; background-color: rgba(0, 0, 0, 0.9);" onclick="this.style.display='none'">
        <span class="w3-button w3-black w3-xlarge w3-display-topright">×</span>
        <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent" style="padding-top: 5vh">
          <img id="img01" class="w3-image" style="height: 90vh">
          <p id="caption"></p>
        </div>
      </div>
      
      <a href="index.php"><button type="button" class="btn btn-info">Retour</button></a>
    </div>
    
    <br>

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
        
    function onClick(element) {
    document.getElementById("img01").src = element.src;
    document.getElementById("modal01").style.display = "block";
    }

    $(function() {
        var selectedClass = "";
        $(".fil-cat").click(function(){ 
            selectedClass = $(this).attr("data-rel"); 
            $("#portfolio").fadeTo(100, 0.1);
            $("#portfolio div").not("."+selectedClass).fadeOut().removeClass('scale-anm');
            setTimeout(function() {
            $("."+selectedClass).fadeIn().addClass('scale-anm');
            $("#portfolio").fadeTo(300, 1);
            }, 300); 
        });
    });

</script>
</html>