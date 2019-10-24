<?php 
    session_start();
	require_once("../configuration.php"); 
    require_once("../bdd_connexion.php"); 
    
    if(empty($_SESSION)){
        header('Location: connexion.php');
    }

    $categories = mysqli_query($bdd, 'SELECT * FROM categories;');

    if(isset($_POST['id'])){
        if(isset($_FILES['photo']) && $_FILES['photo']['error'] == 0 ){
            $extension_upload = strtolower( substr( strrchr($_FILES['photo']['name'], '.') ,1) );
            if($extension_upload == "jpg" || $extension_upload == "png" || $extension_upload == "jpeg"){
                $nomphoto = "images/categorie/".$_POST['nom'].".{$extension_upload}";
                $uploadlien = "../images/categorie/".$_POST['nom'].".{$extension_upload}";
                $move = move_uploaded_file($_FILES['photo']['tmp_name'],$uploadlien);
                mysqli_query($bdd, 'UPDATE categories SET nom="'.$_POST['nom'].'", image="'.$nomphoto.'", description="'.$_POST['description'].'" WHERE id='.$_POST['id'].';');
                header('Location: index.php');
            }else{
                mysqli_query($bdd, 'UPDATE categories SET nom="'.$_POST['nom'].'", description="'.$_POST['description'].'" WHERE id='.$_POST['id'].';');
            }
        }else{
            mysqli_query($bdd, 'UPDATE categories SET nom="'.$_POST['nom'].'", description="'.$_POST['description'].'" WHERE id='.$_POST['id'].';');
        }
        header('Location: modif-categorie.php');
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $NomSite; ?> - Modification</title>
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

                <?php foreach($categories as $donnees){?>
                    <div class="col-sm-4" style="padding-bottom: 20px;">
                        <div class="card" style="width: 18rem;">
                            <img src="<?php echo '../'.$donnees['image']; ?>" class="card-img-top" alt="<?php echo utf8_encode($donnees['nom']); ?>">
                            <div class="card-body">
                                <h3 class="card-title"><?php echo utf8_encode($donnees['nom']); ?></h3>
                                <p class="card-text"><?php echo utf8_encode($donnees['description']); ?></p>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal<?php echo utf8_encode($donnees['id']); ?>">Modifiez !</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="Modal<?php echo utf8_encode($donnees['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo utf8_encode($donnees['nom']); ?>L" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="<?php echo utf8_encode($donnees['nom']); ?>L">Modifcation</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo utf8_encode($donnees['id']); ?>">
                                    <div class="modal-body">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-nom-<?php echo utf8_encode($donnees['nom']); ?>">Nom</span>
                                            </div>
                                            <input type="text" class="form-control" name="nom" value="<?php echo utf8_encode($donnees['nom']); ?>" aria-label="Nom-<?php echo utf8_encode($donnees['nom']); ?>" aria-describedby="basic-nom-<?php echo utf8_encode($donnees['nom']); ?>">
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-description-<?php echo utf8_encode($donnees['nom']); ?>">Description</span>
                                            </div>
                                            <input type="text" class="form-control" name="description" value="<?php echo utf8_encode($donnees['description']); ?>" aria-label="Description-<?php echo utf8_encode($donnees['nom']); ?>" aria-describedby="basic-description-<?php echo utf8_encode($donnees['nom']); ?>">
                                        </div>
                                        <input id="photo" name="photo" type="file"><br><br>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermez</button>
                                        <button type="submit" class="btn btn-warning">Modifiez !</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>

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