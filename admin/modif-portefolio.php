<?php 
    session_start();
	require_once("../configuration.php"); 
    require_once("../bdd_connexion.php"); 
    
    if(empty($_SESSION)){
        header('Location: connexion.php');
    }

    if(isset($_GET['categorie'])){
        $photo = mysqli_query($bdd, 'SELECT * FROM portefolio WHERE categorie='.$_GET['categorie'].';');
        $test = mysqli_fetch_array($photo, MYSQLI_ASSOC);
    }else{
        header('Location: index.php');
    }

    if(isset($_POST['id-image'])){
        mysqli_query($bdd, 'DELETE FROM portefolio WHERE id='.$_POST['id-image'].';');
        header('Location: modif-portefolio.php?categorie='.$_POST['id-categorie'].'');
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $NomSite; ?> - Suppression</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" type="text/css" media="screen" href="../styles.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
</head>
<body>

    <!-- HEADER -->
    <?php require('header-admin.php'); ?>
    <!-- HEADER -->

    <div class="container">
        <br>
        <a href="index.php"><button type="button" class="btn btn-info">Retour</button></a>
        <br><br>
        <div class="row">
            <?php if($test != NULL){
                foreach($photo as $donnees){ ?>
                    <div class="col-sm-2 text-center rounded" style="border: solid 2px black; margin: 2px;">
                        <img src=../<?php echo $donnees['lien']; ?> width="200px" style="padding: 15px; margin-left: -20px;">
                        <form action="" method="POST">
                            <input type="hidden" value="<?php echo $donnees['id']; ?>" name="id-image">
                            <input type="hidden" value="<?php echo $_GET['categorie']; ?>" name="id-categorie">
                            <button class="btn btn-danger" type="submit">Supprimez</button>
                        </form>
                        <br>
                    </div>
                <?php }
            }else{
                echo '<div class="container text-center"><div class="alert alert-danger" role="alert">Aucune photo pour le moment !</div></div>';
            } ?>
        </div>
        <br>
        
        <a href="index.php"><button type="button" class="btn btn-info">Retour</button></a>
        <br><br>
    </div>

    <!-- FOOTER -->
    <?php include('../footer.php'); ?>
    <!-- FOOTER -->
</body>

<script>
    $().dropdown('toggle');

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