<?php 
    session_start();
	require_once("../configuration.php"); 
    require_once("../bdd_connexion.php"); 
    
    if(empty($_SESSION)){
        header('Location: connexion.php');
    }

    $nbr_messages = mysqli_query($bdd, 'SELECT COUNT(id) as nbr FROM contact WHERE vu = 0;');
    $nbr_messages = mysqli_fetch_array($nbr_messages, MYSQLI_ASSOC);
    
    $nbr_services = mysqli_query($bdd, 'SELECT COUNT(vu) as nbr FROM services WHERE vu = 0;');
    $nbr_services = mysqli_fetch_array($nbr_services, MYSQLI_ASSOC);

    $error = 0;
    $errorportefolio = 0;
    $errorsuppressioncategorie = 0;

    if(isset($_POST['nom']) && isset($_POST['description'])){
        if(isset($_FILES['photo']) && $_FILES['photo']['error'] == 0 ){
            $extension_upload = strtolower( substr( strrchr($_FILES['photo']['name'], '.') ,1) );
            if($extension_upload == "jpg" || $extension_upload == "png" || $extension_upload == "jpeg" || $extension_upload == "gif"){
                $nomphoto = "images/categorie/".$_POST['nom'].".{$extension_upload}";
                $uploadlien = "../images/categorie/".$_POST['nom'].".{$extension_upload}";
                $move = move_uploaded_file($_FILES['photo']['tmp_name'],$uploadlien);
                mysqli_query($bdd, 'INSERT INTO categories (id, nom, image, description) VALUES (NULL, "'.$_POST['nom'].'", "'.$nomphoto.'", "'.$_POST['description'].'");');
                header('Location: index.php');
            }else{
                $error = 1;
            }
        }else{
            $error = 1;
        }
    }

    if(isset($_POST['suppression-categorie'])){
        mysqli_query($bdd,'DELETE FROM portefolio WHERE categorie='.$_POST['suppression-categorie'].';');
        $test = mysqli_query($bdd,'DELETE FROM categories WHERE id='.$_POST['suppression-categorie'].';');
        if(!$test){
            $errorsuppressioncategorie = 1;
        }else{
            header('Location: index.php');
        }
    }
    
    if(isset($_POST['categorie'])){
        if(isset($_FILES['photo']) && $_FILES['photo']['error'] == 0 ){
            $extension_upload = strtolower( substr( strrchr($_FILES['photo']['name'], '.') ,1) );
            if($extension_upload == "jpg" || $extension_upload == "png" || $extension_upload == "jpeg" || $extension_upload == "gif"){
                $cat = mysqli_query($bdd, "SELECT nom FROM categories WHERE id=".$_POST['categorie'].";");
                $cat = mysqli_fetch_array($cat, MYSQLI_ASSOC);
                $nomphoto = "images/portefolio/".$cat['nom']."-".$_FILES['photo']['name'];
                $uploadlien = "../images/portefolio/".$cat['nom']."-".$_FILES['photo']['name'];
                $move = move_uploaded_file($_FILES['photo']['tmp_name'],$uploadlien);
                mysqli_query($bdd, 'INSERT INTO portefolio (id, categorie, lien) VALUES (NULL, '.$_POST['categorie'].', "'.$nomphoto.'");');
                header('Location: index.php');
            }else{
                $errorportefolio = 1;
            }
        }else{
            $errorportefolio = 1;
        }
    }

    if(isset($_POST['suppressionInCategorie'])){
        header('Location: modif-portefolio.php?categorie='.$_POST['suppressionInCategorie'].'');
    }
?>
<html>
<head>
    <title><?php echo $NomSite; ?> - Admin</title>
    <link rel="icon" href="<?= $favicon ?>" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="../styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
