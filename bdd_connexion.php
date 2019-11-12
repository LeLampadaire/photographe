<?php

    $bdd = mysqli_connect("localhost", "identifiant", "motdepasse", "Nom de la base de donnée");

    if(!$bdd){
        echo "<div class='container'><div class='alert alert-danger' role='alert'>";
        echo "Erreur connexion SQL !";
        echo "</div></div>";
        exit();
    }


?>