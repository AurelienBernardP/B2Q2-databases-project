<?php
    include 'connexion_info.php';
    if(isset($_SESSION['connect']) AND $_SESSION['connect'] == 0){
      echo'Cannot view this page without being connected<br>';
      echo'Click here to establish a connection <a href="connexion.php">Connexion</a>';
      session_destroy();
   }
   else{
?>
<?php
function requestA($table){
   switch($table){
      
      // Auteur
      case 'Auteur' :

         echo 'debut auteur ';

         $condition = "TRUE";
         if($_GET['matricule'])
            $condition .= ' AND matricule = ' . $_GET['matricule'];

         echo 'après la première condition ';

         if($_GET['nom'])
            $condition .= ' AND nom = ' . $_GET['nom'];

         if($_GET['prenom'])
            $condition .= ' AND prenom = ' . $_GET['prenom'];

         if($_GET['debut_doctorat'])
            $condition .= ' AND debut_doctorat = ' . $_GET['debut_doctorat'];

         if($_GET['nom_institution'])
            $condition .= ' AND nom_institution = ' . $_GET['nom_institution'];

         echo 'query de auteur ';
         $req = $bd->query('SELECT * 
                            FROM Auteur
                            WHERE (' . condition . ')');
         echo 'apres le query ';
         if(!$req)
            echo "Erreur";

         echo 'debut affichage';
         echo '<ul>';
         while ($donnees = $req->fetch())
         {
	         echo '<li> Auteur :' . $donnees['matricule'] . ' ' . $donnees['nom'] . ' ' . $donnees['prenom'] . ' ' . $donnees['debut_doctorat'] . ' ' . $donnees['nom_institution'] . '</li>';
         }
         echo '</ul>';
         $req->closeCursor();
         break;

      // Institution
      case "Institution":

         $condition = "TRUE";
         if($_GET['nom'])
            $condition .= ' AND nom = ' . $_GET['nom'];

         if($_GET['rue'])
            $condition .= ' AND rue = ' . $_GET['rue'];

         if($_GET['numero'])
            $condition .= ' AND numero = ' . $_GET['numero'];

         if($_GET['ville'])
            $condition .= ' AND ville = ' . $_GET['ville'];

         if($_GET['pays'])
            $condition .= ' AND pays = ' . $_GET['pays'];

         $req = $bd->query('SELECT * 
                            FROM Institution
                            WHERE (' . condition . ')');
         if(!$req)
            echo "Erreur";

         echo '<ul>';
         while ($donnees = $req->fetch())
         {
	         echo '<li>' . $donnees['nom'] . ' ' . $donnees['rue'] . ' ' . $donnees['numero'] . ' ' . $donnees['ville'] . ' ' . $donnees['pays'] . '</li>';
         }
         echo '</ul>';
         break;
         $req->closeCursor();

      // Revue
      case "Revue":
         
         $condition = 'TRUE';
         if($_GET['nom'])
            $condition .= ' AND nom = ' . $_GET['nom'];

         if($_GET['impact'])
            $condition .= ' AND impact = ' . $_GET['impact'];
         
         $req = $bd->query('SELECT * 
                            FROM Revue
                            WHERE (' . condition . ')');
         if(!$req)
            echo "Erreur";

         echo '<ul>';
         while ($donnees = $req->fetch())
         {
	         echo '<li>' . $donnees['nom'] . ' ' . $donnees['impact'] . '</li>';
         }
         echo '</ul>';
         break;
         $req->closeCursor();

      // Conference
      case "Conference":

         $condition = "TRUE";
         if($_GET['nom'])
            $condition .= ' AND nom = ' . $_GET['nom'];

         if($_GET['annee'])
            $condition .= ' AND annee = ' . $_GET['annee'];

         if($_GET['rue'])
            $condition .= ' AND rue = ' . $_GET['rue'];

         if($_GET['numero'])
            $condition .= ' AND numero = ' . $_GET['numero'];

         if($_GET['ville'])
            $condition .= ' AND ville = ' . $_GET['ville'];

         if($_GET['pays'])
            $condition .= ' AND pays = ' . $_GET['pays'];

         $req = $bd->query('SELECT * 
                               FROM Conference
                               WHERE (' . condition . ')');
         if(!$req)
            echo "Erreur";

         echo '<ul>';
         while ($donnees = $req->fetch())
         {
	         echo '<li>' . $donnees['nom'] . ' ' . $donnees['annee'] . ' ' . $donnees['rue'] . ' ' . $donnees['numero'] . ' ' . $donnees['ville'] . ' ' . $donnees['pays'] . '</li>';
         }
         echo '</ul>';
         break;
         $req->closeCursor();

      // Article
      case "Article":

         $condition = "TRUE";
         if($_GET['url'])
            $condition .= ' AND url = ' . $_GET['url'];

         if($_GET['doi'])
            $condition .= ' AND doi = ' . $_GET['doi'];

         if($_GET['titre'])
            $condition .= ' AND titre = ' . $_GET['titre'];

         if($_GET['date_publication'])
            $condition .= ' AND date_publication = ' . $_GET['date_publication'];

         if($_GET['matricule_premier_auteur'])
            $condition .= ' AND matricule_premier_auteur = ' . $_GET['matricule_premier_auteur'];
      
         $req = $bd->query('SELECT * 
                             FROM Article
                             WHERE (' . condition . ')');
         if(!$req)
            echo "Erreur";

         echo '<ul>';
         while ($donnees = $req->fetch())
         {
	         echo '<li>' . $donnees['url'] . ' ' . $donnees['doi'] . ' ' . $donnees['titre'] . ' ' . $donnees['date_publication'] . ' ' . $donnees['matricule_premier_auteur'] . '</li>';
         }
         echo '</ul>';

         $req->closeCursor();
         break;

      // Sujet_Article
      case "Sujet_Article":

         $condition = "TRUE";
         if($_GET['url'])
            $condition .= ' AND url = ' . $_GET['url'];

         if($_GET['sujet'])
            $condition .= ' AND sujet = ' . $_GET['sujet'];

         $req = $bd->query('SELECT * 
                               FROM Sujet_Article
                               WHERE (' . condition . ')');
         if(!$req)
            echo "Erreur";

         echo '<ul>';
         while ($donnees = $req->fetch())
         {
	         echo '<li>' . $donnees['url'] . ' ' . $donnees['sujet'] . '</li>';
         }
         echo '</ul>';
         break;
         $req->closeCursor();

      // Second_Auteur
      case "Second_Auteur":

         $condition = "TRUE";
         if($_GET['url'])
            $condition .= ' AND url = ' . $_GET['url'];

         if($_GET['matricule_second_auteur'])
            $condition .= ' AND matricule_second_auteur = ' . $_GET['matricule_second_auteur'];

         $req = $bd->query('SELECT * 
                               FROM Second_Auteur
                               WHERE (' . condition . ')');
         if(!$req)
            echo "Erreur";

         echo '<ul>';
         while ($donnees = $req->fetch())
         {
	         echo '<li>' . $donnees['url'] . ' ' . $donnees['matricule_second_auteur'] . '</li>';
         }
         echo '</ul>';
         break;
         $req->closeCursor();

      // Article de Journal
      case "Article_Journal":

         $condition = "TRUE";
         if($_GET['url'])
            $condition .= ' AND url = ' . $_GET['url'];

         if($_GET['pg_debut'])
            $condition .= ' AND pg_debut = ' . $_GET['pg_debut'];

         if($_GET['pg_fin'])
            $condition .= ' AND pg_fin = ' . $_GET['pg_fin'];

         if($_GET['nom_revue'])
            $condition .= ' AND nom_revue = ' . $_GET['nom_revue'];

         if($_GET['n_journal'])
            $condition .= ' AND n_journal = ' . $_GET['n_journal'];

         $req = $bd->query('SELECT * 
                               FROM Article_Journal
                               WHERE (' . condition . ')');
         if(!$req)
            echo "Erreur";

         echo '<ul>';
         while ($donnees = $req->fetch())
         {
	         echo '<li>' . $donnees['url'] . ' ' . $donnees['pg_debut'] . ' ' . $donnees['pg_fin'] . ' ' . $donnees['nom_revue'] . ' ' . $donnees['n_journal'] . '</li>';
         }
         echo '</ul>';
         break;
         $req->closeCursor();
   
      // Article de Conférence
      case "Article_Conference":

         $condition = "TRUE";
         if($_GET['url'])
            $condition .= ' AND url = ' . $_GET['url'];

         if($_GET['presentation'])
            $condition .= ' AND presentation = ' . $_GET['presentation'];

         if($_GET['nom_conference'])
            $condition .= ' AND nom_conference = ' . $_GET['nom_conference'];

         if($_GET['annee_conference'])
            $condition .= ' AND annee_conference = ' . $_GET['annee_conference'];
         
         $req = $bd->query('SELECT * 
                               FROM Article_Journal
                               WHERE (' . condition . ')');
         if(!$req)
            echo "Erreur";

         echo '<ul>';
         while ($donnees = $req->fetch())
         {
	         echo '<li>' . $donnees['url'] . ' ' . $donnees['presentation'] . ' ' . $donnees['nom_conference'] . ' ' . $donnees['annee_conference'] . '</li>';
         }
         echo '</ul>';
         break;
         $req->closeCursor();

      // Participation_Conference
      case "Participation_Conference":

         $condition = "TRUE";
         if($_GET['matricule'])
            $condition .= ' AND matricule = ' . $_GET['matricule'];

         if($_GET['nom_conference'])
            $condition .= ' AND nom_conference = ' . $_GET['nom_conference'];

         if($_GET['annee_conference'])
            $condition .= ' AND annee_conference = ' . $_GET['annee_conference'];

         if($_GET['tarif'])
            $condition .= ' AND tarif = ' . $_GET['tarif'];
         
         $req = $bd->query('SELECT * 
                               FROM Participation_Conference
                               WHERE (' . condition . ')');
         if(!$req)
            echo "Erreur";

         echo '<ul>';
         while ($donnees = $req->fetch())
         {
	         echo '<li>' . $donnees['matricule'] . ' ' . $donnees['nom_conference'] . ' ' . $donnees['annee_conference'] . ' ' . $donnees['tarif'] . '</li>';
         }
         echo '</ul>';
         break;
         $req->closeCursor();

      default:
         echo $tuple . ' n\'est pas une table de la base de donnée.' . '</br>';
         break;
   }
}
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
      <?php echo 'la table :' . $_POST['table'];
      requestA($_POST['table']); // erreur ?>
      Fin de l'affichage de la table

   </body>
</html>
<?php } ?>