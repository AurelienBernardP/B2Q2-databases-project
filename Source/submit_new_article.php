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
                echo "<h2><center> ERROR:</center></h2> <h2><center> inserted url is already in the database</center> </h2>";
                $insertionERROR = True;
            }

        ?>
        <?php
            $req = $db->query("SELECT * FROM Article WHERE doi = '".$_POST['DOI']."';");
            if($check = $req->fetch()){
                echo "<h2><center> ERROR:</center></h2> <h2><center> inserted doi is already in the database </center></h2>";
                $insertionERROR = True;
            }
            $yearPubli = date("Y", strtotime($_POST['date_publi']));
            echo "<h1>date de publi: ".$_POST['date_publi']."</h1>";
        ?>
        <?php

        ?>
        <?php 
            switch($_POST['type_article']){
                case "conference":

                    $req = $db->query("SELECT * FROM Conference WHERE annee = '".$yearPubli."' AND nom LIKE'".$_POST['nom_conference']."';");
                    if(!($check = $req->fetch())){
                        echo"<h2><center> ERROR:</center></h2> <h2><center> no conference with the same year of publication and the given name of the conference existis in the database</center></h2>";
                    }
                    break;

                case "journal":

                    if($_POST['page_debut'] > $_POST['page_fin']){
                        echo "<h2><center> ERROR:</center></h2> <h2><center>beginning page has to be smaller or equal to end page </center></h2>";
                        $insertionERROR = True;
                        break;
                    }

                    $req = $db->query("SELECT * FROM Article_Journal WHERE n_journal = '".$_POST['nb_journal']."' AND nom_revue LIKE '".$_POST['nom_revue']."' ;");
                    if(!($check = $req->fetch())){
                        echo "<h2><center> ERROR:</center></h2><h2><center> La combinaison de numero de journal et nom de la revue n'éxiste pas dans la base de donees.</center></h2>";
                        $insertionERROR = True;
                        break;
                    }
                    
                    $req = $db->query("SELECT * FROM Article_Journal NATURAL JOIN (SELECT url, date_publication FROM Article) AS dates WHERE n_journal = '".$_POST['nb_journal']."' AND nom_revue LIKE '".$_POST['nom_revue']."' ;");
                    $yearJournal = date("Y", strtotime($req->fetch()));
                    if($yearJournal != $yearPubli){
                        echo "<h2><center> ERROR: </center></h2> <h2><center>L'année de publication de l'article est différente de l'année de publication des autres articles dans le journal.</center></h2>";
                        echo "<h3><center> année journal =".$yearJournal."année de l'article =".$yearPubli.".</center></h3>";
                        $insertionERROR = True;
                        break;
                    }

                    break;
                default:
                    echo "<h2><center> ERROR: </center></h2> <h2><center>Unable to process type of article</center></h1>";
                    $insertionERROR = True;
                    break;
                }
        ?>
        <?php
            if($insertionERROR == True){
                echo "<h2><center> Please retry insertion</center> <h2>";
                ?>
                <button name="back_to_insert" type="submit" onclick="location.href = 'c.php';" value="back_to_insert">Go back to submission form</button>
                <?php
            }else{
                try{
                    $db->beginTransaction();
                    $prepared = $db->prepare('INSERT INTO Article 
                                VALUES("'.$_POST['URL']. '", '.$_POST['DOI']. ', "'.$_POST['titre_article']. '", "'. $_POST['date_publi']. '", '.$_POST['matricule']. ');');
                    $prepared->execute();
                    $db->commit();
                    echo "creation sucesfull";
                }catch(PDOExecption $e){
                    $db->rollback();
                    echo "Unable to insert new article" . $e->getMessage();
                    echo "<h2><center> Please retry insertion</center> <h2>";

                }

                switch($_POST['type_article']){
                    case "conference":
                        try{
                            $db->beginTransaction();
                            $prepared = $db->prepare('INSERT INTO Article_Conference
                                VALUES ("'.$_POST['URL'].'","'.$_POST['type_presentation'].'","'.$_POST['nom_conference'].'",'.$yearPubli.');');

                            $prepared->execute();
                            $db->commit();
                            echo "<h1>insertion conf good</h1>";
                            break;
                        }catch(PDOExecption $e){
                            $db->rollback();
                            echo "Unable to insert new article" . $e->getMessage();
                            $insertionERROR = True;
                            break;
                        }
                        break;
                    case "journal":
                        try{
                            $db->beginTransaction();
                            $prepared = $db->prepare('INSERT INTO Article_Journal 
                                VALUES ("'.$_POST['URL'].'",'.$_POST['page_debut'].','.$_POST['page_fin'].',"'.$_POST['nom_revue'].'",'.$_POST['nb_journal'].');');
                            $prepared->execute();
                            $db->commit();
                            echo "<h1>insertion good</h1>";
                            break;
                        }catch(PDOExecption $e){
                            $db->rollback();
                            echo "Unable to insert new article" . $e->getMessage();
                            $insertionERROR = True;
                            
                            break;
                        }
                        break;
                       } 
                ?>
                <center><button name="back_to_main" type="submit" onclick="location.href = 'main_menu.php';" value="back_to_main">Go back to main menu</button></center>
                <?php
            }
            
        ?>
        </body>
</html>
<?php 
    $db = NULL; 
    }
?>