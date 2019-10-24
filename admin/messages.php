<?php 
	require_once("../configuration.php"); 
    require_once("../bdd_connexion.php"); 

    $messages = mysqli_query($bdd, 'SELECT * FROM contact;');
?>

<html>
<head>
    <title><?php echo $NomSite; ?> - Messages</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

    <?php 
      // HEADER //
      require_once("header-admin.php"); 
    ?>

    <br>

    <div class="container-fluid">
        <a href="index.php"><button type="button" class="btn btn-info">Retour</button></a>

        <div class="container">
            <table class="table" style="border: 2px solid black">
                <thead class="thead-light">
                    <tr>
                        <th>Prénom</th>
                        <th>Mail</th>
                        <th>Messages</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($messages as $donnees){
                        echo '<tr>';
                            echo '<td>'.$donnees['prenom'].'</td>';
                            echo '<td>'.$donnees['mail'].'</td>';
                            echo '<td>'.$donnees['message'].'</td>';
                        echo '</tr>';
                    } ?>
                </tbody>
            </table>
        </div>

        <a href="index.php"><button type="button" class="btn btn-info">Retour</button></a>
    </div>

    <br>
      
    <?php 
      // FOOTER //
      require_once("../footer.php");
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