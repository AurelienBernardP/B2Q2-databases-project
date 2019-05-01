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
   
      // group14 qsEtZcVPct

      // 4M2*V29*



      $quen = "SELECT matricule, nom, prenom, annee_conference, nom_conference, matricule_premier_auteur, titre
            FROM Article NATURAL JOIN Article_Conference NATURAL JOIN Participation_Conference NATURAL JOIN Auteur
            WHERE tarif LIKE 'author fee' AND matricule IN (SELECT matricule_premier_auteur FROM Auteur NATURAL JOIN Participation_Conference NATURAL JOIN Article_Conference NATURAL JOIN Article)
            GROUP BY titre ";    

/* 
Selectionne tous les tuples du croisement des tables des article de conference et de participation conference et auteur aussi.
WHERE le matricule de ce croisement est egal au matricule_premier auteur de article_conf ecrit par ceux qui on participé a des conf

*/
         $qule = "SELECT *
                  FROM ((Participation_Conference INNER JOIN Article_Conference ON Article_Conference.annee_conference = Participation_Conference.annee_conference 
                                                                              AND Article_Conference.nom_conference = Participation_Conference.nom_conference)
                                                   INNER JOIN Auteur ON Participation_Conference.matricule = Auteur.matricule)
                  WHERE matricule IN (SELECT matricule_premier_auteur 
                                          FROM ((Article INNER JOIN Article_Conference ON Article.url = Article_Conference.url)
                                                         INNER JOIN Participation_Conference ON Article.matricule_premier_auteur = Participation_Conference.matricule)
                                       )
                  GROUP BY matricule              
                                                   
                  ";



         $que = "SELECT matricule, matricule_premier_auteur
                  FROM ((Article_Conference INNER JOIN Article ON Article_Conference.url LIKE Article.url)
                                             INNER JOIN Participation_Conference ON Article_Conference.annee_conference = Participation_Conference.annee_conference 
                                                                                 AND Article_Conference.nom_conference LIKE Participation_Conference.nom_conference)
                  WHERE Participation_Conference.matricule NOT IN (((SELECT matricule_premier_auteur
                                                                  FROM ((Auteur INNER JOIN Participation_Conference ON Auteur.matricule = Participation_Conference.matricule) 
                                                                              INNER JOIN Article_Conference ON Article_Conference.annee_conference = Participation_Conference.annee_conference 
                                                                                                            AND Article_Conference.nom_conference LIKE Participation_Conference.nom_conference)
                                                                              INNER JOIN Article ON Article.url LIKE Auteur.url)
                                                                  )
                  GROUP BY matricule              
                                 
                  ";





         $queu = "SELECT *
               FROM ((Article_Conference INNER JOIN Article ON Article_Conference.url = Article.url)
                                          INNER JOIN Participation_Conference
                                          ON Article_Conference.annee_conference = Participation_Conference.annee_conference 
                                          AND Article_Conference.nom_conference = Participation_Conference.nom_conference)
               WHERE tarif LIKE 'author fee' 
                     AND ((SELECT matricule FROM Auteur NATURAL JOIN Participation_Conference NATURAL JOIN Article_Conference) 
                           IN 
                           (SELECT matricule_premier_auteur FROM ((Article INNER JOIN Article_Conference ON Article.url = Article_Conference.url) 
                                                                           INNER JOIN Participation_Conference ON Article.matricule_premier_auteur = Participation_Conference)
                                                                                                   NATURAL JOIN Particpation_Conference NATURAL JOIN Auteur))
               GROUP BY matricule
               ";

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
	        <li><?php echo $donnees['matricule'] . ' ' . $donnees['nom'] . ' ' . $donnees['prenom'] . ' ' . $donnees['annee_conference'] . ' ' . $donnees['nom_conference'] . ' ' . $donnees['matricule_premier_auteur'] . ' ' . $donnees['titre'];?></li>
        <?php }
         //echo '</ul>';
         $req->closeCursor();
      ?>

   </body>
</html>
<?php } ?>