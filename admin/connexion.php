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
		$pseudo = $_POST['pseudo'];
		$ret = mysqli_query($bdd, 'SELECT * FROM compte WHERE pseudo LIKE("'.$pseudo.'") AND mdp LIKE("'.$mdp.'");');
		$ret = mysqli_fetch_array($ret, MYSQLI_ASSOC);

		if($ret == NULL){
			$error = 1;
		}else{
			session_unset();
			$_SESSION['pseudo'] = $ret['pseudo'];
			header('Location: index.php');
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $NomSite; ?> - Connexion</title>
    <link rel="icon" href="<?= $favicon ?>" />
    <?php require_once("../link.php"); ?>
</head>
<body>

    <!-- HEADER -->
    <?php require_once("../header.php"); ?>
    <!-- HEADER -->

    <h1 class="text-center">Connexion</h1>

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
    <?php require_once("../footer.php"); ?>
    <!-- FOOTER -->

    <?php require_once("../script.php"); ?>

</body>
</html>