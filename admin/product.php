<?php
require_once("../inc/init.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- VERIFICATION ADMIN ---//
if(!internauteEstConnecteEtEstAdmin())
{
    header("location: ../login.php");
    exit();
}
//--- SUPPRESSION PRODUIT ---//
if(isset($_GET['action']) && $_GET['action'] == "suppression")
{   // $contenu .= $_GET['id_produit']
    $resultat = executeRequete("SELECT * FROM produit WHERE id_produit=$_GET[id_produit]");
    $produit_a_supprimer = $resultat->fetch_assoc();
    $chemin_photo_a_supprimer = $_SERVER['DOCUMENT_ROOT'] . $produit_a_supprimer['photo'];
    if(!empty($produit_a_supprimer['photo']) && file_exists($chemin_photo_a_supprimer)) unlink($chemin_photo_a_supprimer);
    executeRequete("DELETE FROM produit WHERE id_produit=$_GET[id_produit]");
    $contenu .= '<div class="bg-danger text-white text-center fs-5" style="margin-top: 20px;">Suppression du produit : ' . $_GET['id_produit'] . '</div>';
    $_GET['action'] = 'affichage';
}
//--- ENREGISTREMENT PRODUIT ---//
if(!empty($_POST))
{   // debug($_POST);
    $photo_bdd = "";
    if(isset($_GET['action']) && $_GET['action'] == 'modification')
    {
        $photo_bdd = $_POST['photo_actuelle'];
    } 
    if(!empty($_FILES['photo']['name']))
    {   // debug($_FILES);
        $nom_photo = $_POST['reference'] . '_' .$_FILES['photo']['name'];
        $photo_bdd = RACINE_SITE . "photo/$nom_photo";
        $photo_dossier = $_SERVER['DOCUMENT_ROOT'] . RACINE_SITE . "/photo/$nom_photo"; 
        copy($_FILES['photo']['tmp_name'],$photo_dossier);
    }
    foreach($_POST as $indice => $valeur)
    {
        $_POST[$indice] = htmlEntities(addSlashes($valeur));
    }
    executeRequete("REPLACE INTO produit (id_produit, reference, categorie, titre, description, couleur, marque, photo, prix, stock) values ('$_POST[id_produit]', '$_POST[reference]', '$_POST[categorie]', '$_POST[titre]', '$_POST[description]', '$_POST[couleur]', '$_POST[marque]',  '$photo_bdd',  '$_POST[prix]',  '$_POST[stock]')");
    $contenu .= '<div class="bg-success text-white text-center fs-5" style="margin-top: 20px;">Nouveau produit ajouter avec succès</div>';
}
//--- LIENS PRODUITS ---//
$contenu .= '<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"><a href="?action=affichage"><button type="button" class="btn btn-sm btn-outline-primary">Affichage Des Produits</button></a></div>';
$contenu .= '<div class="btn-toolbar mb-2 mb-md-0 float-end"><a href="?action=ajout"><button type="button" class="btn btn-sm btn-outline-primary">Ajout d\'un produit</button></a></div>';
//--- AFFICHAGE PRODUITS ---//
if(isset($_GET['action']) && $_GET['action'] == "affichage")
{
    $resultat = executeRequete("SELECT * FROM produit");
     
    $contenu .= '<h2 class="text-center"> Liste des Produits </h2>';
    $contenu .= '<p>Nombre de produit(s) dans la boutique : ' . $resultat->num_rows . '</p>';
    $contenu .= '<div class="table-responsive">
                  <table class="table table-striped table-sm">
                    <thead>
                      <tr>';
     
    while($colonne = $resultat->fetch_field())
    {    
        $contenu .= '<th scope="col">' . $colonne->name . '</th>';
    }
    $contenu .= '<th scope="col">Modifier</th>';
    $contenu .= '<th scope="col">Supprimer</th>';
    $contenu .= '</tr></thead>';
 
    while ($ligne = $resultat->fetch_assoc())
    {
        $contenu .= '<tbody><tr>';
        foreach ($ligne as $indice => $information)
        {
            if($indice == "photo")
            {
                $contenu .= '<td><img src="' . $information . '" ="70" height="70"></td>';
            }
            else
            {
                $contenu .= '<td>' . $information . '</td>';
            }
        }
        $contenu .= '<td><a href="?action=modification&id_produit=' . $ligne['id_produit'] .'"><i class="fa-solid fa-pen-to-square"></i></a></td>';
        $contenu .= '<td><a href="?action=suppression&id_produit=' . $ligne['id_produit'] .'" OnClick="return(confirm(\'En êtes vous certain ?\'));"><i class="fa-solid fa-trash-can"></i></a></td>';
        $contenu .= '</tr></tbody>';
    }
    $contenu .= '</table></div>';
}
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("inc/header.php");
require_once("inc/sidebar.php");
echo $contenu;
if(isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modification'))
{
    if(isset($_GET['id_produit']))
    {
        $resultat = executeRequete("SELECT * FROM produit WHERE id_produit=$_GET[id_produit]");
        $produit_actuel = $resultat->fetch_assoc();
    }
  echo '

<div class="w-75" style="margin: auto;">
  <h1 class="text-center"> Formulaire Produits </h1>
  <form method="post" enctype="multipart/form-data" action="">

    <div class="mb-3">
      <input class="form-control" type="hidden" id="id_produit" name="id_produit" value="'; if(isset($produit_actuel['id_produit'])) echo $produit_actuel['id_produit']; echo '">
    </div>

    <div class="mb-3">
      <input class="form-control" type="text" id="reference" name="reference" placeholder="la référence de produit" value="'; if(isset($produit_actuel['reference'])) echo $produit_actuel['reference']; echo '" required>
    </div>
    
    <div class="mb-3">
      <input class="form-control" type="text" id="categorie" name="categorie" placeholder="la categorie de produit" value="'; if(isset($produit_actuel['categorie'])) echo $produit_actuel['categorie']; echo '" required>
    </div>

    <div class="mb-3">
      <input class="form-control" type="text" id="titre" name="titre" placeholder="le titre du produit" value="'; if(isset($produit_actuel['titre'])) echo $produit_actuel['titre']; echo '" required>
    </div>

    <div class="mb-3">
      <textarea class="form-control" name="description" id="description" placeholder="la description du produit..."></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label" for="marque">Marque</label>
      <select name="marque" class="form-control">
            <option value="Techno"'; if(isset($produit_actuel) && $produit_actuel['marque'] == 'Techno') echo ' selected '; echo '>Techno</option>
            <option value="Samsung"'; if(isset($produit_actuel) && $produit_actuel['marque'] == 'Samsung') echo ' selected '; echo '>Samsung</option>
            <option value="Iphone"'; if(isset($produit_actuel) && $produit_actuel['marque'] == 'Iphone') echo ' selected '; echo '>Iphone</option>
            <option value="Itel"'; if(isset($produit_actuel) && $produit_actuel['marque'] == 'Itel') echo ' selected '; echo '>Itel</option>
            <option value="Ordinateur"'; if(isset($produit_actuel) && $produit_actuel['marque'] == 'Ordinateur') echo ' selected '; echo '>Ordinateur</option>
            <option value="Accessoire"'; if(isset($produit_actuel) && $produit_actuel['marque'] == 'Accessoire') echo ' selected '; echo '>Accessoire</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label" for="photo">photo</label>
        <input class="form-control" type="file" id="photo" name="photo">';
        if(isset($produit_actuel))
        {
            echo '<i>Vous pouvez uplaoder une nouvelle photo si vous souhaitez la changer</i><br>';
            echo '<img src="' . $produit_actuel['photo'] . '"  ="90" height="90"><br>';
            echo '<input class="form-label" type="hidden" name="photo_actuelle" value="' . $produit_actuel['photo'] . '"><br>';
        }

        echo '
    </div>

    <div class="mb-3">
        <input class="form-control" type="text" id="prix" name="prix" placeholder="le prix du produit"  value="'; if(isset($produit_actuel['prix'])) echo $produit_actuel['prix']; echo '" required>
    </div>

    <div class="mb-3">
      <input class="form-control" type="text" id="stock" name="stock" placeholder="le stock du produit"  value="'; if(isset($produit_actuel['stock'])) echo $produit_actuel['stock']; echo '">
    </div>

    <div class="mb-3">
      <input class="form-control" type="text" id="couleur" name="couleur" placeholder="la couleur du produit">
    </div>    

     <input class="form-control btn btn-outline-primary" type="submit" value="'; echo ucfirst($_GET['action']) . ' du produit">
     <br><br>
  </form>
</div>';

}

require_once("inc/footer.php"); ?>
