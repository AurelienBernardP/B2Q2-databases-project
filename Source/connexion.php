<?php
   session_start();
   if(isset($_SESSION['connect']) AND $_SESSION['connect'] == 1){
      header('location:menu_principal.php');
   }
   else{
?>
   <!DOCTYPE html>
   <html>
   <head>
      <meta charset="utf-8" />
      <title>Connexion</title>
   </head>
      <body>
         <h1><center>Connexion à la base de données</center></h1>
         <br/>
         <br/>
         <div class="case_connexion">
         <div style="margin-top: 10px;"><center><strong>Connexion à la base de données</strong></center></div>
         <div id="formulaire_connexion">
            <form method="post" action="">
               <p>
                  <label for="login">Login:</label><input type="text" name="login" /><br />
                  <label for="password">Mot de passe:</label><input type="password" name="password" />
                  <div style="margin-top: 10px"><center><input type="submit" value="Connexion" /></center></div>
               </p>
            </form>
         </div>
         <br/>
         <?php
         //Checking login and password
            if(isset($_POST['login']) AND isset($_POST['password'])){
               try{
                  $log = $_POST['login'];
                  $pass= $_POST['password'];
                  $db = new PDO("mysql:host=127.0.0.1; dbname=group14", $log, $pass);
                  $_SESSION['login'] = $log;
                  $_SESSION['pass'] = $pass;
                  $_SESSION['connect'] = 1;
                  $db = NULL;
                  header('location:menu_principal.php');
                  }
               catch (PDOExecption $e){
                  throw string("Server connexion failed");
                  $_SESSION['connect'] = 0;
               }
            }
         ?>
         </div>
         <br/>
      </body>
   </html>
   <?php
      }
   ?>
