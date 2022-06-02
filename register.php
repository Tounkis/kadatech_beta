<?php require_once("inc/init.php");

//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if($_POST)
{
    // debug($_POST);
    $verif_caractere = preg_match('#^[a-zA-Z0-9._-]+$#', $_POST['pseudo']); 
    if(!$verif_caractere && (strlen($_POST['pseudo']) < 1 || strlen($_POST['pseudo']) > 20) )
    {
        $contenu .= "<div class='erreur'>Le pseudo doit contenir entre 1 et 20 caractères. <br> Caractère accepté : Lettre de A à Z et chiffre de 0 à 9</div>";
    }
    else
    {
        $user = executeRequete("SELECT * FROM users WHERE pseudo='$_POST[pseudo]'");
        if($user->num_rows > 0)
        {
            $contenu .= "<div class='erreur'>Pseudo indisponible. Veuillez en choisir un autre s'il vous plait.</div>";
        }
        else
        {
            // $_POST['mdp'] = md5($_POST['mdp']);
            foreach($_POST as $indice => $valeur)
            {
                $_POST[$indice] = htmlEntities(addSlashes($valeur));
            }
            executeRequete("INSERT INTO users (pseudo, mdp, nom, prenom, email, sexe, ville, tel, adresse) VALUES ('$_POST[pseudo]', '$_POST[mdp]', '$_POST[nom]', '$_POST[prenom]', '$_POST[email]', '$_POST[sexe]', '$_POST[ville]', '$_POST[tel]', '$_POST[adresse]')");
            $contenu .= "<div class='validation'>Félicitations ! Vous êtes inscrit avec succès. <a href=\"login.php\" class='text-white'>Cliquez ici pour vous connecter</a></div>";
        }
    }
}
//--------------------------------- AFFICHAGE HTML ---------------------------------//
?>
<?php require_once("inc/header.php"); ?>
<?php require_once("inc/navbar.php"); ?>
<?php echo $contenu; ?>


<!-- Formulaire d'inscription -->
<div class="container-fluid bg-white" style="max-width: 500px; margin-top: 50px;">
	<h3 class="text-center text-primary">Veuillez vous inscrire</h3 class="text-center text-primary"><br>
	<form method="post" action="">
	  <div class="mb-3">
	    <label for="pseudo" class="form-label">Nom d'utilisateur</label>
    	<input type="text" class="form-control" id="pseudo" name="pseudo" maxlength="20" pattern="[a-zA-Z0-9-_.]{1,20}" title="caractères acceptés : a-zA-Z0-9-_." required="required" aria-describedby="emailHelp">
	  </div>
	  <div class="mb-3">
	  	<label for="mdp" class="form-label">Mot de passe</label>
    	<input type="password" class="form-control" id="mdp" name="mdp" required="required">
	  </div>
	  <div class="mb-3">
	  	<label for="nom" class="form-label">Nom</label>
    	<input type="text" id="nom" name="nom" class="form-control">
	  </div>
	  <div class="mb-3">
	  	<label for="prenom" class="form-label">Prénom</label>
    	<input type="text" id="prenom" name="prenom" class="form-control">
	  </div>	  
	  <div class="mb-3">
	    <label for="email" class="form-label">Adresse Email</label>
    	<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
	  </div>
	  <div class="mb-3">
	    <label for="sexe" class="form-label">Sexe</label><br>
    	<input name="sexe" value="m" checked="" type="radio">Homme
    	<input name="sexe" value="f" type="radio">Femme
      </div>
	  <div class="mb-3">
	    <label for="ville" class="form-label">Ville</label>
	    <input type="text" class="form-control" id="ville" name="ville" pattern="[a-zA-Z0-9-_.]{5,15}" title="caractères acceptés : a-zA-Z0-9-_.">
      </div>
	  <div class="mb-3">
	  	<label for="tel" class="form-label">Télephone</label>
	    <input type="text" class="form-control" id="tel" name="tel" placeholder="620 00 00 00" />
      </div>
      <div class="mb-3">
	    <textarea id="adresse" name="adresse" placeholder="Entrez Votre Adresse" pattern="[a-zA-Z0-9-_.]{5,15}" title="caractères acceptés :  a-zA-Z0-9-_." class="form-control"></textarea>
	  </div>
	  <input type="submit" name="inscription" value="S'inscrire" class="btn btn-primary">
	</form>	
</div>
<!-- Formulaire d'inscription -->
 

<?php require_once("inc/footer.php"); ?>