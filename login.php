<?php require_once("inc/init.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if(isset($_GET['action']) && $_GET['action'] == "deconnexion")
{
    session_destroy();
}
if(internauteEstConnecte())
{
    header("location:profil.php");
}
if($_POST)
{
    $resultat = executeRequete("SELECT * FROM users WHERE pseudo='$_POST[pseudo]'");
    if($resultat->num_rows != 0)
    {
        $user = $resultat->fetch_assoc();
        if($user['mdp'] == $_POST['mdp'])
        {
            foreach($user as $indice => $element)
            {
                if($indice != 'mdp')
                {
                    $_SESSION['user'][$indice] = $element;
                }
            }
            header("location:profil.php");
        }
        else
        {
            $contenu .= '<div class="erreur">Nom utilisateur ou Mot de passe incorrect</div>';
        }       
    }
    else
    {
        $contenu .= '<div class="erreur">Nom utilisateur ou Mot de passe incorrect</div>';
    }
}
//--------------------------------- AFFICHAGE HTML ---------------------------------//
?>
<?php require_once("inc/header.php"); ?>
<?php require_once("inc/navbar.php"); ?>
<?php echo $contenu; ?>


<!-- Formulaire d'inscription -->
<div class="container-fluid bg-white" style="max-width: 500px; margin-top: 50px;">
	<h3 class="text-center text-primary">Connectez Vous</h3 class="text-center text-primary"><br>
	<form method="post" action="">
	  <div class="mb-3">
	    <label for="pseudo" class="form-label">Nom d'utilisateur</label>
    	<input type="text" class="form-control" id="pseudo" name="pseudo">
	  </div>
	  <div class="mb-3">
	  	<label for="mdp" class="form-label">Mot de passe</label>
    	<input type="password" class="form-control" id="mdp" name="mdp">
	  </div>
	  <input type="submit" value="Se Connecter" class="btn btn-primary">
	</form>	
</div>
<!-- Formulaire d'inscription -->
 

<?php require_once("inc/footer.php"); ?>