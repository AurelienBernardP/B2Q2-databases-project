<?php
/*   include 'connexion_info.php';
   if(isset($_SESSION['connect']) AND $_SESSION['connect'] == 0){
      echo'<strong>Erreur</strong>: Impossible de voir cette page sans vous être connecter<br>';
      echo'Voici la page de connexion ---> <a href="connexion.php">Connexion</a>';
      session_destroy();
}
else{*/
?>
<html>
        <head>
                <meta charset="utf-8" />
                   <title>Ajout d'article</title>
        </head>

        <body>
        <?php                    
            echo "<h2>".$_POST['date_publi']."<h2>";
        ?>
            
        </body>
</html>
<?php 
    $bd = NULL; 
    
?>