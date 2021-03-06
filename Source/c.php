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
                   <title>Ajouter un article</title>
        </head>
        <body>
            <div id= article_type_choice>
                <h1><center>Ajouter un article</center></h1>
                <br/>
                <h3><a href="main_menu.php"><center>revenir vers le menu</center></a></h3>
                <br/>
                <form id="choice_form" method="post" onchange="document.getElementById('choice_form').submit();">
                    <p>
                        <strong>Veillez choisir le type d'article que vous voulez insérer</strong>
                        <br/>
                        <input type="radio" name="type_article" value="conference" id="decision_conff">
                        Article de conférence.
                        
                        <input type="radio" name="type_article" value="journal" id="decision_journ">
                        Article de journal.
                        <br/>
                    </p>
                </form>

                <?php
                    if(isset($_POST['type_article'])){
                        ?>
                        <form id= "conference_input_form" method="post" action="submit_new_article.php"> 
                        <p>            
                        <label for="URL">URL  </label><input type="url" name="URL"  maxlength="500" required/>            
                        <br/>
                        <input type="hidden" name="type_article" value="<?php echo $_POST['type_article']; ?>">
                        <br/>
                        <label for="DOI">DOI  </label><input type="number" name="DOI" required/>
                        <br/>
                        <br/>
                        <label for="publication_date">Date de publication  </label><input type="date" name="date_publi" max=<?php echo date('Y-m-d');?> required/>
                        <br/>
                        <br/>
                        
                        <?php
                        //generate items of a drop down list with data from database
                        $req = $db->query("SELECT matricule
                                            FROM Auteur
                                            ORDER BY matricule"
                                        );
                        ?>
                        <p>Matricule du premier auteur </p>
                        <select name="new article matricule" required>
                        <?php
                        while($tuple = $req->fetch()){
                            ?><option value=" <?php echo $tuple['matricule'];?>"><?php echo $tuple['matricule']; ?></option>

                        <?php }?>
                        </select>
                        <br/>
                        <br/>  
                        <label for="titre">Titre de l'article  <input type="text" name="titre article" required maxlength="50" />
                        <br/>
                        <br/>                                    
                        <?php   
                        switch($_POST['type_article']){
                            case "conference":
                                $_POST['type_article'] = "conference";
                                ?>
                                    <p>Nom de la conférence </p> 
                                    <select name="nom_conference" required>
                                    <?php
                                    //generate items of a drop down list with data from database
                                    $req = $db->query("SELECT nom
                                                        FROM Conference;"
                                                    );
                                    while($tuple = $req->fetch()){
                                        echo "<option value='" . $tuple['nom'] . "'>" . $tuple['nom'] . "</option>";
                                    } 
                                    ?>
                                    </select>
                                    <br/>
                                    <br/>
                                    <label for="type presentation">Type de présantation  <input name="type presentation" type="text" required>
                                    <br/>
                                    <br/>
                                    <button name="submit_article" type="submit" value="submit_conf">Mettre à jour la BD</button>
                                <?php
                                break;
                            case "journal":
                                    $_POST['type_article'] = "journal"; 
                                ?>  
                                    <p>nom de la revue</p>
                                    <select name="nom_revue" required>
                                    <?php
                                    //generate items of a drop down list with data from database
                                    $req = $db->query("SELECT nom
                                                        FROM Revue;"
                                                    );
                                    while($tuple = $req->fetch()){
                                        echo "<option value='" . $tuple['nom'] . "'>" . $tuple['nom'] . "</option>";
                                    } 
                                    ?>
                                    </select>
                                    <br/>
                                    <br/>
                                    <p>Numero du journal la publiant</p>
                                    <select name="nb_journal" required>
                                    <?php
                                    //generate items of a drop down list with data from database
                                    $req = $db->query("SELECT n_journal
                                                        FROM Article_Journal
                                                        GROUP BY n_journal
                                                        ORDER BY n_journal;"
                                                    );
                                    while($tuple = $req->fetch()){
                                        echo "<option value='" . $tuple['n_journal'] . "'>" . $tuple['n_journal'] . "</option>";
                                    } 
                                    ?>
                                    </select>
                                    <br/>
                                    <br/>
                                    <label for="page_debut">Page ou l'article commence  <input type="number" min = "1"required name="pg_debut" />
                                    <br/>
                                    <br/>
                                    <label for="page_fin">Page ou l'article termine  <input type="number" min = "1"required name="pg_fin" />
                                    <br/>
                                    <br/>  
                                    <button name="submit_article" type="submit"   value="submit_journal">Mettre à jour la BD</button> 
                                    <br/>
                                    <br/>
                                <?php
                                break;
                            default:
                                break;
                        }
                    }
                        ?>
                        </form>
            </div>
        </body>
</html>
<?php 
    $db = NULL; 
    }
?>