<?php

    $bdd = mysqli_connect("185.98.131.92", "rausi1259077", "hu3uulkgqp", "rausi1259077");

    if(!$bdd){
        echo "<div class='container'><div class='alert alert-danger' role='alert'>";
        echo "Erreur connexion SQL !";
        echo "</div></div>";
    }


?>