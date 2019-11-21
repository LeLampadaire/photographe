<?php 
    session_start();

	require_once("../configuration.php"); 
    require_once("../bdd_connexion.php"); 
    
    if(empty($_SESSION)){
        header('Location: connexion.php');
    }
    
    $messages = mysqli_query($bdd, 'SELECT * FROM contact ORDER BY id DESC;');
    
    if(isset($_POST['vu'])){
        $vu = $_POST['vu'];
        $id = $_POST['id'];

        mysqli_query($bdd, 'UPDATE contact SET vu='.$vu.' WHERE id='.$id.';');
        header('Location: messages.php');
    }
    
    if(isset($_POST['supp'])){
        $id = $_POST['id'];

        mysqli_query($bdd, 'DELETE FROM contact WHERE contact.id='.$id.';');
        header('Location: messages.php');
    }

?>

<html>
<head>
    <title><?php echo $NomSite; ?> - Messages</title>
    <link rel="icon" href="<?= $favicon ?>" />
    <?php require_once("../link.php"); ?>
</head>
<body>

    <!-- HEADER -->
    <?php require_once("../header.php"); ?>
    <!-- HEADER -->

    <br>

    <div class="container-fluid">
        <a href="javascript:history.back()"><button type="button" class="btn btn-info">Retour</button></a>

        <div class="container">
            <h1 class="text-center">Messages</h1>
            <table class="tableBorderBlack table">
                <thead class="thead-light">
                    <tr>
                        <th>Prénom</th>
                        <th>Mail</th>
                        <th>Messages</th>
                        <th>Lu</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($messages as $donnees){
                        echo '<tr>';
                            echo '<td>'.$donnees['prenom'].'</td>';
                            echo '<td>'.$donnees['mail'].'</td>';
                            echo '<td width="500px">'.$donnees['message'].'</td>';
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

        <a href="javascript:history.back()"><button type="button" class="btn btn-info">Retour</button></a>
    </div>

    <br>
    
    <!-- FOOTER -->
    <?php require_once("../footer.php"); ?>
    <!-- FOOTER -->

    <script src="/script.js"></script>

</body>
</html>