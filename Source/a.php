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
   <title>a</title>
</head>
   <body>
      <h1><center>Requête A</center></h1>
      <br/>

      <br/>
      <h3><a href="main_menu.php"><center>revenir vers le menu</center></a></h3>
      <br/>


      <p>
      Veuillez sélectionner le tuple recherché :
      </p>
  
      <form method="post" action="optionTuple.php">
         <p>

            <select name="table">
               <option value="Article">Article</option>
               <option value="Auteur">Auteur</option>
               <option value="Second_Auteur">Second auteur</option>
               <option value="Institution">Institution</option>
               <option value="Revue">Revue</option>
               <option value="Conference">Conférence</option>
               <option value="Sujet_Article">Sujet de l'article</option>
               <option value="Article_Conference">Article de conférence</option>
               <option value="Article_Journal">Article de journal</option>
               <option value="Participation_Conference">Participation à une conférence</option>
            </select>

            <input type="submit" value="Ok" title="valider pour aller au tuple sélectionné" />
         </p>
      </form>

   </body>
</html>
<?php } ?>