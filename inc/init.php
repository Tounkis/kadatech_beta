<?php
//--------- BDD
$servername = "localhost:3307";
$username = "root";
$password = "";
$database = "kadatech";

$mysqli = new mysqli($servername, $username, $password, $database);
if ($mysqli->connect_error) die('Un problème est survenu lors de la tentative de connexion à la BDD : ' . $mysqli->connect_error);
// $mysqli->set_charset("utf8");
 
//--------- SESSION
session_start();
 
//--------- CHEMIN
define("RACINE_SITE","/kadatech/");
 
//--------- VARIABLES
$contenu = '';
 
//--------- AUTRES INCLUSIONS
require_once("fonction.php");