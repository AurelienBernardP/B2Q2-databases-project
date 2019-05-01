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
   <title>optionTuple</title>

   <!-- Affichage des options de recherches des tuples -->
</head>
   <body>
      <h1><center>Tuples de la table <?php echo $_POST['table'] ?></center></h1>
      <br/>
      <p>
      Affiner votre recherche :
      </p>

   <?php
      $table = $_POST['table'];
      switch($_POST['table']){
         case 'Article' :
            ?>
               <form action="affichageTuple.php" method="post">
                  <?php echo "<input type=\"hidden\" name=\"table\" value=".$table." />"; ?>
                  <p>
                     Entrer l'url :
                     <input type="text" name="url" />
                  </p>

                  <p>
                     Entrer le doi :
                     <input type="text" name="doi" />
                  </p>

                  <p>
                     Entrer le titre :
                     <input type="text" name="titre" />
                  </p>

                  <p>
                     Entrer la date de publication :
                     <input type="text" name="date_publication" />
                  </p>

                  <p>
                     Entrer le matricule du premier auteur :
                     <input type="text" name="matricule_premier_auteur" />
                  </p>
                  <input type="submit" value="Valider" />
               </form>
            <?php
            break;
            
         case 'Auteur' :
         ?>
            <form action="affichageTuple.php" method="post">
               <?php echo "<input type=\"hidden\" name=\"table\" value=".$table." />"; ?>
               <p>
                  Entrer le matricule :
                  <input type="text" name="matricule" />
               </p>

               <p>
                  Entrer le nom :
                  <input type="text" name="nom" />
               </p>

               <p>
                  Entrer le prénom :
                  <input type="text" name="prenom" />
               </p>

               <p>
                  Entrer la date de début de doctorat :
                  <input type="text" name="debut_doctorat" />
               </p>


               <p>
                  Entrer le nom de l'institution :
                  <input type="text" name="nom_institution" />
               </p>
               <input type="submit" value="Valider" />
            </form>
         <?php
         break;

         case 'Institution' :
         ?>
            <form action="affichageTuple.php" method="post">
               <?php echo "<input type=\"hidden\" name=\"table\" value=".$table." />"; ?>
               <p>
                  Entrer le nom :
                  <input type="text" name="nom" />
               </p>

               <p>
                  Entrer la rue :
                  <input type="text" name="rue" />
               </p>

               <p>
                  Entrer le numéro :
                  <input type="text" name="numero" />
               </p>

               <p>
                  Entrer la ville :
                  <input type="text" name="ville" />
               </p>


               <p>
                  Entrer le pays :
                  <input type="text" name="pays" />
               </p>
               <input type="submit" value="Valider" />
            </form>
         <?php
         break;

         case 'Sujet_Article' :
         ?>
            <form action="affichageTuple.php" method="post">
               <?php echo "<input type=\"hidden\" name=\"table\" value=".$table." />"; ?>
               <p>
                  Entrer l'URL :
                  <input type="text" name="url" />
               </p>

               <p>
                  Entrer le sujet :
                  <input type="text" name="sujet" />
               </p>

               <input type="submit" value="Valider" />
            </form>
         <?php
         break;

         case 'Second_Auteur' :
         ?>
            <form action="affichageTuple.php" method="post">
               <?php echo "<input type=\"hidden\" name=\"table\" value=".$table." />"; ?>
               <p>
                  Entrer l'URL :
                  <input type="text" name="url" />
               </p>

               <p>
                  Entrer le matricule :
                  <input type="text" name="matricule_second_auteur" />
               </p>

               <input type="submit" value="Valider" />
            </form>
         <?php
         break;

         case 'Article_Journal' :
         ?>
            <form action="affichageTuple.php" method="post">
               <?php echo "<input type=\"hidden\" name=\"table\" value=".$table." />"; ?>
               <p>
                  Entrer l'URL :
                  <input type="text" name="url" />
               </p>

               <p>
                  Entrer la page de début :
                  <input type="text" name="pg_debut" />
               </p>

               <p>
                  Entrer la page de fin :
                  <input type="text" name="pg_fin" />
               </p>

               <p>
                  Entrer le nom de la revue :
                  <input type="text" name="nom_revue" />
               </p>


               <p>
                  Entrer le numéro du journal :
                  <input type="text" name="n_journal" />
               </p>
               <input type="submit" value="Valider" />
            </form>
         <?php
         break;

         case 'Article_Conference' :
         ?>
            <form action="affichageTuple.php" method="post">
               <?php echo "<input type=\"hidden\" name=\"table\" value=".$table." />"; ?>
               <p>
                  Entrer l'URL :
                  <input type="text" name="url" />
               </p>

               <p>
                  Entrer le type de présentation :
                  <input type="text" name="presentation" />
               </p>

               <p>
                  Entrer le nom de la conférence :
                  <input type="text" name="nom_conference" />
               </p>


               <p>
                  Entrer l'année de la conférence :
                  <input type="text" name="annee_conference" />
               </p>
               <input type="submit" value="Valider" />
            </form>
         <?php
         break;

         case 'Revue' :
         ?>
            <form action="affichageTuple.php" method="post">
               <?php echo "<input type=\"hidden\" name=\"table\" value=".$table." />"; ?>
               <p>
                  Entrer le nom :
                  <input type="text" name="nom" />
               </p>

               <p>
                  Entrer l'impact :
                  <input type="text" name="impact" />
               </p>

               <input type="submit" value="Valider" />
            </form>
         <?php
         break;

         case 'Conference' :
         ?>
            <form action="affichageTuple.php" method="post">
               <?php echo "<input type=\"hidden\" name=\"table\" value=".$table." />"; ?>
               <p>
                  Entrer le nom :
                  <input type="text" name="nom" />
               </p>

               <p>
                  Entrer l'année :
                  <input type="text" name="annee" />
               </p>

               <p>
                  Entrer la rue :
                  <input type="text" name="rue" />
               </p>

               <p>
                  Entrer le numéro :
                  <input type="text" name="numero" />
               </p>

               <p>
                  Entrer la ville :
                  <input type="text" name="ville" />
               </p>

               <p>
                  Entrer la pays :
                  <input type="text" name="pays" />
               </p>

               <input type="submit" value="Valider" />
            </form>
         <?php
         break;

         case 'Participation_Conference' :
         ?>
            <form action="affichageTuple.php" method="post">
               <?php echo "<input type=\"hidden\" name=\"table\" value=".$table." />"; ?>
               <p>
                  Entrer le matricule :
                  <input type="text" name="matricule" />
               </p>

               <p>
                  Entrer le nom de la conférence :
                  <input type="text" name="nom_conference" />
               </p>

               <p>
                  Entrer l'année de la conférence:
                  <input type="text" name="annee_conference" />
               </p>

               <p>
                  Entrer le tarif :
                  <input type="text" name="tarif" />
               </p>

               <input type="submit" value="Valider" />
            </form>
         <?php
         break;

         default:
            echo $_POST['tuple'] . ' n\'est pas une table de la base de donnée.' . '</br>';
            break;
      }
      ?>
   </body>
</html>
<?php } ?>