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
            if($extension_upload == "jpg" || $extension_upload == "png" || $extension_upload == "jpeg" || $extension_upload == "gif"){
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
    <title><?php echo $NomSite; ?> - Modification</title>
    <link rel="icon" href="<?= $favicon ?>" />
    <?php require_once("../link.php"); ?>
</head>
<body>

    <!-- HEADER -->
    <?php require_once("../header.php"); ?>
    <!-- HEADER -->

    <div class="container">
        <br>
        <a href="javascript:history.back()"><button type="button" class="btn btn-info">Retour</button></a>
        <br><br>
        <div class="row">

                <?php foreach($categories as $donnees){?>
                    <div class="col-sm-4 paddingBottom20px">
                        <div class="card text18rem">
                            <img src="<?php echo '../'.$donnees['image']; ?>" class="card-img-top" alt="<?php echo $donnees['nom']; ?>">
                            <div class="card-body">
                                <h3 class="card-title"><?php echo $donnees['nom']; ?></h3>
                                <p class="card-text"><?php echo $donnees['description']; ?></p>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal<?php echo $donnees['id']; ?>">Modifiez !</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="Modal<?php echo $donnees['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $donnees['nom']; ?>L" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="<?php echo $donnees['nom']; ?>L">Modifcation</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $donnees['id']; ?>">
                                    <div class="modal-body">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-nom-<?php echo $donnees['nom']; ?>">Nom</span>
                                            </div>
                                            <input type="text" class="form-control" name="nom" value="<?php echo $donnees['nom']; ?>" aria-label="Nom-<?php echo $donnees['nom']; ?>" aria-describedby="basic-nom-<?php echo $donnees['nom']; ?>">
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-description-<?php echo $donnees['nom']; ?>">Description</span>
                                            </div>
                                            <input type="text" class="form-control" name="description" value="<?php echo $donnees['description']; ?>" aria-label="Description-<?php echo $donnees['nom']; ?>" aria-describedby="basic-description-<?php echo $donnees['nom']; ?>">
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
        
        <a href="javascript:history.back()"><button type="button" class="btn btn-info">Retour</button></a>
        <br><br>
    </div>
    
    <!-- FOOTER -->
    <?php require_once("../footer.php"); ?>
    <!-- FOOTER -->

    <?php require_once("../script.php"); ?>
    
</body>
</html>