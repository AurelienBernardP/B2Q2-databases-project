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
    <header>
      <meta charset="utf-8" />
      <title> Trouver top sujets </title>
         <link rel="stylesheet" type="text/css" href="style.css">
   </header>

        <body>
            <div id="title top subjects">
                <h1><center>liste des sujets les plus populaires au cours des 5 conférences les plus populaires depuis 2012</center></h1>
                <br/>
                <h3><a href="main_menu.php"><center>revenir vers le menu</center></a></h3>
                <br/>
            </div>
            <div id="table of subjects">
            <?php
            $queryE = $db->query('SELECT sujet, COUNT(sujet) as popu
                                FROM Sujet_Article NATURAL JOIN 
                                    (SELECT * FROM Article_Conference) AS link NATURAL JOIN
                                        (SELECT nom_conference , annee_conference
                                        FROM Participation_Conference
                                        WHERE annee_conference >= 2012
                                        GROUP BY annee_conference , nom_conference
                                        ORDER BY COUNT(*) DESC
                                        LIMIT 5) AS top_conf_by_assistance
                                GROUP BY sujet 
                                ORDER BY COUNT(sujet) DESC');                                
            
                  echo "<table align='center' border='1px' style='width:600px; line-height:40px;'>";
                  echo "<tr> <th colspan='4'><h2> Sujets les plus étudiés</h2></th> </tr>";
                  echo "<t><th>Rang</th> <th>Sujet</th> <th>Nombre de fois étudié</th> </t>";
            while($tupleE = $queryE->fetch()){
                echo "<tr><td> ".$tupleE['popu']."</td>";
                     echo "<td>". htmlentities($tupleE['sujet'])." </td>";
                     echo "<td> numero </td></tr>";
            }
            echo "</table>";
            ?>
            </div>
          <center><button name="back_to_main" type="submit" onclick="location.href = 'main_menu.php';" value="back_to_main">Go back to main menu</button></center>
        </body>
</html>
<?php 
    $bd = NULL; 
}
?>
