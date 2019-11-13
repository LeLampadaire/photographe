<?php 
	require_once("configuration.php"); 
  require_once("bdd_connexion.php"); 
  
  if(isset($_GET['error'])){
    $alert_contact = $_GET['error'];
  }else{
    $alert_contact = -1;
    $alert_valid = -1;
  }

  if(isset($_POST['valid'])){
    // Ma clé privée
    $secret = "6LfMlcEUAAAAAIfhAxPgjyfPOcmMbJ-TWL5VtgSY";
    // Paramètre renvoyé par le recaptcha
    $response = $_POST['g-recaptcha-response'];
    // On récupère l'IP de l'utilisateur
    $remoteip = $_SERVER['REMOTE_ADDR'];
    
    $api_url = "https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$response."&remoteip=".$remoteip;
    
    $decode = json_decode(file_get_contents($api_url), true);
    
    if($decode['success'] == true){
      $alert_valid = 1;
    }else{
      $alert_valid = 0;
    }
  }
  
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
      $contact = mysqli_query($bdd, 'INSERT INTO contact(id, prenom, mail, message) VALUES (NULL, "'.htmlspecialchars($_POST['prenom']).'", "'.htmlspecialchars($_POST['mail']).'", "'.htmlspecialchars($_POST['message']).'"); ');
      if($contact){
        $alert_contact = 1;
      }else{
        $alert_contact = 0;
      }
    }else{
      $alert_contact = 0;
    }

    header('Location: information.php?error='.$alert_contact.'#contact');
  }

  function age($date) {
    $age = date('Y') - date('Y', strtotime($date));

    if(date('md') < date('md', strtotime($date))){
      return $age - 1;
    }else{
      return $age;
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title><?php echo $NomSite; ?> - Accueil</title>
  <link rel="icon" href="<?= $favicon ?>" />
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <?php require_once("link.php"); ?>
</head>
<body onselectstart="return false" oncontextmenu="return false" ondragstart="return false" onMouseOver="window.status='..message perso .. '; return true;">

    <!-- HEADER -->
    <?php require_once("header.php"); ?>
    <!-- HEADER -->

  <!-- Informations section -->
  <div class="w3-container w3-dark-grey w3-center w3-text-light-grey w3-padding-32">
    <h2><b>À propos de moi</b></h2>
    <img src="images/Profil.png" alt="Profil" class="w3-image w3-padding-32" width="200" height="200">

    <div class="w3-content w3-justify tailleMaxDiv">

      <h2>Informations</h2>
      <hr class="w3-opacity">
      <p>Stéphane Rausin <?php echo age("13-12-2000"); ?> ans, </p>

      <p>Photographe passionné par la publicité et les photographie en studio.</p>

      <br><p>Mon site est là pour partager mes créations et proposer mes services photographiques.</p>

      <hr class="w3-opacity">
      <h2>Données</h2>

      <?php if($alert_valid != 1){ ?>
        <form action="" method="POST">
          <input type="hidden" value="1" name="valid"> 
          <div class="divCaptcha">
            <div class="g-recaptcha" data-sitekey="6LfMlcEUAAAAAFZktznFZmdCXgrZntEnsvZYL7Zi"></div>
          </div>

          <br>

          <button type="submit" class="w3-button w3-block w3-black w3-margin-bottom">Voir !</button>
        </form>
      <?php } ?>

      <?php if($alert_valid == 1){ ?>
        <p><img src="images/mail.png" class="icon-information" alt="Localisation">  Mail : <a href="mailto:stephane.rausin@gmail.com">stephane.rausin@gmail.com</a></p>
        <p><img src="images/telephone.png" class="icon-information" alt="Localisation">  Téléphone : <a href="tel:+32495516959">+32495516959</a></p>
        <p><img src="images/map.png" class="icon-information" alt="Localisation">  Situé en Belgique - Province de liège !</p>
      <?php } ?>

      <hr>
    </div>
    <span id="services"></span> <!-- Parce que l'ancre ne fonctionne pas bien du coup je le mets un peu plus haut -->
  </div>

  <!-- Services section -->
  <div class="w3-container w3-light-white w3-padding-32 w3-padding-large">
    <div class="container">

    <h2 class="w3-center"><b>Services</b></h2>

      <form action="service.php" method="POST">
        <div class="card-columns">
          <div class="card colorcard">
            <img src="images/services/restauration.jpg" class="card-img-top" alt="Image">
            <div class="card-body">
              <h3 class="card-title">Restauration de photographie ancienne</h3>
              <p class="card-text">Vous voulez faire revivre vos anciennes photos ou les photos que vous avez tant aimées ? Une restauration complète s'impose ! (avec ou sans tirage)</p>
              <button class="btn btn-primary" value="Restauration de photographie ancienne" name="value">Contactez !</button>
              <a href="portefolio.php?categorie=6" alt="Lien"><div class="btn btn-warning">Voir !</div></a>
            </div>
          </div>

          <div class="card colorcard">
            <img src="images/services/produit.jpg" class="card-img-top" alt="Image">
            <div class="card-body">
              <h3 class="card-title">Photographie de produits en studio</h3>
              <p class="card-text">Vous voulez embellir vos produits ou vos créations ? C'est ici !</p>
              <button class="btn btn-primary" value="Photographie de produits en studio" name="value">Contactez !</button>
              <a href="portefolio.php?categorie=2" alt="Lien"><div class="btn btn-warning">Voir !</div></a>
            </div>
          </div>

          <div class="card colorcard">
            <img src="images/services/evenementiel.jpg" class="card-img-top" alt="Image">
            <div class="card-body">
              <h3 class="card-title">Événementiel</h3>
              <p class="card-text">Vous cherchez un photographe pour couvrir vos événements ? </p>
              <button class="btn btn-primary" value="Évènementiel" name="value">Contactez !</button>
              <a href="portefolio.php?categorie=5" alt="Lien"><div class="btn btn-warning">Voir !</div></a>
            </div>
          </div>

          <div class="card colorcard">
            <img src="images/services/publicite.jpg" class="card-img-top" alt="Image">
            <div class="card-body">
              <h3 class="card-title">Publicité</h3>
              <p class="card-text">Vous voulez faire une publicité de votre marque ? Alors contactez-moi !</p>
              <button class="btn btn-primary" value="Publicité" name="value">Contactez !</button>
              <a href="portefolio.php?categorie=1" alt="Lien"><div class="btn btn-warning">Voir !</div></a>
            </div>
          </div>

          <div class="card colorcard">
            <img src="images/services/packshot.gif" class="card-img-top" alt="Image">
            <div class="card-body">
              <h3 class="card-title">Packshot</h3>
              <p class="card-text">Faire une boutique en ligne sans présenter correctement vos produits diminue vos chance de vendre...<br>Contactez-moi !</p>
              <button class="btn btn-primary" value="Packshot" name="value">Contactez !</button>
              <a href="portefolio.php?categorie=3" alt="Lien"><div class="btn btn-warning">Voir !</div></a>
            </div>
          </div>

          <div class="card colorcard">
            <img src="images/services/portrait.jpg" class="card-img-top" alt="Image">
            <div class="card-body">
              <h3 class="card-title">Portrait</h3>
              <p class="card-text">Photo en studio ou dehors.</p>
              <button class="btn btn-primary" value="Portrait" name="value">Contactez !</button>
              <a href="portefolio.php?categorie=4" alt="Lien"><div class="btn btn-warning">Voir !</div></a>
            </div>
          </div>

        </div>
      </form>
    </div>
    <span id="contact"></span> <!-- Parce que l'ancre ne fonctionne pas bien du coup je le mets un peu plus haut -->
  </div>

  <!-- Contact section -->
  <div class="w3-container w3-dark-grey w3-text-light-grey w3-padding-32">
    <div class="w3-content tailleMaxDiv">
      <h2 class="w3-center"><b>Contactez moi !</b></h2>
      <p>Si vous avez des questions ou autres, merci de remplir ce formulaire. Vous serez recontacter par mail.</p>
      <?php if ($alert_contact == 0) {
          echo '<div class="alert alert-danger" role="alert">Veuillez cocher la case du captcha !</div>';
        }else if($alert_contact == 1){
          echo '<div class="alert alert-success" role="alert">Message bien envoyé !</div>';
        } ?>
      <form action="" method="POST">
        <div class="w3-section">
          <label>Prénom</label>
          <input class="w3-input w3-border" type="text" name="prenom" required>
        </div>

        <div class="w3-section">
          <label>Mail</label>
          <input class="w3-input w3-border" type="email" name="mail" required>
        </div>

        <div class="w3-section">
          <label>Message</label><br>
          <textarea rows="5" cols="66" name="message" required></textarea>
        </div>

        <div class="divCaptcha">
          <div class="g-recaptcha" data-sitekey="6LfMlcEUAAAAAFZktznFZmdCXgrZntEnsvZYL7Zi"></div>
        </div>

        <br>

        <button type="submit" class="w3-button w3-block w3-black w3-margin-bottom">Envoyez !</button>
      </form>
    </div>
  </div>

  <!-- FOOTER -->
  <?php require_once("footer.php"); ?>
  <!-- FOOTER -->

  <?php require_once("script.php"); ?>

</body>
</html>