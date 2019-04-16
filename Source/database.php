<!DOCTYPE html>
<html>
   <head>
      <title>Loading data</title>
   </head>
   <body>
      <center>
         <h1>Loading data</h1>
         <div class=main_container style="width:600px; margin-top:20px;">
            <?php
               $dsn = "mysql:host=ms800.montefiore.ulg.ac.be";
               $user = "group14";
               $password = "";
               $dbname = "group14";

               /*//if data does not exist
               try{
                  echo '<strong><em>Creating database</em></strong><br>';
                  $db = new PDO($dsn, $user, $password,[PDO::MYSQL_ATTR_LOCAL_INFILE => true]);
                  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                  $sql = "create database $dbname character set 'utf8'";
                  $db->exec($sql);
                  echo "Database created succesfully. <br>";
               }
               catch (PDOExecption $e){
                  echo 'Unable to create databse: ' . $e->getMessage();
               }
               $db = NULL;
               */
               
               try{
               //Connecting to database
                  $db = new PDO("mysql:host=ms800.montefiore.ulg.ac.be;dbname=group14", $user, $password); //variable bd connection
                  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  echo 'Connected to the database <br> <br>';

                  //---------------- Insitution table ----------------
                  echo '<strong><em>Creating insitution table</em></strong><br>';
                  try{
                     $db->beginTransaction();

                     //Creating table
                     $db->exec("CREATE TABLE IF NOT EXISTS Institution(
                        nom VARCHAR(50) PRIMARY KEY,
                        rue VARCHAR(50) NOT NULL,
                        numero VARCHAR(5) NOT NULL,
                        ville VARCHAR(50) NOT NULL,
                        pays VARCHAR(50) NOT NULL,
                        )engine = innodb;"
                     );

                     //Loading data
                     $db->exec("LOAD DATA LOCAL INFILE 'tables/Institution.csv'
                        INTO TABLE Institution
                        FIELDS TERMINATED BY ','
                        ENCLOSED BY ','
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

                  //---------------- Revue table ----------------
                  echo '<strong><em> Creating revue table </em></strong><br>';
                  try{
                     $db->beginTransaction();

                     //Creating table
                     $db->exec("CREATE TABLE IF NOT EXISTS Revue(
                        nom VARCHAR(50) PRIMARY KEY,
                        impact INT NOT NULL,
                        )engine=InnoDB;"
                     );

                     //Loading data
                     $db->exec("LOAD DATA LOCAL INFILE 'tables/Revue.csv'
                        INTO TABLE Revue
                        FIELDS TERMINATED BY ','
                        ENCLOSED BY ','
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

                  //---------------- Conference table ----------------
                  echo '<strong><em>Creating conference table </em></strong><br>';
                  try{
                     $db->beginTransaction();

                     //Creating table
                     $db->exec("CREATE TABLE IF NOT EXISTS Conference(
                        nom VARCHAR(50) NOT NULL,
                        annee SMALLINT NOT NULL,
                        rue VARCHAR(50) NOT NULL,
                        numero VARCHAR(5) NOT NULL,
                        ville VARCHAR(50) NOT NULL,
                        pays VARCHAR(50) NOT NULL,
                        PRIMARY KEY (nom, annee),
                        )engine=InnoDB;"
                     );

                     //Loading data
                     $db->exec("LOAD DATA LOCAL INFILE 'tables/Conference.csv'
                        INTO TABLE Conference
                        FIELDS TERMINATED BY ','
                        ENCLOSED BY ','
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

                  //---------------- Author table ----------------
                  echo '<strong><em>Creating author table</em></strong><br>';
                  try{
                     $db->beginTransaction();

                     //Creating table
                     $db->exec("CREATE TABLE IF NOT EXISTS Auteur(
                        matricule INT PRIMARY KEY,
                        nom VARCHAR(50) NOT NULL,
                        prenom VARCHAR(50) NOT NULL,
                        debut_doctorat SMALLINT NOT NULL,
                        nom_institution VARCHAR(50) NOT NULL,
                        FOREIGN KEY nom_institution
                           REFERENCES Institution(nom_institution)
                        )engine=InnoDB;"
                     );

                     //Loading data
                     $db->exec("LOAD DATA LOCAL INFILE 'tables/Auteur.csv'
                        INTO TABLE Auteur
                        FIELDS TERMINATED BY ','
                        ENCLOSED BY ','
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

                  //---------------- Aritcle table ----------------
                  echo '<strong><em>Creating article table</em></strong><br>';
                  try{
                     $db->beginTransaction();

                     //Creating table
                     $db->exec("CREATE TABLE IF NOT EXISTS Article(
                        url VARCHAR(2083) PRIMARY KEY,
                        doi INT NOT NULL,
                        titre VARCHAR(50) NOT NULL,
                        date_publication SMALLINT NOT NULL,
                        matricule_premier_auteur INT NOT NULL,
                        FOREIGN KEY matricule_premier_auteur
                           REFERENCES Auteur(matricule)
                        )engine=InnoDB;;"
                     );

                     //Loading data
                     $db->exec("LOAD DATA LOCAL INFILE 'tables/Article.csv'
                        INTO TABLE Article
                        FIELDS TERMINATED BY ','
                        RevueED BY ','
                        LINES TERMINATED BY '\n'
                        IGNORE 1 LINES(url, doi, titre, date_publication, matricule_premier_auteur);"
                     );

                     echo "Article table created and loaded successfully. <br><br>";
                     $db->commit();
                     //End of transaction
                  }
                  catch(PDOExecption $e){
                     $db->rollback();
                     echo "Unable to create and/or load aritcle table:" . $e->getMessage();
                  }

                  //---------------- Aritcle subject table ----------------
                  echo '<strong><em>Creating article subject table</em></strong><br>';
                  try{
                     $db->beginTransaction();

                     //Creating table
                     $db->exec("CREATE TABLE IF NOT EXISTS Sujet_Article(
                        url VARCHAR(2083) NOT NULL,
                        sujet VARCHAR(50) NOT NULL,
                        PRIMARY KEY (url, sujet),
                        FOREIGN KEY url
                           REFERENCES Article(url)
                        )engine=InnoDB;"
                     );

                     //Loading data
                     $db->exec("LOAD DATA LOCAL INFILE 'tables/Sujet_Article.csv'
                        INTO TABLE Sujet_Article
                        FIELDS TERMINATED BY ','
                        ENCLOSED BY ','
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

                  //---------------- Second author table ----------------
                  echo '<strong><em>Creating second author table</em></strong><br>';
                  try{
                     $db->beginTransaction();

                     //Creating table
                     $db->exec("CREATE TABLE IF NOT EXISTS Second_Auteur(
                        url VARCHAR(2083) NOT NULL,
                        matricule_second_auteur INT NOT NULL,
                        PRIMARY KEY (url, matricule_second_auteur),
                        FOREIGN KEY matricule_second_auteur
                           REFERENCES Auteur(matricule)
                        FOREIGN KEY url
                           REFERENCES Article(url)
                        )engine=InnoDB;"
                     );

                     //Loading data
                     $db->exec("LOAD DATA LOCAL INFILE 'tables/Second_Auteur.csv'
                        INTO TABLE Second_Auteur
                        FIELDS TERMINATED BY ','
                        ENCLOSED BY ','
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

                  //---------------- Paper article table ----------------
                  echo '<strong><em>Creating paper article table</em></strong><br>';
                  try{
                     $db->beginTransaction();

                     //Creating table
                     $db->exec("CREATE TABLE IF NOT EXISTS Article_Journal(
                        url VARCHAR(2083) PRIMARY KEY,
                        pg_debut SMALLINT NOT NULL,
                        pg_fin SMALLINT NOT NULL,
                        nom_revue VARCHAR(50) NOT NULL,
                        n_journal INT NOT NULL,
                        FOREIGN KEY url
                           REFERENCES Article(url)
                        FOREIGN KEY nom_revue
                           REFERENCES Revue(nom)
                        )engine=InnoDB;"
                     );

                     //Loading data
                     $db->exec("LOAD DATA LOCAL INFILE 'tables/Article_Journal.csv'
                        INTO TABLE Article_Journal
                        FIELDS TERMINATED BY ','
                        ENCLOSED BY ','
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

                  //---------------- Conference article table ----------------
                  echo '<strong><em>Creating conference article table</em></strong><br>';
                  try{
                     $db->beginTransaction();

                     //Creating table
                     $db->exec("CREATE TABLE IF NOT EXISTS Article_Conference(
                        url VARCHAR(2083) PRIMARY KEY,
                        presentation VARCHAR(50) NOT NULL,
                        nom_conference VARCHAR(50) NOT NULL,
                        annee_conference SMALLINT NOT NULL,
                        FOREIGN KEY url
                           REFERENCES Article(url)
                        FOREIGN KEY (nom_conference, annee_conference)
                           REFERENCES Conference(nom, annee)
                        )engine=InnoDB;"
                     );

                     //Loading data
                     $db->exec("LOAD DATA LOCAL INFILE 'tables/Article_Conference.csv'
                        INTO TABLE Article_Conference
                        FIELDS TERMINATED BY ','
                        ENCLOSED BY ','
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

                  //---------------- Participant table ----------------
                  echo '<strong><em>Creating participant table</em></strong><br>';
                  try{
                     $db->beginTransaction();

                     //Creating table
                     $db->exec("CREATE TABLE IF NOT EXISTS Participation_Conference(
                        matricule INT NOT NULL,
                        nom_conference VARCHAR(50) NOT NULL,
                        annee_conference SMALLINT NOT NULL,
                        tarif INT NOT NULL,
                        PRIMARY KEY (matricule, nom_conference, annee),
                        FOREIGN KEY matricule
                           REFERENCES Auteur(matricule)
                        FOREIGN KEY (nom_conference, annee_conference)
                           REFERENCES Conference(nom, annee)
                        )engine=InnoDB;"
                     );

                     //Loading data
                     $db->exec("LOAD DATA LOCAL INFILE 'tables/Participation.csv'
                        INTO TABLE Participation
                        FIELDS TERMINATED BY ','
                        ENCLOSED BY ','
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
            $db = NULL;
            echo 'You have been disconnected. <br><br>';
            ?>
         </div>
      </center>
   </body>
</html>