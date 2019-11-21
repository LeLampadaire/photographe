<?php 
    session_start();
	require_once("../configuration.php"); 
    require_once("../bdd_connexion.php"); 
    
    if(empty($_SESSION)){
        header('Location: connexion.php');
    }

    if(isset($_POST['categorie']) && isset($_POST['nbrImage']) && $_POST['nbrImage'] != NULL){
        $idCategorie = (int)$_POST['categorie'];
        $nomCategorie = mysqli_query($bdd, "SELECT nom FROM categories WHERE id=".$idCategorie.";");
        $nomCategorie = mysqli_fetch_array($nomCategorie, MYSQLI_ASSOC);
        $nomCategorie = $nomCategorie['nom'];
        
        $nbrImage = (int)$_POST['nbrImage'];
    }else{
        header('Location: index.php');
    }

    if(isset($_POST['idCategorie'])){
        
        if(isset($_FILES['photo1']) && $_FILES['photo1']['error'] == 0 ){
            $extension_upload = strtolower( substr( strrchr($_FILES['photo1']['name'], '.') ,1) );
            $nomImage = substr($_FILES['photo1']['name'], 0 ,strpos($_FILES['photo1']['name'], "."));
            if($extension_upload == "jpg" || $extension_upload == "png" || $extension_upload == "jpeg"){
                $cat = mysqli_query($bdd, "SELECT nom FROM categories WHERE id=".$_POST['idCategorie'].";");
                $cat = mysqli_fetch_array($cat, MYSQLI_ASSOC);
                $nomphoto = "images/portefolio/".$cat['nom']."-".$nomImage."_1".".{$extension_upload}";
                $uploadlien = "../".$nomphoto;
                $move = move_uploaded_file($_FILES['photo1']['tmp_name'],$uploadlien);
                mysqli_query($bdd, 'INSERT INTO portefolio (id, categorie, lien, gif) VALUES (NULL, '.$_POST['idCategorie'].', "'.$nomphoto.'", '.$_POST['nbrImage'].');');
            }
        }

        $idBDD = mysqli_query($bdd, "SELECT MAX(id) AS max_id FROM portefolio;");
        $idBDD = mysqli_fetch_array($idBDD, MYSQLI_ASSOC);
        $idBDD = (int)$idBDD['max_id'];

        for($i = 1; $i <= $_POST['nbrImage']; $i++){
            $nomInput = 'photo'.$i.'';
            if(isset($_FILES[$nomInput]) && $_FILES[$nomInput]['error'] == 0 ){
                $extension_upload = strtolower( substr( strrchr($_FILES[$nomInput]['name'], '.') ,1) );
                if($extension_upload == "jpg" || $extension_upload == "png" || $extension_upload == "jpeg"){
                    $cat = mysqli_query($bdd, "SELECT nom FROM categories WHERE id=".$_POST['idCategorie'].";");
                    $cat = mysqli_fetch_array($cat, MYSQLI_ASSOC);
                    $nomphoto = "images/portefolio/".$cat['nom']."-".$nomImage."_".$i.".{$extension_upload}";
                    $uploadlien = "../".$nomphoto;
                    $move = move_uploaded_file($_FILES[$nomInput]['tmp_name'],$uploadlien);
                    mysqli_query($bdd, 'INSERT INTO gif (id, id_portefolio, lien) VALUES (NULL, '.$idBDD.', "'.$nomphoto.'");');
                }
            }
        }
        
        header('Location: index.php');
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $NomSite; ?> - Ajout GIF</title>
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
        
        <h1 class="text-center"><?= $nomCategorie; ?></h1>
        <br>
        <div class="row">

            <div class="col-md-6 offset-md-3 text-center">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" value="<?= $idCategorie; ?>" name="idCategorie">
                    <input type="hidden" value="<?= $nbrImage; ?>" name="nbrImage">

                    <?php for($i = 1; $i <= $nbrImage; $i++){
                        echo $i . ' : <input id="photo'.$i.'" name="photo'.$i.'" type="file"><br><br>';
                    } ?>

                    <button type="submit" class="btn btn-primary">Envoyez !</button>
                </form>
            </div>
            
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