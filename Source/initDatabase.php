<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
    <title>Initialisation</title>
</head>

<html>
<body>
    <center><h1>Initialisation de la base</h1></center>
    <center><div class=conteneur_principale style="width:600px; margin-top:20px;">
        <div style="margin-top:20px; text-align:left; text-align:left; margin-left:10px;">
<?php
    $dsn = "mysql:host=ms800.montefiore.ulg.ac.be";
    $user = "group";
    $password = "";
    $dbname = "group";

    //A faire si la base n'est pas crée
    /*try{
        echo '<strong><em>Opération n°1 (Création de la base)</em></strong><br>';
        //Connection à la base
        $db = new PDO($dsn, $user, $password,[PDO::MYSQL_ATTR_LOCAL_INFILE => true]);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo '[SYSTEM] Connecter à la base de données<br>';

        //Création de la base de données
        $sql = "create database $dbname character set 'utf8'";
        $db->exec($sql);
        echo "[INFO] Création de la base de données : <strong>Succès</strong> <br>";
    }
    catch (PDOExecption $e){
        echo '[ERREUR] Connexion échouée : ' . $e->getMessage();
    }

    //Déconnexion de la base
    $db = NULL;
    echo '[SYSTEM] Déconnecter de la base de données <br><br>';
    */
    try{
        //Connexion à la base
        $db = new PDO("mysql:host=ms800.montefiore.ulg.ac.be;dbname=group11", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo '[SYSTEM] Connecter à la base de données <br> <br>';

        //---------------- Création de la table Institution et chargemnt des données ----------------
        echo '<strong><em>Opération n°2 (Création de la table Institution)</em></strong><br>';
        try{
            $db->beginTransaction();//Commence la transaction
            $db->exec("CREATE TABLE IF NOT EXISTS Institution (
                nom VARCHAR(50) PRIMARY KEY,
                rue VARCHAR(50) NOT NULL,
                numero VARCHAR(5) NOT NULL,
                ville VARCHAR(50) NOT NULL,
                pays VARCHAR(50) NOT NULL,
                )engine = innodb;");
            echo "[INFO] Création de la table Institution : <strong>Succès</strong> <br>";

            //Chargement des données pour Institution
            $db->exec("LOAD DATA LOCAL INFILE 'tables/Institution.csv'
            INTO TABLE Institution
            FIELDS TERMINATED BY ','
            RevueED BY ','
            LINES TERMINATED BY '\n'
            ignore 1 lines(nom, rue, numero, ville, pays);");
            echo "[INFO] Chargement des données pour la table Institution : <strong>Succès</strong> <br><br>";
            $db->commit();//Termine la transaction

        }
        catch(PDOExecption $e){
            //Rollback si il y a une erreur
            $db->rollback();
            echo "[ERREUR] Impossible de créer la table Institution" . $e->getMessage();
        }

        //---------------- Création de la table Revue et chargement des données ----------------
        echo '<strong><em>Opération n°3 (Création de la table Revue)</em></strong><br>';
        try{
            $db->beginTransaction();//Commence la transaction
            $db->exec("CREATE TABLE IF NOT EXISTS Revue(
                nom VARCHAR(50) PRIMARY KEY,
                impact INT NOT NULL,
                )engine=InnoDB;");
            echo "[INFO] Création de la table Revue : <strong>Succès</strong> <br>";

            //Chargement des données pour Revue
            $db->exec("LOAD DATA LOCAL INFILE 'tables/Revue.csv'
            INTO TABLE Revue
            FIELDS TERMINATED BY ','
            RevueED BY ','
            LINES TERMINATED BY '\n'
            IGNORE 1 LINES(nom, impact);");
            echo "[INFO] Chargement des données pour la table Revue : <strong>Succès</strong> <br><br>";
            $db->commit();//Termine la transaction

        }
        catch(PDOExecption $e){
            //Rollback si il y a une erreur
            $db->rollback();
            echo "[ERREUR] Impossible de créer la table Revue" . $e->getMessage();
        }

        //---------------- Création de la table Conference et chargement des données ----------------
        echo '<strong><em>Opération n°4 (Création de la table Conference)</em></strong><br>';
        try{
            $db->beginTransaction();//Commence la transaction
            $db->exec("CREATE TABLE IF NOT EXISTS Conference(
                nom VARCHAR(50) NOT NULL,
                annee SMALLINT NOT NULL,
                rue VARCHAR(50) NOT NULL,
                numero VARCHAR(5) NOT NULL,
                ville VARCHAR(50) NOT NULL,
                pays VARCHAR(50) NOT NULL,
                PRIMARY KEY (nom, annee),
                )engine=InnoDB;");
            echo "[INFO] Création de la table Conference : <strong>Succès</strong> <br>";

            //Chargement des données pour Conference
            $db->exec("LOAD DATA LOCAL INFILE 'tables/Conference.csv'
            INTO TABLE Conference
            FIELDS TERMINATED BY ','
            RevueED BY ','
            LINES TERMINATED BY '\n'
            IGNORE 1 LINES(nom, annee, rue, numero, ville, pays);");
            echo "[INFO] Chargement des données pour la table Conference : <strong>Succès</strong> <br><br>";
            $db->commit();//Termine la transaction

        }
        catch(PDOExecption $e){
            //Rollback si il y a une erreur
            $db->rollback();
            echo "[ERREUR] Impossible de créer la table Conference" . $e->getMessage();
        }

        //---------------- Création de la table Revue et chargement des données ----------------
        echo '<strong><em>Opération n°5 (Création de la table Revue)</em></strong><br>';
        try{
            $db->beginTransaction();//Commence la transaction
            $db->exec("CREATE TABLE IF NOT EXISTS Revue(
                nom VARCHAR(50) PRIMARY KEY,
                impact INT NOT NULL,
                )engine=InnoDB;");
            echo "[INFO] Création de la table Revue : <strong>Succès</strong> <br>";

            $db->exec("LOAD DATA LOCAL INFILE 'tables/Revue.csv'
            INTO TABLE Revue
            FIELDS TERMINATED BY ','
            RevueED BY ','
            LINES TERMINATED BY '\n'
            IGNORE 1 LINES(nom, impact);");
            echo "[INFO] Chargement des données pour la table Revue : <strong>Succès</strong> <br><br>";
            $db->commit();//Termine la transaction

        }
        catch(PDOExecption $e){
            //Rollback si il y a une erreur
            $db->rollback();
            echo "[ERREUR] Impossible de créer la table Revue" . $e->getMessage();
        }

        //---------------- Création de la table Auteur et chargement des données ----------------
        echo '<strong><em>Opération n°6 (Création de la table Auteur)</em></strong><br>';
        try{
            $db->beginTransaction();//Commence la transaction
            $db->exec("CREATE TABLE IF NOT EXISTS Auteur(
                matricule INT PRIMARY KEY,
                nom VARCHAR(50) NOT NULL,
                prenom VARCHAR(50) NOT NULL,
                debut_doctorat SMALLINT NOT NULL,
                nom_institution VARCHAR(50) NOT NULL,
                FOREIGN KEY nom_institution
                    REFERENCES Institution(nom_institution)
                )engine=InnoDB;");
            echo "[INFO] Création de la table Auteur : <strong>Succès</strong> <br>";

            $db->exec("LOAD DATA LOCAL INFILE 'tables/Auteur.csv'
            INTO TABLE Auteur
            FIELDS TERMINATED BY ','
            RevueED BY ','
            LINES TERMINATED BY '\n'
            IGNORE 1 LINES(matricule, nom, prenom, debut_doctorat, nom_institution);");
            echo "[INFO] Chargement des données pour la table Auteur : <strong>Succès</strong> <br><br>";
            $db->commit();//Termine la transaction

        }
        catch(PDOExecption $e){
            //Rollback si il y a une erreur
            $db->rollback();
            echo "[ERREUR] Impossible de créer la table Auteur" . $e->getMessage();
        }

        //---------------- Création de la table Materiel et chargement des données ----------------
        echo '<strong><em>Opération n°7 (Création de la table Materiel)</em></strong><br>';
        try{
            $db->beginTransaction();//Commence la transaction
            $db->exec("CREATE TABLE IF NOT EXISTS Materiel (
                n_materiel INT(30) NOT NULL AUTO_INCREMENT,
                etat VARCHAR(50) NOT NULL,
                local VARCHAR(50) NOT NULL,
                PRIMARY KEY (n_materiel)
            )engine = innodb;");
            echo "[INFO] Création de la table Materiel : <strong>Succès</strong> <br>";

            $db->exec("LOAD DATA LOCAL INFILE 'tables/Materiel.csv'
            INTO TABLE Materiel
            FIELDS TERMINATED BY ','
            RevueED BY ','
            LINES TERMINATED BY '\n'
            IGNORE 1 LINES(n_materiel, etat, local);");
            echo "[INFO] Chargement des données pour la table Materiel : <strong>Succès</strong> <br><br>";
            $db->commit();//Termine la transaction

        }
        catch(PDOExecption $e){
            //Rollback si il y a une erreur
            $db->rollback();
            echo "[ERREUR] Impossible de créer la table Materiel" . $e->getMessage();
        }

        //---------------- Création de la table Article et chargement des données ----------------
        echo '<strong><em>Opération n°8 (Création de la table Article)</em></strong><br>';
        try{
            $db->beginTransaction();//Commence la transaction
            $db->exec("CREATE TABLE IF NOT EXISTS Article(
                url VARCHAR(2083) PRIMARY KEY,
                doi INT NOT NULL,
                titre VARCHAR(50) NOT NULL,
                date_publication SMALLINT NOT NULL,
                matricule_premier_auteur INT NOT NULL,
                FOREIGN KEY matricule_premier_auteur
                   REFERENCES Auteur(matricule)
                )engine=InnoDB;;");
            echo "[INFO] Création de la table Article : <strong>Succès</strong> <br>";

            $db->exec("LOAD DATA LOCAL INFILE 'tables/Article.csv'
            INTO TABLE Article
            FIELDS TERMINATED BY ','
            RevueED BY ','
            LINES TERMINATED BY '\n'
            IGNORE 1 LINES(url, doi, titre, date_publication, matricule_premier_auteur);");
            echo "[INFO] Chargement des données pour la table Article : <strong>Succès</strong> <br><br>";
            $db->commit();//Termine la transaction

        }
        catch(PDOExecption $e){
            //Rollback si il y a une erreur
            $db->rollback();
            echo "[ERREUR] Impossible de créer la table Article" . $e->getMessage();
        }

        //---------------- Création de la table Sujet_Article et chargement des données ----------------
        echo '<strong><em>Opération n°9 (Création de la table Sujet_Article)</em></strong><br>';
        try{
            $db->beginTransaction();//Commence la transaction
            $db->exec("CREATE TABLE IF NOT EXISTS Sujet_Article(
                url VARCHAR(2083) NOT NULL,
                sujet VARCHAR(50) NOT NULL,
                PRIMARY KEY (url, sujet),
                FOREIGN KEY url
                   REFERENCES Article(url)
                )engine=InnoDB;");
            echo "[INFO] Création de la table Sujet_Article : <strong>Succès</strong> <br>";

            $db->exec("LOAD DATA LOCAL INFILE 'tables/Sujet_Article.csv'
            INTO TABLE Sujet_Article
            FIELDS TERMINATED BY ','
            RevueED BY ','
            LINES TERMINATED BY '\n'
            IGNORE 1 LINES(url, sujet);");
            echo "[INFO] Chargement des données pour la table Sujet_Article : <strong>Succès</strong> <br><br>";
            $db->commit();//Termine la transaction

        }
        catch(PDOExecption $e){
            //Rollback si il y a une erreur
            $db->rollback();
            echo "[ERREUR] Impossible de créer la table Sujet_Article" . $e->getMessage();
        }

        //---------------- Création de la table Second_Auteur et chargement des données ----------------
        echo '<strong><em>Opération n°10 (Création de la table Second_Auteur)</em></strong><br>';
        try{
            $db->beginTransaction();//Commence la transaction
            $db->exec("CREATE TABLE IF NOT EXISTS Second_Auteur(
                url VARCHAR(2083) NOT NULL,
                matricule_second_auteur INT NOT NULL,
                PRIMARY KEY (url, matricule_second_auteur),
                FOREIGN KEY matricule_second_auteur
                   REFERENCES Auteur(matricule)
                FOREIGN KEY url
                   REFERENCES Article(url)
                )engine=InnoDB;");
            echo "[INFO] Création de la table Second_Auteur : <strong>Succès</strong> <br>";

            $db->exec("LOAD DATA LOCAL INFILE 'tables/Second_Auteur.csv'
            INTO TABLE Second_Auteur
            FIELDS TERMINATED BY ','
            RevueED BY ','
            LINES TERMINATED BY '\n'
            IGNORE 1 LINES(url, matricule_second_auteur);");
            echo "[INFO] Chargement des données pour la table Second_Auteur : <strong>Succès</strong> <br><br>";
            $db->commit();//Termine la transaction

        }
        catch(PDOExecption $e){
            //Rollback si il y a une erreur
            $db->rollback();
            echo "[ERREUR] Impossible de créer la table Second_Auteur" . $e->getMessage();
        }

        //---------------- Création de la table Article_Journal et chargement des données ----------------
        echo '<strong><em>Opération n°11 (Création de la table Article_Journal)</em></strong><br>';
        try{
            $db->beginTransaction();//Commence la transaction
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
                )engine=InnoDB;");
            echo "[INFO] Création de la table Article_Journal : <strong>Succès</strong> <br>";

            $db->exec("LOAD DATA LOCAL INFILE 'tables/Article_Journal.csv'
            INTO TABLE Article_Journal
            FIELDS TERMINATED BY ','
            RevueED BY ','
            LINES TERMINATED BY '\n'
            IGNORE 1 LINES(url, pg_debut, pg_fin, nom_revue, n_journal);");
            echo "[INFO] Chargement des données pour la table Article_Journal : <strong>Succès</strong> <br><br>";
            $db->commit();//Termine la transaction

        }
        catch(PDOExecption $e){
            //Rollback si il y a une erreur
            $db->rollback();
            echo "[ERREUR] Impossible de créer la table Article_Journal" . $e->getMessage();
        }

        //---------------- Création de la table Article_Conference et chargement des données ----------------
        echo '<strong><em>Opération n°12 (Création de la table Article_Conference</em></strong><br>';
        try{
            $db->beginTransaction();//Commence la transaction
            $db->exec("CREATE TABLE IF NOT EXISTS Article_Conference(
                url VARCHAR(2083) PRIMARY KEY,
                presentation VARCHAR(50) NOT NULL,
                nom_conference VARCHAR(50) NOT NULL,
                annee_conference SMALLINT NOT NULL,
                FOREIGN KEY url
                   REFERENCES Article(url)
                FOREIGN KEY (nom_conference, annee_conference)
                   REFERENCES Conference(nom, annee)
                )engine=InnoDB;");
            echo "[INFO] Création de la table Article_Conference : <strong>Succès</strong> <br>";

            $db->exec("LOAD DATA LOCAL INFILE 'tables/Article_Conference.csv'
            INTO TABLE Article_Conference
            FIELDS TERMINATED BY ','
            RevueED BY ','
            LINES TERMINATED BY '\n'
            IGNORE 1 LINES(url, presentation, nom_conference, annee_conference);");
            echo "[INFO] Chargement des données pour la table Article_Conference : <strong>Succès</strong> <br><br>";
            $db->commit();//Termine la transaction

        }
        catch(PDOExecption $e){
            //Rollback si il y a une erreur
            $db->rollback();
            echo "[ERREUR] Impossible de créer la table Article_Conference" . $e->getMessage();
        }

        //---------------- Création de la table Participation et chargement des données ----------------
        echo '<strong><em>Opération n°13 (Création de la table Participation</em></strong><br>';
        try{
            $db->beginTransaction();//Commence la transaction
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
                )engine=InnoDB;");
            echo "[INFO] Création de la table Participation : <strong>Succès</strong> <br>";

            $db->exec("LOAD DATA LOCAL INFILE 'tables/Participation.csv'
            INTO TABLE Participation
            FIELDS TERMINATED BY ','
            RevueED BY ','
            LINES TERMINATED BY '\n'
            IGNORE 1 LINES(matricule, nom_conference, annee_conference, tarif);");
            echo "[INFO] Chargement des données pour la table Participation : <strong>Succès</strong> <br><br>";
            $db->commit();//Termine la transaction

        }
        catch(PDOExecption $e){
            //Rollback si il y a une erreur
            $db->rollback();
            echo "[ERREUR] Impossible de créer la table Participation" . $e->getMessage();
        }
    }
    catch(PDOExecption $e){
        echo '[ERREUR] Connexion échoué : ' . $e->getMessage();
    }

    //Déconnexion de la base
    $db = NULL;
    echo '[SYSTEM] Déconnecter de la base de données <br><br>';
?>
</div></div></center>
</body>
</html>
