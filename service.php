<?php 
	require_once("configuration.php"); 
    require_once("bdd_connexion.php"); 
  
    if(empty($_POST)){
        header('Location: index.php');
    }
    
    $alert_service = -1;

    if(isset($_POST['prenom'])){
        // Ma clé privée
        $secret = "6LfMlcEUAAAAAIfhAxPgjyfPOcmMbJ-TWL5VtgSY";
        // Paramètre renvoyé par le recaptcha
        $response = $_POST['g-recaptcha-response'];
        // On récupère l'IP de l'utilisateur
        $remoteip = $_SERVER['REMOTE_ADDR'];
        
        $api_url = "https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$response."&remoteip=".$remoteip;
        
        $decode = json_decode(file_get_contents($api_url), true);
        
        if($decode['success'] == true){
            if(strcmp($_POST['telephone'], "") == 0){
                mysqli_query($bdd, 'INSERT INTO services (id, services, nom, prenom, mail, telephone, vu) VALUES (NULL, "'.utf8_decode($_POST['services']).'", "'.utf8_decode($_POST['nom']).'", "'.utf8_decode($_POST['prenom']).'", "'.$_POST['mail'].'", NULL, 0);');
            }else{
                mysqli_query($bdd, 'INSERT INTO services (id, services, nom, prenom, mail, telephone, vu) VALUES (NULL, "'.utf8_decode($_POST['services']).'", "'.utf8_decode($_POST['nom']).'", "'.utf8_decode($_POST['prenom']).'", "'.$_POST['mail'].'", "'.$_POST['telephone'].'", 0);');
            }
            header('Location: valid.php');
        }else{
            $alert_service = 0;
        }        
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $NomSite; ?> - Services</title>
    <link rel="icon" href="<?= $favicon ?>" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
</head>
<body class="text-center">

    <?php 
        // HEADER //
        require_once("header.php"); 
    ?>

    <div class="container">
    
        <?php if ($alert_service == 0) {
          echo '<br><div class="alert alert-danger" role="alert">Veuillez cocher la case du captcha !</div>';
        } ?>

        <form action="" method="POST">
            <h1><?= $_POST['value'] ?></h1>
            <input type="hidden" value="<?= $_POST['value'] ?>" name="services">

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Nom*</span>
                </div>
                <input type="text" class="form-control" placeholder="Nom" aria-label="Nom" aria-describedby="basic-addon1" name="nom" required>
            </div>
            
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Prenom*</span>
                </div>
                <input type="text" class="form-control" placeholder="Prénom" aria-label="Prénom" aria-describedby="basic-addon1" name="prenom" required>
            </div>
            
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Mail*</span>
                </div>
                <input type="email" class="form-control" placeholder="Mail" aria-label="Mail" aria-describedby="basic-addon1" name="mail" required>
            </div>
            
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Téléphone</span>
                </div>
                <input type="tel" class="form-control" placeholder="Téléphone" aria-label="Téléphone" aria-describedby="basic-addon1" name="telephone">
            </div>

            <div style="margin: 0 auto; width: 300px;">
                <div class="g-recaptcha" data-sitekey="6LfMlcEUAAAAAFZktznFZmdCXgrZntEnsvZYL7Zi"></div>
            </div>

            <p>Après l'envoi vous serez contacté par mail afin de discuter de votre projet !</p>
            <i>* Obligatoire</i>

            <br><br>
            <button type="submit" class="btn btn-warning">>Envoyez !</button>
            <br><br>
        </form>
    </div>

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