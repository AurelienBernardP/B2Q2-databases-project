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
                        <form id= "conference_input_form" method="post">   
                        <p>            
                        <label for="URL">URL</label><input type="url" name="URL" />            
                        <br />
                        <label for="DOI">DOI</label><input type="number" name="DOI" />
                        <br />
                        <label for="publication_date">date de publication </label><input type="date" name="date_publi" />
                        <br/>
                        <label for="matricule">Matricule du premier auteur<input type="number" name="matricule" />
                        <br />    
                        <label for="titre">Titre de l'article<input type="number" name="matricule" />
                        <br />                                    
                        <label for="matricule">Matricule du premier auteur><input type="number" name="matricule" />
                        <br />
                        <?php   
                        switch($_POST['type_article']){
                            case "conference":
                                ?>
                                    <label for="nom_conférence">Nom de la conférence<input type="text" name="nom_conf" />
                                    <br/>
                                    <label for="anne_conf">Année dans laquelle la conférance a eu lieu<input type="number" name="year_conf" />
                                    <br/>  
                                    <label for="presentation">Type de présentation<input type="text" name="presentation" />
                                    <br/>
                                    <!--subjects have to be added-->
                                    <button name="submit_article" type="submit" value="submit_conf">Mettre à jour la BD</button>     
                                    <br/>
                                <?php
                                break;
                            case "journal":
                                ?>
                                    <label for="nom_revue">Nom de la revue ou l'article fut publié<input type="text" name="nom_revue" />
                                    <br />
                                    <label for="nom_journal">Nom du journal ou l'article fut publié<input type="text" name="nom_journal" />
                                    <br />
                                    <label for="page_debut">Page ou l'article commence<input type="number" name="pg_debut" />
                                    <br />
                                    <label for="page_fin">Page ou l'article termine<input type="number" name="pg_fin" />
                                    <br />  
                                    <button name="submit_article" type="submit" value="submit_journal">Mettre à jour la BD</button> 
                                    <br/>
                                
                                <?php
                                break;
                            default:
                                break;
                        }
                        if(isset($_POST['submit_article']) AND $_POST['submit_article']=="submit_conf"){
                            header('location:submit_conf.php');
                        }elseif(isset($_POST['submit_article']) AND $_POST['submit_article']=="submit_journal"){
                            header('location:submit_journal.php');
                        }
                    }
                        ?>
                        </form>
            </div>
        </body>
</html>
<?php 
    $bd = NULL; 
?>