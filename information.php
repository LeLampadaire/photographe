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
      $contact = mysqli_query($bdd, 'INSERT INTO contact(id, prenom, mail, message) VALUES (NULL, "'.$_POST['prenom'].'", "'.$_POST['mail'].'", "'.$_POST['message'].'"); ');
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
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link rel="stylesheet" href="styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
</head>
<body onselectstart="return false" oncontextmenu="return false" ondragstart="return false" onMouseOver="window.status='..message perso .. '; return true;">

  <?php 
    // HEADER //
    require_once("header.php"); 
  ?>

  <!-- About section -->
  <div class="w3-container w3-dark-grey w3-center w3-text-light-grey w3-padding-32" id="informations">
    <h2><b>À propos de moi</b></h2>
    <img src="images/Profil.png" alt="Me" class="w3-image w3-padding-32" width="200" height="200">

    <div class="w3-content w3-justify" style="max-width:600px">

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
          <div style="margin: 0 auto; width: 300px; ">
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
            </div>
          </div>

          <div class="card colorcard">
            <img src="images/services/produit.jpg" class="card-img-top" alt="Image">
            <div class="card-body">
              <h3 class="card-title">Photographie de produits en studio</h3>
              <p class="card-text">Vous voulez embellir vos produits ou vos créations ? C'est ici !</p>
              <button class="btn btn-primary" value="Photographie de produits en studio" name="value">Contactez !</button>
            </div>
          </div>

          <div class="card colorcard">
            <img src="images/services/evenementiel.jpg" class="card-img-top" alt="Image">
            <div class="card-body">
              <h3 class="card-title">Événementiel</h3>
              <p class="card-text">Vous cherchez un photographe pour couvrir vos événements ? </p>
              <button class="btn btn-primary" value="Evènementielles" name="value">Contactez !</button>
            </div>
          </div>

          <div class="card colorcard">
            <img src="images/services/publicite.jpg" class="card-img-top" alt="Image">
            <div class="card-body">
              <h3 class="card-title">Publicité</h3>
              <p class="card-text">Vous voulez faire une publicité de votre marque ? Alors contactez-moi !</p>
              <button class="btn btn-primary" value="Publicité" name="value">Contactez !</button>
            </div>
          </div>

          <div class="card colorcard">
            <img src="images/services/packshot.gif" class="card-img-top" alt="Image">
            <div class="card-body">
              <h3 class="card-title">Packshot</h3>
              <p class="card-text">Faire une boutique en ligne sans présenter correctement vos produits diminue vos chance de vendre...<br>Contactez-moi !</p>
              <button class="btn btn-primary" value="Packshot" name="value">Contactez !</button>
            </div>
          </div>

          <div class="card colorcard">
            <img src="images/services/portrait.jpg" class="card-img-top" alt="Image">
            <div class="card-body">
              <h3 class="card-title">Portrait</h3>
              <p class="card-text">Photo en studio ou dehors.</p>
              <button class="btn btn-primary" value="Portrait" name="value">Contactez !</button>
            </div>
          </div>

        </div>
      </form>
    </div>
    <span id="contact"></span> <!-- Parce que l'ancre ne fonctionne pas bien du coup je le mets un peu plus haut -->
  </div>

  <!-- Contact section -->
  <div class="w3-container w3-dark-grey w3-text-light-grey w3-padding-32">
    <div class="w3-content" style="max-width:600px">
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

        <div style="margin: 0 auto; width: 300px; ">
          <div class="g-recaptcha" data-sitekey="6LfMlcEUAAAAAFZktznFZmdCXgrZntEnsvZYL7Zi"></div>
        </div>

        <br>

        <button type="submit" class="w3-button w3-block w3-black w3-margin-bottom">Envoyez !</button>
      </form>
    </div>
  </div>

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