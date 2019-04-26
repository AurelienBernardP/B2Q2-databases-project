<html>
   <head>
      <title>Loading data</title>
   </head>
   <body>
      <center>
         <a href="logout.php"> Logout page. </a>
         <h1>Loading data</h1>
         <div class=main_container style="width:600px; margin-top:20px;">
            <?php
               $dsn = "mysql:host=ms800.montefiore.ulg.ac.be";
               $user = "group14";
               $password = "qsEtZcVPct";
               $dbname = "group14";


               try{

                  //Connecting to database
                  $db = new PDO("mysql:host=ms800.montefiore.ulg.ac.be;dbname=group14", $user, $password); //variable bd connection
                  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  echo 'Connected to the database <br> <br>';


               /*------------------- Creating tables and loading data -------------------*/


                  /*---------------- Insitution table ----------------*/
                  echo '<strong><em>Creating insitution table</em></strong><br>';
                  try{
                     $db->beginTransaction();

                     //Creating table
                     $db->exec("CREATE TABLE IF NOT EXISTS Institution(
                        nom VARCHAR(50) NOT NULL,
                        rue VARCHAR(50) NOT NULL,
                        numero VARCHAR(5) NOT NULL,
                        ville VARCHAR(50) NOT NULL,
                        pays VARCHAR(50) NOT NULL,
                        PRIMARY KEY (nom)
                        )engine = innodb;"
                     );

                     //Loading data
                     $db->exec("LOAD DATA LOCAL INFILE 'tables/institutions.csv'
                        INTO TABLE Institution
                        FIELDS TERMINATED BY ';'
                        ENCLOSED BY ';'
                        LINES TERMINATED BY '\n'
                        ignore 1 lines(nom, rue, numero, ville, pays);"
                     );

                     echo "Institution table created and loaded successfully. <br><br>";
                     $db->commit();
                     //End of transaction

                  }
                  catch(PDOExecption $e){
                     $db->rollback();
                     echo "Unable to create and/or load institution table: " . $e->getMessage();
                  }

                  /*---------------- Revue table ----------------*/
                  echo '<strong><em> Creating revue table </em></strong><br>';
                  try{
                     $db->beginTransaction();

                     //Creating table
                     $db->exec("CREATE TABLE IF NOT EXISTS Revue(
                        nom VARCHAR(50) NOT NULL,
                        impact INT NOT NULL,
                        PRIMARY KEY (nom)
                        )engine=innodb;"
                     );

                     //Loading data
                     $db->exec("LOAD DATA LOCAL INFILE 'tables/revues.csv'
                        INTO TABLE Revue
                        FIELDS TERMINATED BY ';'
                        ENCLOSED BY ';'
                        LINES TERMINATED BY '\n'
                        IGNORE 1 LINES(nom, impact);"
                     );

                     echo "Revue table created and loaded successfully. <br><br>";
                     $db->commit();
                     //End of transaction

                  }
                  catch(PDOExecption $e){
                     $db->rollback();
                     echo "Unable to create and/or load revue table:" . $e->getMessage();
                  }

                  /*---------------- Conference table ----------------*/
                  echo '<strong><em>Creating conference table </em></strong><br>';
                  try{
                     $db->beginTransaction();

                     //Creating table
                     $db->exec("CREATE TABLE IF NOT EXISTS Conference(
                        nom VARCHAR(200) NOT NULL,
                        annee SMALLINT NOT NULL,
                        rue VARCHAR(50) NOT NULL,
                        numero VARCHAR(5) NOT NULL,
                        ville VARCHAR(50) NOT NULL,
                        pays VARCHAR(50) NOT NULL,
                        PRIMARY KEY (nom, annee)
                        )engine=innodb;"
                     );

                     //Loading data
                     $db->exec("LOAD DATA LOCAL INFILE 'tables/conferences.csv'
                        INTO TABLE Conference
                        FIELDS TERMINATED BY ';'
                        ENCLOSED BY ';'
                        LINES TERMINATED BY '\n'
                        IGNORE 1 LINES(nom, annee, rue, numero, ville, pays);"
                     );

                     echo "Conference table created and loaded successfully. <br><br>";
                     $db->commit();
                     //End of transaction

                  }
                  catch(PDOExecption $e){
                     $db->rollback();
                     echo "Unable to create and/or load conference table:" . $e->getMessage();
                  }

                  /*---------------- Author table ----------------*/
                  echo '<strong><em>Creating author table</em></strong><br>';
                  try{
                     $db->beginTransaction();

                     //Creating table
                     $db->exec("CREATE TABLE IF NOT EXISTS Auteur(
                        matricule INT NOT NULL,
                        nom VARCHAR(50) NOT NULL,
                        prenom VARCHAR(50) NOT NULL,
                        debut_doctorat INT NOT NULL,
                        nom_institution VARCHAR(50) NOT NULL,
                        PRIMARY KEY (matricule),
                        FOREIGN KEY (nom_institution)
                           REFERENCES Institution(nom)
                        )engine=innodb;"
                     );

                     //Loading data
                     $db->exec("LOAD DATA LOCAL INFILE 'tables/auteurs.csv'
                        INTO TABLE Auteur
                        FIELDS TERMINATED BY ';'
                        ENCLOSED BY ';'
                        LINES TERMINATED BY '\n'
                        IGNORE 1 LINES(matricule, nom, prenom, debut_doctorat, nom_institution);"
                     );

                     echo "Author table created and loaded successfully. <br><br>";
                     $db->commit();
                     //End of transaction
                  }
                  catch(PDOExecption $e){
                     $db->rollback();
                     echo "Unable to create and/or load author table:" . $e->getMessage();
                  }

                  /*---------------- Aritcle table ----------------*/
                  echo '<strong><em>Creating article table</em></strong><br>';
                  try{
                     $db->beginTransaction();

                     //Creating table
                     $db->exec("CREATE TABLE IF NOT EXISTS Article(
                        url VARCHAR(500) NOT NULL,
                        doi BIGINT NOT NULL,
                        titre VARCHAR(500) NOT NULL,
                        date_publication DATE NOT NULL,
                        matricule_premier_auteur INT NOT NULL,
                        PRIMARY KEY (url),
                        FOREIGN KEY (matricule_premier_auteur)
                           REFERENCES Auteur(matricule)
                        )engine=innodb;"
                     );

                     echo "Here";
                     //Loading data
                     $db->exec("LOAD DATA LOCAL INFILE 'tables/articles.csv'
                        INTO TABLE Article
                        FIELDS TERMINATED BY ';'
                        ENCLOSED BY ';'
                        LINES TERMINATED BY '\n'
                        IGNORE 1 LINES(url, doi, titre, date_publication, matricule_premier_auteur);"
                     );

                     echo "Article table created and loaded successfully. <br><br>";
                     $db->commit();
                     //End of transaction
                  }
                  catch(PDOExecption $e){
                     $db->rollback();
                     echo "Unable to create and/or load article table:" . $e->getMessage();
                  }

                  /*---------------- Aritcle subject table ----------------*/
                  echo '<strong><em>Creating article subject table</em></strong><br>';
                  try{
                     $db->beginTransaction();

                     //Creating table
                     $db->exec("CREATE TABLE IF NOT EXISTS Sujet_Article(
                        url VARCHAR(500) NOT NULL,
                        sujet VARCHAR(50) NOT NULL,
                        PRIMARY KEY (url, sujet),
                        FOREIGN KEY (url)
                           REFERENCES Article(url)
                        )engine=innodb;"
                     );

                     //Loading data
                     $db->exec("LOAD DATA LOCAL INFILE 'tables/sujets_articles.csv'
                        INTO TABLE Sujet_Article
                        FIELDS TERMINATED BY ';'
                        ENCLOSED BY ';'
                        LINES TERMINATED BY '\n'
                        IGNORE 1 LINES(url, sujet);"
                     );

                     echo "Article subject table created and loaded successfully.<br><br>";
                     $db->commit();
                     //End of transaction
                  }
                  catch(PDOExecption $e){
                     $db->rollback();
                     echo "Unable to create and/or load article subject table:" . $e->getMessage();
                  }

                  /*---------------- Second author table ----------------*/
                  echo '<strong><em>Creating second author table</em></strong><br>';
                  try{
                     $db->beginTransaction();

                     //Creating table
                     $db->exec("CREATE TABLE IF NOT EXISTS Second_Auteur(
                        url VARCHAR(500) NOT NULL,
                        matricule_second_auteur INT NOT NULL,
                        PRIMARY KEY (url, matricule_second_auteur),
                        FOREIGN KEY (matricule_second_auteur)
                           REFERENCES Auteur(matricule),
                        FOREIGN KEY (url)
                           REFERENCES Article(url)
                        )engine=innodb;"
                     );

                     //Loading data
                     $db->exec("LOAD DATA LOCAL INFILE 'tables/seconds_auteurs.csv'
                        INTO TABLE Second_Auteur
                        FIELDS TERMINATED BY ';'
                        ENCLOSED BY ';'
                        LINES TERMINATED BY '\n'
                        IGNORE 1 LINES(url, matricule_second_auteur);"
                     );

                     echo "Second author table created and loaded successfully.<br><br>";
                     $db->commit();
                     //End of transaction
                  }
                  catch(PDOExecption $e){
                     $db->rollback();
                     echo "Unable to create and/or load second author table:" . $e->getMessage();
                  }

                  /*---------------- Paper article table ----------------*/
                  echo '<strong><em>Creating paper article table</em></strong><br>';
                  try{
                     $db->beginTransaction();

                     //Creating table
                     $db->exec("CREATE TABLE IF NOT EXISTS Article_Journal(
                        url VARCHAR(500) NOT NULL,
                        pg_debut SMALLINT NOT NULL,
                        pg_fin SMALLINT NOT NULL,
                        nom_revue VARCHAR(50) NOT NULL,
                        n_journal INT NOT NULL,
                        PRIMARY KEY (url),
                        FOREIGN KEY (url)
                           REFERENCES Article(url),
                        FOREIGN KEY (nom_revue)
                           REFERENCES Revue(nom)
                        )engine=innodb;"
                     );

                     //Loading data
                     $db->exec("LOAD DATA LOCAL INFILE 'tables/articles_journaux.csv'
                        INTO TABLE Article_Journal
                        FIELDS TERMINATED BY ';'
                        ENCLOSED BY ';'
                        LINES TERMINATED BY '\n'
                        IGNORE 1 LINES(url, pg_debut, pg_fin, nom_revue, n_journal);"
                     );

                     echo "Paper article table created and loaded successfully. <br><br>";
                     $db->commit();
                     //End of transaction
                  }
                  catch(PDOExecption $e){
                     $db->rollback();
                     echo "Unable to create and/or load paper article table:" . $e->getMessage();
                  }

                  /*---------------- Conference article table ----------------*/
                  echo '<strong><em>Creating conference article table</em></strong><br>';
                  try{
                     $db->beginTransaction();

                     //Creating table
                     $db->exec("CREATE TABLE IF NOT EXISTS Article_Conference(
                        url VARCHAR(500) NOT NULL,
                        presentation VARCHAR(200) NOT NULL,
                        nom_conference VARCHAR(200) NOT NULL,
                        annee_conference SMALLINT NOT NULL,
                        PRIMARY KEY (url),
                        FOREIGN KEY (url)
                           REFERENCES Article(url),
                        FOREIGN KEY (nom_conference, annee_conference)
                           REFERENCES Conference(nom, annee)
                        )engine=innodb;"
                     );

                     //Loading data
                     $db->exec("LOAD DATA LOCAL INFILE 'tables/articles_conferences.csv'
                        INTO TABLE Article_Conference
                        FIELDS TERMINATED BY ';'
                        LINES TERMINATED BY '\n'
                        IGNORE 1 LINES(url, presentation, nom_conference, annee_conference);"
                     );

                     echo "Conference article table created and loaded successfully.<br><br>";
                     $db->commit();
                     //End of transaction
                  }
                  catch(PDOExecption $e){
                     $db->rollback();
                     echo "Unable to create and/or load conference article table:" . $e->getMessage();
                  }

                  /*---------------- Participant table ----------------*/
                  echo '<strong><em>Creating participant table</em></strong><br>';
                  try{
                     $db->beginTransaction();

                     //Creating table
                     $db->exec("CREATE TABLE IF NOT EXISTS Participation_Conference(
                        matricule INT NOT NULL,
                        nom_conference VARCHAR(50) NOT NULL,
                        annee_conference SMALLINT NOT NULL,
                        tarif VARCHAR(50) NOT NULL,
                        PRIMARY KEY (matricule, nom_conference, annee_conference),
                        FOREIGN KEY (matricule)
                           REFERENCES Auteur(matricule),
                        FOREIGN KEY (nom_conference, annee_conference)
                           REFERENCES Conference(nom, annee)
                        )engine=innodb;"
                     );

                     //Loading data
                     $db->exec("LOAD DATA LOCAL INFILE 'tables/participations_conferences.csv'
                        INTO TABLE Participation_Conference
                        FIELDS TERMINATED BY ';'
                        LINES TERMINATED BY '\n'
                        IGNORE 1 LINES(matricule, nom_conference, annee_conference, tarif);"
                     );

                     echo "Participant table created and loaded successfully.<br><br>";
                     $db->commit();
                     //End of transaction
                  }
                  catch(PDOExecption $e){
                     $db->rollback();
                     echo "Unable to create and/or load transaction table:" . $e->getMessage();
                  }
               }
               catch(PDOExecption $e){
                  echo 'Connexion failed: ' . $e->getMessage();
               }

            //Disconnecting from server
           // $db = NULL;
            header('location:main_menu.php');
            //echo 'You have been disconnected. <br><br>';
            ?>
         </div>
      </center>
   </body>
</html>
