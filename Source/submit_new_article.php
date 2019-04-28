<?php
   include 'connexion_info.php';
   if(isset($_SESSION['connect']) AND $_SESSION['connect'] == 0){
      echo'<strong>Erreur</strong>: Impossible de voir cette page sans vous être connecter<br>';
      echo'Voici la page de connexion ---> <a href="connexion.php">Connexion</a>';
      session_destroy();
}
else{
?>
<html>
        <head>
                <meta charset="utf-8" />
                   <title>Ajout d'article</title>
        </head>

        <body>
        <?php
            // check if the information inserted in the form respects the database constraints
            $req = $db->query("SELECT * FROM Article WHERE 'url' LIKE '".$_POST['URL']."';");
            $insertionERROR = False;
            if($check = $req->fetch()){
                echo "<h2> error: inserted url is already in the database </h2>";
                $insertionERROR = True;
            }

        ?>
        <?php
            $req = $db->query("SELECT * FROM Article WHERE doi = '".$_POST['DOI']."';");
            if($check = $req->fetch()){
                echo "<h2> error: inserted doi is already in the database </h2>";
                $insertionERROR = True;
            }

        ?>
        <?php 
            switch($_POST['type_article']){
                case "conference":
                    $yearPubli = date("Y", strtotime($_POST['date_publi']));

                    $req1 = $db->query("SELECT * FROM Conference WHERE 'annee' = ".$yearPubli."';");
                    break;
                case "journal":                 
                    if($_POST['page_debut'] > $_POST['page_fin']){
                        echo "<h2> error: beginning page has to be smaller or equal to end page </h2>";
                        $insertionERROR = True;
                    }
                    break;
                default:
                    echo "<h1>Error processing type of article</h1>";
                    break;
                }
        ?>
        <?php
            if($insertionERROR == True){
                echo "<h2> Please retry with correctly formated entries <h2>";
                ?>
                <button name="back_to_insert" type="submit" action = "c.php"  value="back_to_insert">Go back to submission form</button>
                <?php
            }else{

            }
            
        ?>

            
        </body>
</html>
<?php 
    $db = NULL; 
    }
?>