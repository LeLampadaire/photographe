<?php 
    session_start();
	require_once("../configuration.php"); 
    require_once("../bdd_connexion.php"); 
    
    if(empty($_SESSION)){
        header('Location: connexion.php');
    }

    $services = mysqli_query($bdd, 'SELECT * FROM services ORDER BY id DESC;');
    
    if(isset($_POST['vu'])){
        $vu = $_POST['vu'];
        $id = $_POST['id'];

        mysqli_query($bdd, 'UPDATE services SET vu='.$vu.' WHERE id='.$id.';');
        header('Location: services.php');
    }
    
    if(isset($_POST['supp'])){
        $id = $_POST['id'];

        mysqli_query($bdd, 'DELETE FROM services WHERE services.id='.$id.';');
        header('Location: services.php');
    }
?>

<html>
<head>
    <title><?php echo $NomSite; ?> - Services</title>
    <link rel="icon" href="<?= $favicon ?>" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="../styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
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
            <h1 style="text-align: center;">Services</h1>
            <table class="table" style="border: 2px solid black">
                <thead class="thead-light">
                    <tr>
                        <th>Services</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Mail</th>
                        <th>Téléphone</th>
                        <th>Lu</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($services as $donnees){
                        echo '<tr>';
                            echo '<td>'.$donnees['services'].'</td>';
                            echo '<td>'.$donnees['nom'].'</td>';
                            echo '<td>'.$donnees['prenom'].'</td>';
                            echo '<td>'.$donnees['mail'].'</td>';
                            echo '<td>'.$donnees['telephone'].'</td>';
                        ?>
                        <form action="" method="POST">
                            <input type="hidden" value="<?php echo $donnees['id']; ?>" name="id">
                            <?php
                                if($donnees['vu'] == 1){
                                    echo '<td><div><button type="submit" class="btn btn-success" value="0" name="vu">Lu</button></div></td>';
                                }else{
                                    echo '<td><div><button type="submit" class="btn btn-warning" value="1" name="vu">Non lu</button></div></td>';
                                }
                                
                                echo'<td><button type="submit" name="supp" class="btn btn-danger">X</button></td>';
                            ?>
                        </form>
                        <?php
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
      require_once("footer-admin.php");
    ?>

</body>

<script>

    $('#exampleModal').modal('show');


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