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
                mysqli_query($bdd, 'INSERT INTO services (id, services, nom, prenom, mail, telephone, vu) VALUES (NULL, "'.$_POST['services'].'", "'.htmlspecialchars($_POST['nom']).'", "'.htmlspecialchars($_POST['prenom']).'", "'.htmlspecialchars($_POST['mail']).'", NULL, 0);');
            }else{
                mysqli_query($bdd, 'INSERT INTO services (id, services, nom, prenom, mail, telephone, vu) VALUES (NULL, "'.$_POST['services'].'", "'.htmlspecialchars($_POST['nom']).'", "'.htmlspecialchars($_POST['prenom']).'", "'.htmlspecialchars($_POST['mail']).'", "'.htmlspecialchars($_POST['telephone']).'", 0);');
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
    <?php require_once("link.php"); ?>
</head>
<body>

    <!-- HEADER -->
    <?php require_once("header.php"); ?>
    <!-- HEADER -->

    <div class="container">
    
        <?php if ($alert_service == 0) {
          echo '<br><div class="alert alert-danger" role="alert">Veuillez cocher la case du captcha !</div>';
        } ?>

        <br><a href="javascript:history.back()"><button type="button" class="btn btn-info">Retour</button></a>

        <form action="" method="POST" class="text-center">
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

            <div class="divCaptcha">
                <div class="g-recaptcha" data-sitekey="6LfMlcEUAAAAAFZktznFZmdCXgrZntEnsvZYL7Zi"></div>
            </div>

            <p>Après l'envoi vous serez contacté par mail afin de discuter de votre projet !</p>
            <i>* Obligatoire</i>

            <br><br>
            <button type="submit" class="btn btn-warning">>Envoyez !</button>
            <br><br>
        </form>
    </div>

    <!-- FOOTER -->
    <?php require_once("footer.php"); ?>
    <!-- FOOTER -->

    <script src="script.js"></script>
</body>
</html>