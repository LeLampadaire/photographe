<?php 
  	session_start();
	require_once("../configuration.php"); 
    require_once("../bdd_connexion.php"); 

	if(!empty($_SESSION)){
		header('Location: index.php');
	}

	$error = 0;
	if(!empty($_POST)){
		$mdp = md5($_POST['mdp']);
		$pseudo = utf8_decode($_POST['pseudo']);
		$ret = mysqli_query($bdd, 'SELECT * FROM compte WHERE pseudo LIKE("'.$pseudo.'") AND mdp LIKE("'.$mdp.'");');
		$ret = mysqli_fetch_array($ret, MYSQLI_ASSOC);

		if($ret == NULL){
			$error = 1;
		}else{
			session_unset();
			$_SESSION['pseudo'] = utf8_encode($ret['pseudo']);
			header('Location: index.php');
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $NomSite; ?> - Connexion</title>
    <link rel="icon" href="<?= $favicon ?>" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" type="text/css" media="screen" href="../styles.css" />
</head>
<body>

    <!-- HEADER -->
    <?php require('../header.php'); ?>
    <!-- HEADER -->

    <h1 style="text-align: center;">Connexion</h1>

		<section class="text-center text-white">
			
			<div class="box text-center">
			
					<form method="POST">
						<?php
							if ($error == 1) {
								echo '<div class="alert alert-danger" role="alert">Pseudo ou mot de passe incorrect.</div>';
							}	
						?>
						<label>Nom de compte<br><input required type="text" name="pseudo" placeholder="Pseudo"><br></label>
						<label>Mot de passe<br><input required type="password" name="mdp" placeholder="Mot de passe"><br></label>

						<button type="submit" class="btn btn-outline-dark">Se connecter</button>
					</form>
					<br>
			</div>
		</section>

    <!-- FOOTER -->
    <?php require_once("footer-admin.php"); ?>
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