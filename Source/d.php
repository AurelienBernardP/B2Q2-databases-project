<?php
    include 'connexion_info.php';
    if(isset($_SESSION['connect']) AND $_SESSION['connect'] == 0){
      echo'Cannot view this page without being connected<br>';
      echo'Click here to establish a connection <a href="connexion.php">Connexion</a>';
      session_destroy();
   }
   else{
?>

<html>
<head>
   <meta charset="utf-8" />
   <title>d</title>
</head>
   <body>
   <?php 

            $que = " SELECT Auteur.matricule, Auteur.nom, Auteur.prenom
                     FROM Auteur
                     WHERE matricule NOT IN (SELECT Participation_Conference.matricule
                                             FROM Participation_Conference 
                                             WHERE NOT EXISTS (SELECT matricule, annee_conference, nom_conference 
                                                               FROM Auteur NATURAL JOIN (SELECT matricule_premier_auteur AS matricule, url 
                                                                                         FROM Article) AS Article_bis 
                                                                           NATURAL JOIN Article_Conference
                                                               WHERE Participation_Conference.matricule = Auteur.matricule 
                                                                  AND Participation_Conference.annee_conference = Article_Conference.annee_conference
                                                                  AND Participation_Conference.nom_conference = Article_Conference.nom_conference)
                     )
                     GROUP BY Auteur.matricule ";

         $req = $db->query($que);
         if(!$req)
            echo 'error query';
        ?>
      <h1><center>Requête D</center></h1>
      <br/>


      <p>
      Les chercheurs ayant écrit au moins un article en tant que premier auteur à toutes les conférences aucquelles ils ont participé : 
      </p>

      
         
         <?php
         echo $que;
         while ($donnees = $req->fetch())
         {
        ?>
	        <li><?php echo $donnees['matricule'] . ' ' . $donnees['nom'] . ' ' . $donnees['prenom'];?></li>
        <?php
         }
         $req->closeCursor();
      ?>

   </body>
</html>
<?php } ?>