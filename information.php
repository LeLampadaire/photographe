<?php 
	require_once("configuration.php"); 
  require_once("bdd_connexion.php"); 
  
  $alert_contact = -1;

  if(isset($_POST['prenom'])){
    $contact = mysqli_query($bdd, 'INSERT INTO contact(id, prenom, mail, message) VALUES (NULL, "'.$_POST['prenom'].'", "'.$_POST['mail'].'", "'.$_POST['message'].'"); ');
    if($contact){
      $alert_contact = 1;
    }else{
      $alert_contact = 0;
    }    
  }
  
  if(isset($_POST['mail'])){
    mail('stephane.rausin@gmail.com', 'Demande de tarif', $_POST['mail']);
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title><?php echo $NomSite; ?> - Accueil</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link rel="stylesheet" href="styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
</head>
<body>

  <?php 
    // HEADER //
    require_once("header.php"); 
  ?>

  <!-- About section -->
  <div class="w3-container w3-dark-grey w3-center w3-text-light-grey w3-padding-32">
    <?php if ($alert_contact == 0) {
      echo '<div class="alert alert-danger" role="alert">Erreur lors de l\'envoi !</div>';
    }else if($alert_contact == 1){
      echo '<div class="alert alert-success" role="alert">Message bien envoyé !</div>';
    } ?>
    <h2 id="informations"><b>À propos de moi</b></h2>
    <img src="images/Profil.png" alt="Me" class="w3-image w3-padding-32" width="200" height="200">

    <div class="w3-content w3-justify" style="max-width:600px">

      <h4><?php echo $NomSite; ?></h4>
      <hr class="w3-opacity">
      <p>Stéphane Rausin 17 ans, </p>

      <p>​J'ai découvert l​e monde ​de​ la photographie il y a 2 ans​.</p>

      <br><p>La photographie est devenue une passion.</p>

      <br><p>J'ai découvert à travers la photo une autre vision du monde que j'ai envie de partager, la capture de l'instant...</p>

      <br><p>Les facettes d'un sujet ou d'un détail vu d'une autre façon.</p>

      <hr class="w3-opacity">
      <p>Mail : <a href="mailto:stephane.rausin@gmail.com">stephane.rausin@gmail.com</a></p>
      <p>Téléphone : <a href="tel:+32495516959">+32495516959</a></p>
      <hr>
    </div>
  </div>
  <!-- Contact section -->
  <div class="w3-container w3-light-grey w3-padding-32 w3-padding-large" id="contact">
    <div class="w3-content" style="max-width:600px">
      <h2 class="w3-center"><b>Contactez moi !</b></h2>
      <p>Si vous avez des questions ou autres, merci de remplir ce formulaire. Vous serez recontacter par mail.</p>

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