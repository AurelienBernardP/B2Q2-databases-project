<?php
   include 'connexion_info.php';
   if(isset($_SESSION['connect']) AND $_SESSION['connect'] == 0){
      echo'<strong>Erreur</strong>: Impossible de voir cette page sans vous être connecter<br>';
      echo'Voici la page de connexion ---> <a href="connexion.php">Connexion</a>';
      session_destroy();

}
else{
?>
<html>
        <head>
                <meta charset="utf-8" />
                   <title>Top sujets</title>
        </head>
        <body>
            <div id="title top subjects">
                <h1><center>liste des sujets les plus populaires au cours des 5 conférences les plus populaires depuis 2012</center></h1>
                <br/>
                <h3><a href="main_menu.php"><center>revenir vers le menu</center></a></h3>
                <br/>
            </div>
            <div id="table of subjects">
            <?php
            $queryE = $bd->query("SELECT sujet
                                    FROM Sujet_Article NATURAL JOIN (SELECT url FROM Article_Conference) NATURAL JOIN
                                            (SELECT nom_conference , annee_conference
                                            FROM (SELECT nom_conference, annee_conferece 
                                                FROM Participation_Conference
                                                    WHERE annee_conference >= 2012)
                                            GROUP BY annee_conference , nom_conference
                                            ORDER BY COUNT(*) DESC
                                            LIMIT 5)
                                    GROUP BY sujet 
                                    ORDER BY COUNT(sujet) DESC;"
                                );
            echo "<h3><center>","Sujets en ordre d'écroissant de popularité","</center><h3>";
            while($tupleE = $queryE->fetch()){
                echo "<p>".$tupleE['sujet']."</p>";
            }
        
            ?>
            </div>
        </body>
</html>
<?php 
    $bd = NULL; 
}
?>