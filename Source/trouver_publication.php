<?php
   include 'infoConnect.php';
   if(isset($_SESSION['connect']) AND $_SESSION['connect'] == 0){
      echo'<strong>Erreur</strong>: Impossible de voir cette page sans vous être connecter<br>';
      echo'Voici la page de connexion ---> <a href="connexion.php">Connexion</a>';
      session_destroy();
   }
   else{
      $query = $db->prepare("SELECT titre, date_publication, Journal as Type 
      FROM (Article  NATURAL JOIN Article_Journal) NATURAL JOIN (SELECT nom, prenom FROM)
      WHERE n_registre IN (SELECT n_registre
                        FROM (SELECT n_registre, COUNT(n_enclos) as nb_enclos
                              FROM Entretien
                              GROUP BY n_registre) AS one
                        WHERE one.nb_enclos = (SELECT MAX(n_enclos)
                                               FROM Enclos))");

      $query->execute();
?>   
      <html>
         <header>
            <title> Trouver publication(s) </title> 
         </header>
         <body>
            <center>
               <a href="min_menu.php"> <b>Back to main menu </b> </a>
               <br>
               <h1> Trouver publication(s) </h1>
               <form method="post" action="trouver_publication.php">
                  <input type="text" name="matricule"/>
                  <input type="Submit"/>
               </form>
               <?php
                  if(ISSET($_POST['matricule'])){
                     $matricule = $_POST['matricule'];
                     $query = $db->prepare("SELECT titre, date_publication, Journal as Type 
                        FROM (((Article WHERE matricule_premier_auteur = $matricule) 
                              NATURAL JOIN Article_Journal) 
                                 NATURAL JOIN (SELECT matricule_second_auteur FROM Second_Auteur))
                                    GROUP BY date_publication");
                  
                  
                     echo "<table style='border: solid 1px black;'>";
                     echo "<tr><th>Titre</th> <th>Date Publication</th> <th>Type</th> <th>Second Auteurs</th>";
                     echo "</tr>";
                     $result = $query->setFetchMode(PDO::FETCH_ASSOC);
                     foreach(new TableRows(new RecursiveArrayIterator($query->fetchAll())) as $k=>$v){
                        echo $v;
                     }
                     $db = null;
                     echo "</table>";
                  }
               ?>
            </center>
         </body>
      </html>
   }
