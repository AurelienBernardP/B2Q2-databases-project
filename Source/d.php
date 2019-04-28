<?php
    include 'connexion_info.php';
    if(isset($_SESSION['connect']) AND $_SESSION['connect'] == 0){
      echo'Cannot view this page without being connected<br>';
      echo'Click here to establish a connection <a href="connexion.php">Connexion</a>';
      session_destroy();
   }
   else{
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8" />
   <title>d</title>
</head>
   <body>
      <h1><center>Requête D</center></h1>
      <br/>
      <p>
      Les chercheurs ayant écrit au moins un article en tant que premier auteur à toutes les conférences aucquelles ils ont participé : 
      </p>

      <?php
         $req = $bd->query('SELECT matricule, nom, prenom 
                            FROM Auteur
                            WHERE (SELECT COUNT (*)
                                   FROM (SELECT nom__conference, annee_conference
                                         FROM Auteur NATURAL JOIN participation_conference)
                                  )
                                 =
                                 (SELECT COUNT url
                                  FROM Article NATURAL JOIN article_conference
                                               NATURAL JOIN (SELECT DISTINCT annee_conference, nom_conference
                                                             FROM article_conference)
                                               NATURAL JOIN participation_conference) 
                           ');
         echo 'debut affichage';
         echo '<ul>';
         while ($donnees = $req->fetch())
         {
	         echo '<li> Chercheurs :' . $donnees['matricule'] . ' ' . $donnees['nom'] . ' ' . $donnees['prenom'] . '</li>';
         }
         echo '</ul>';
         $req->closeCursor();
      ?>


   </body>
</html>
<?php } ?>