</head>
<body>

    <?php 
      // HEADER //
      require_once("header-admin.php"); 
    ?>

    <div class="container text-center">
        <div class="row">
            <div class="col-sm border-right">
                <h1 style="text-align: center;">Catégories</h1>
                <form action="" method="POST" enctype="multipart/form-data">
                    <h3 style="text-align: center;">Ajout</h3>
                    <?php if ($error == 1) {
                        echo '<div class="alert alert-danger" role="alert">Erreur !</div>';
                    } ?>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Nom</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Nom" aria-label="nom" aria-describedby="basic-addon1" name="nom">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Description</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Description" aria-label="description" aria-describedby="basic-addon1" name="description">
                    </div>

                    <input id="photo" name="photo" type="file"><br><br>
                    <button type="submit" class="btn btn-primary">Créez !</button>
                </form>
            </div>

            <div class="col-sm">
                <h1 style="text-align: center;">Photo</h1>
                <form action="" method="POST" enctype="multipart/form-data">
                    <h3 style="text-align: center;">Ajout</h3>
                    <?php if ($errorportefolio == 1) {
                            echo '<div class="alert alert-danger" role="alert">Erreur !</div>';
                    } ?>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Catégorie</label>
                        </div>
                        <?php
                            $req = mysqli_query($bdd, 'SELECT id, nom FROM categories;');
                        ?>
                        <select class="custom-select" id="inputGroupSelect01" name="categorie">
                            <option value="0" selected disabled>Choisir ...</option>
                            <?php foreach($req as $donnees){
                                echo '<option value="'.$donnees['id'].'">'.$donnees['nom'].'</option>';
                            } ?>
                        </select>
                    </div>

                    <input id="photo" name="photo" type="file"><br><br>
                    <button type="submit" class="btn btn-primary">Ajoutez !</button>
                </form>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm border-right border-top">
                <form action="" method="POST">
                    <h3 style="text-align: center;">Suppression</h3>
                    <?php if ($errorsuppressioncategorie == 1) {
                            echo '<div class="alert alert-danger" role="alert">Erreur !</div>';
                    } ?>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Catégorie</label>
                        </div>
                        <?php
                            $req = mysqli_query($bdd, 'SELECT id, nom FROM categories;');
                        ?>
                        <select class="custom-select" id="inputGroupSelect01" name="suppression-categorie">
                            <option value="0" selected disabled>Choisir ...</option>
                            <?php foreach($req as $donnees){
                                echo '<option value="'.$donnees['id'].'">'.$donnees['nom'].'</option>';
                            } ?>
                        </select>
                    </div>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Supprimez !</button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Êtes-vous sur de supprimez la catégorie ?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Si vous supprimez la catégorie, cela supprimera aussi les photos de cette catégorie.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulez !</button>
                                <button type="submit" class="btn btn-danger">Supprimez !</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    
                </form>    
            </div>
            
            <div class="col-sm border-top">
                <form action="" method="POST">
                    <h3 style="text-align: center;">Suppression</h3>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Catégorie</label>
                        </div>
                        <?php
                            $req = mysqli_query($bdd, 'SELECT id, nom FROM categories;');
                        ?>
                        <select class="custom-select" id="inputGroupSelect01" name="suppressionInCategorie">
                            <option value="0" selected disabled>Choisir ...</option>
                            <?php foreach($req as $donnees){
                                echo '<option value="'.$donnees['id'].'">'.$donnees['nom'].'</option>';
                            } ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary" >S'y rendre !</button>                
                </form>    
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-6 border-right border-top">
                <h3 style="text-align: center;">Modification</h3>
                <a href="modif-categorie.php"><button type="button" class="btn btn-primary">S'y rendre !</button></a>
            </div>
        </div>
    </div>

    <br>
    <div style="text-align: center;">
        <a href="services.php" alt="Services"><button type="button" class="btn btn-secondary">Services <span class="badge <?php if($nbr_services['nbr'] == 0){ echo "badge-light"; }else{ echo "badge-danger"; } ?>"><?php echo $nbr_services['nbr'] ?></span></button></a>
        <a href="messages.php" alt="Messages"><button type="button" class="btn btn-primary">Messages <span class="badge <?php if($nbr_messages['nbr'] == 0){ echo "badge-light"; }else{ echo "badge-danger"; } ?>"><?php echo $nbr_messages['nbr'] ?></span></button></a>
        <a href="deconnexion.php" alt="Déconnexion"><button type="button" class="btn btn-warning">Déconnexion</button></a>
    </div>
    
    <br>
    
    <!-- FOOTER -->
    <?php require_once("footer-admin.php"); ?>
    <!-- FOOTER -->

</body>

<script>

    $('#exampleModal').modal('show');


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