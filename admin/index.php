<?php
require_once("../inc/init.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- VERIFICATION ADMIN ---//
if(!internauteEstConnecteEtEstAdmin())
{
    header("location: ../login.php");
    exit();
}
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("inc/header.php");
require_once("inc/sidebar.php");

?>


<?php require_once("inc/footer.php"); ?>
