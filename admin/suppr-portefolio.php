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
        $test = mysqli_query($bdd, 'SELECT gif FROM portefolio WHERE id='.$_POST['id-image'].';');
        if($test != NULL){
            $suppr = mysqli_query($bdd, 'SELECT lien FROM gif WHERE id_portefolio='.$_POST['id-image'].';');
            foreach($suppr as $donnees){
                $suppression = "../".$donnees['lien'];
                unlink($suppression);
            }
            mysqli_query($bdd, 'DELETE FROM gif WHERE id_portefolio='.$_POST['id-image'].';');
        }
        $delete = mysqli_query($bdd, 'SELECT lien FROM portefolio WHERE id='.$_POST['id-image'].';');
        $delete = mysqli_fetch_array($delete, MYSQLI_ASSOC);
        $delete = "../".$delete['lien'];
        mysqli_query($bdd, 'DELETE FROM portefolio WHERE id='.$_POST['id-image'].';');
        unlink($delete);
        header('Location: suppr-portefolio.php?categorie='.$_POST['id-categorie'].'');
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $NomSite; ?> - Suppression</title>
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
            <?php if($test != NULL){
                foreach($photo as $donnees){ ?>
                    <div class="col-sm-2 text-center rounded tableBorderBlack margin2px">
                        <img src="../<?php echo $donnees['lien']; ?>" width="100%" class="PaddingImgModif">
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
        
        <a href="javascript:history.back()"><button type="button" class="btn btn-info">Retour</button></a>
        <br><br>
    </div>

    <!-- FOOTER -->
    <?php require_once("../footer.php"); ?>
    <!-- FOOTER -->

    <script src="/script.js"></script>
    
</body>
</html>