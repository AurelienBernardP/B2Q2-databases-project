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
         <title>Menu principal</title>
      </head>
      <body>
         <h1><center>Bienvenue sur le menu principal</center></h1>
         <br/>
         <a href="logout.php"> Logout page. </a>
         <div class="main_container">
         <div id="mainMenu">
         <form id="section1" method="post" action="" onchange="document.getElementById('section1').submit();">
            <p>
               <strong>Veuillez choisir une option</strong><br/>
               <input type="radio" name="decision" value="a" id="a">
               Affichage de table<br/>

               <input type="radio" name="decision" value="b" id="b">
               Trouver une publication<br/>

               <input type="radio" name="decision" value="c" id="c">
               Ajouter un article<br/>

               <input type="radio" name="decision" value="d" id="d">
               Retrouver les chercheurs<br/>

               <input type="radio" name="decision" value="e" id="e">
               Retrouver les sujets les plus étudiés<br/>
            </p>
         </form>
         <?php
            if(isset($_POST['decision'])){
               switch($_POST['decision']){
                  case "a":
                     header('location:a.php');
                     break;

                  case "b":
                     header('location:trouver_publication.php');
                     break;

                  case "c":
                     header('location:c.php');
                     break;

                  case "d":
                     header('location:d.php');
                     break;

                  case "e":
                     header('location:e.php');
                     break;

                  default:
                     break;
               }
            }
         ?>
         </div>
         </div>
      </body>
   </html>
   <?php
   $db = NULL;
   }
?>
