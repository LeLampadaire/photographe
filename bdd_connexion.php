<?php

    $bdd = mysqli_connect("localhost", "root", "", "stef");
    $bdd->set_charset("utf8");

    if(!$bdd){
        echo "<div>";
        echo "Erreur connexion SQL !";
        echo "</div>";
        exit();
    }


?>