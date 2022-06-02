<?php
require_once("inc/init.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if(!internauteEstConnecte()) header("location:login.php");
// debug($_SESSION);
$contenu .= '<p class="centre">Bonjour <strong>' . $_SESSION['user']['pseudo'] . '</strong></p>';
$contenu .= '<div class="cadre"><h2> Voici vos informations </h2>';
$contenu .= '<p> votre email est: ' . $_SESSION['user']['email'] . '<br>';
$contenu .= 'votre ville est: ' . $_SESSION['user']['ville'] . '<br>';
$contenu .= 'votre tel est: ' . $_SESSION['user']['tel'] . '<br>';
$contenu .= 'votre adresse est: ' . $_SESSION['user']['adresse'] . '</p></div><br><br>';
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("inc/header.php");
require_once("inc/navbar.php");
echo $contenu;
require_once("inc/footer.php");