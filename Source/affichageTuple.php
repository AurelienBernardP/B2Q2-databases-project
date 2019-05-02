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
   <title>affichageTuple</title>
</head>
   <body>
      <h1><center>Résultat requête A</center></h1>
      <br/>

      Début d'affichage de 
      <?php echo 'la table : ' . $_POST['table'] . '</br> ';

      switch($_POST['table']){
      
         // Auteur
         case 'Auteur' :
   
            $condition = "TRUE";
            if(!empty($_POST['matricule']))
               $condition .= " AND matricule = " . $_POST['matricule'];
   
            if(!empty($_POST['nom']))
               $condition .= " AND nom = " . $_POST['nom'];
   
            if(!empty($_POST['prenom'])){
               $condition .= ' AND prenom = \'' . $_POST['prenom'] . '\'';
            }
   
            if(!empty($_POST['debut_doctorat']))
               $condition .= " AND debut_doctorat = " . $_POST['debut_doctorat'];
   
            if(!empty($_POST['nom_institution']))
               $condition .= " AND nom_institution = " . $_POST['nom_institution'];

            $query = 'SELECT * FROM Auteur WHERE (' . $condition . ')';
            echo $query;

            $req = $db->query($query);

            if(!$req)
               echo "Erreur";
   
            echo '<ul>';
            while ($data = $req->fetch())
            {
               echo '<li>' . $data['matricule'] . ' ' . $data['nom'] . ' ' . $data['prenom'] . ' ' . $data['debut_doctorat'] . ' ' . $data['nom_institution'] . '</li>';
            }
            echo '</ul>';

            $req->closeCursor();
            break;
   
         // Institution
         case "Institution":
   
            $condition = "TRUE";
            if($_POST['nom'])
               $condition .= " AND nom = " . $_POST['nom'];
   
            if($_POST['rue'])
               $condition .= " AND rue = " . $_POST['rue'];
   
            if($_POST['numero'])
               $condition .= " AND numero = " . $_POST['numero'];
   
            if($_POST['ville'])
               $condition .= " AND ville = " . $_POST['ville'];
   
            if($_POST['pays'])
               $condition .= " AND pays = " . $_POST['pays'];
   
               echo $condition;

            $req = $db->query('SELECT * 
                               FROM Institution
                               WHERE (' . $condition . ')');
            if(!$req)
               echo "Erreur";
   
            echo '<ul>';
            while ($data = $req->fetch())
            {
               echo '<li>' . $data['nom'] . ' ' . $data['rue'] . ' ' . $data['numero'] . ' ' . $data['ville'] . ' ' . $data['pays'] . '</li>';
            }
            echo '</ul>';
            break;
            $req->closeCursor();
   
         // Revue
         case "Revue":
            
            $condition = 'TRUE';
            if($_POST['nom'])
               $condition .= " AND nom = " . $_POST['nom'];
   
            if($_POST['impact'])
               $condition .= " AND impact = " . $_POST['impact'];
            
            echo $condition;
            $req = $db->query('SELECT * 
                               FROM Revue
                               WHERE (' . $condition . ')');
            if(!$req)
               echo "Erreur";
   
            echo '<ul>';
            while ($data = $req->fetch())
            {
               echo '<li>' . $data['nom'] . ' ' . $data['impact'] . '</li>';
            }
            echo '</ul>';
            break;
            $req->closeCursor();
   
         // Conference
         case "Conference":
   
            $condition = "TRUE";
            if($_POST['nom'])
               $condition .= " AND nom = " . $_POST['nom'];
   
            if($_POST['annee'])
               $condition .= " AND annee = " . $_POST['annee'];
   
            if($_POST['rue'])
               $condition .= " AND rue = " . $_POST['rue'];
   
            if($_POST['numero'])
               $condition .= " AND numero = " . $_POST['numero'];
   
            if($_POST['ville'])
               $condition .= " AND ville = " . $_POST['ville'];
   
            if($_POST['pays'])
               $condition .= " AND pays = " . $_POST['pays'];
   
               echo $condition;

            $req = $db->query('SELECT * 
                                  FROM Conference
                                  WHERE (' . $condition . ')');
            if(!$req)
               echo "Erreur";
   
            echo '<ul>';
            while ($data = $req->fetch())
            {
               echo '<li>' . $data['nom'] . ' ' . $data['annee'] . ' ' . $data['rue'] . ' ' . $data['numero'] . ' ' . $data['ville'] . ' ' . $data['pays'] . '</li>';
            }
            echo '</ul>';
            break;
            $req->closeCursor();
   
         // Article
         case "Article":
   
            $condition = "TRUE";
            if($_POST['url'])
               $condition .= " AND url = " . $_POST['url'];
   
            if($_POST['doi'])
               $condition .= " AND doi = " . $_POST['doi'];
   
            if($_POST['titre'])
               $condition .= " AND titre = ". $_POST['titre'];
   
            if($_POST['date_publication'])
               $condition .= " AND date_publication = " . $_POST['date_publication'];
   
            if($_POST['matricule_premier_auteur'])
               $condition .= " AND matricule_premier_auteur = " . $_POST['matricule_premier_auteur'];
         
               echo $condition;

            $req = $db->query('SELECT * 
                                FROM Article
                                WHERE (' . $condition . ')');
            if(!$req)
               echo "Erreur";
   
            echo '<ul>';
            while ($data = $req->fetch())
            {
               echo '<li>' . $data['url'] . ' ' . $data['doi'] . ' ' . $data['titre'] . ' ' . $data['date_publication'] . ' ' . $data['matricule_premier_auteur'] . '</li>';
            }
            echo '</ul>';
   
            $req->closeCursor();
            break;
   
         // Sujet_Article
         case "Sujet_Article":
   
            $condition = "TRUE";
            if($_POST['url'])
               $condition .= " AND url = ". $_POST['url'];
   
            if($_POST['sujet'])
               $condition .= " AND sujet = " . $_POST['sujet'];
   
               echo $condition;

            $req = $db->query('SELECT * 
                                  FROM Sujet_Article
                                  WHERE (' . $condition . ')');
            if(!$req)
               echo "Erreur";
   
            echo '<ul>';
            while ($data = $req->fetch())
            {
               echo '<li>' . $data['url'] . ' ' . $data['sujet'] . '</li>';
            }
            echo '</ul>';
            break;
            $req->closeCursor();
   
         // Second_Auteur
         case "Second_Auteur":
   
            $condition = "TRUE";
            if($_POST['url'])
               $condition .= " AND url = " . $_POST['url'];
   
            if($_POST['matricule_second_auteur'])
               $condition .= " AND matricule_second_auteur = " . $_POST['matricule_second_auteur'];
   
               echo $condition;

            $req = $db->query('SELECT * 
                                  FROM Second_Auteur
                                  WHERE (' . $condition . ')');
            if(!$req)
               echo "Erreur";
   
            echo '<ul>';
            while ($data = $req->fetch())
            {
               echo '<li>' . $data['url'] . ' ' . $data['matricule_second_auteur'] . '</li>';
            }
            echo '</ul>';
            break;
            $req->closeCursor();
   
         // Article de Journal
         case "Article_Journal":
   
            $condition = "TRUE";
            if($_POST['url'])
               $condition .= " AND url = " . $_POST['url'];
   
            if($_POST['pg_debut'])
               $condition .= " AND pg_debut = " . $_POST['pg_debut'];
   
            if($_POST['pg_fin'])
               $condition .= " AND pg_fin = " . $_POST['pg_fin'];
   
            if($_POST['nom_revue'])
               $condition .= " AND nom_revue = " . $_POST['nom_revue'];
   
            if($_POST['n_journal'])
               $condition .= " AND n_journal = " . $_POST['n_journal'];
   
               echo $condition;

            $req = $db->query('SELECT * 
                                  FROM Article_Journal
                                  WHERE (' . $condition . ')');
            if(!$req)
               echo "Erreur";
   
            echo '<ul>';
            while ($data = $req->fetch())
            {
               echo '<li>' . $data['url'] . ' ' . $data['pg_debut'] . ' ' . $data['pg_fin'] . ' ' . $data['nom_revue'] . ' ' . $data['n_journal'] . '</li>';
            }
            echo '</ul>';
            break;
            $req->closeCursor();
      
         // Article de Conférence
         case "Article_Conference":
   
            $condition = "TRUE";
            if($_POST['url'])
               $condition .= " AND url = " . $_POST['url'];
   
            if($_POST['presentation'])
               $condition .= " AND presentation = " . $_POST['presentation'];
   
            if($_POST['nom_conference'])
               $condition .= " AND nom_conference = " . $_POST['nom_conference'];
   
            if($_POST['annee_conference'])
               $condition .= " AND annee_conference = " . $_POST['annee_conference'];
            
               echo $condition;

            $req = $db->query('SELECT * 
                                  FROM Article_Journal
                                  WHERE (' . $condition . ')');
            if(!$req)
               echo "Erreur";
   
            echo '<ul>';
            while ($data = $req->fetch())
            {
               echo '<li>' . $data['url'] . ' ' . $data['presentation'] . ' ' . $data['nom_conference'] . ' ' . $data['annee_conference'] . '</li>';
            }
            echo '</ul>';
            break;
            $req->closeCursor();
   
         // Participation_Conference
         case "Participation_Conference":
   
            $condition = "TRUE";
            if($_POST['matricule'])
               $condition .= " AND matricule = " . $_POST['matricule'];
   
            if($_POST['nom_conference'])
               $condition .= " AND nom_conference = " . $_POST['nom_conference'];
   
            if($_POST['annee_conference'])
               $condition .= " AND annee_conference = " . $_POST['annee_conference'];
   
            if($_POST['tarif'])
               $condition .= " AND tarif = " . $_POST['tarif'];
            
               echo $condition;

            $req = $db->query('SELECT * 
                                  FROM Participation_Conference
                                  WHERE (' . $condition . ')');
            if(!$req)
               echo "Erreur";
   
            echo '<ul>';
            while ($data = $req->fetch())
            {
               echo '<li>' . $data['matricule'] . ' ' . $data['nom_conference'] . ' ' . $data['annee_conference'] . ' ' . $data['tarif'] . '</li>';
            }
            echo '</ul>';
            break;
            $req->closeCursor();
   
         default:
            echo $tuple . ' n\'est pas une table de la base de donnée.' . '</br>';
            break;
      }?>

   </body>
</html>
<?php } ?>