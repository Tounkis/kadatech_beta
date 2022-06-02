<?php
require_once("../inc/init.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- VERIFICATION ADMIN ---//
if(!internauteEstConnecteEtEstAdmin())
{
    header("location:../login.php");
    exit();
}
//--- ENREGISTREMENT PRODUIT ---//
if(!empty($_POST))
{   // debug($_POST);
    $photo_bdd = ""; 
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
    executeRequete("INSERT INTO produit (id_produit, reference, categorie, titre, description, couleur, marque, photo, prix, stock) values ('', '$_POST[reference]', '$_POST[categorie]', '$_POST[titre]', '$_POST[description]', '$_POST[couleur]', '$_POST[marque]',  '$photo_bdd',  '$_POST[prix]',  '$_POST[stock]')");
    $contenu .= '<div class="text-center bg-success text-white fs-4">Le produit a été ajouté</div>';
}
//--- LIENS PRODUITS ---//
$contenu .= '<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><a href="?action=affichage">Affichage des produits</a></div>';
$contenu .= '<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><a href="?action=ajout">Ajout d\'un produit</a></div>';
//--- AFFICHAGE PRODUITS ---//
if(isset($_GET['action']) && $_GET['action'] == "affichage")
{
    $resultat = executeRequete("SELECT * FROM produit");
     
    $contenu .= '<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><h2> Affichage des Produits </h2></div>';
    $contenu .= '<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">Nombre de produit(s) dans la boutique : </div>' . $resultat->num_rows;
    $contenu .= '<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><table border="1"><tr>';
     
    while($colonne = $resultat->fetch_field())
    {    
        $contenu .= '<th>' . $colonne->name . '</th>';
    }
    $contenu .= '<th>Modification</th>';
    $contenu .= '<th>Supression</th>';
    $contenu .= '</tr></div>';
 
    while ($ligne = $resultat->fetch_assoc())
    {
        $contenu .= '<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><tr>';
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
        $contenu .= '<td><a href="?action=modification&id_produit=' . $ligne['id_produit'] .'"><img src="../inc/img/edit.png"></a></td>';
        $contenu .= '<td><a href="?action=suppression&id_produit=' . $ligne['id_produit'] .'" OnClick="return(confirm(\'En êtes vous certain ?\'));"><img src="../inc/img/delete.png"></a></td>';
        $contenu .= '</tr></div>';
    }
    $contenu .= '</table><br><hr><br>';
}
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("inc/header.php");
require_once("inc/sidebar.php");
echo $contenu;
if(isset($_GET['action']) && ($_GET['action'] == 'ajout'))
{
    echo '

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

      <h1> Formulaire Produits </h1>
      <form method="post" enctype="multipart/form-data" action="">
        <div class="mb-3">
          <input class="form-control" type="text" id="reference" name="reference" placeholder="la référence de produit" required>
        </div>
        <div class="mb-3">
          <input class="form-control" type="text" id="categorie" name="categorie" placeholder="la categorie de produit" required>
        </div>
        <div class="mb-3">
          <input class="form-control" type="text" id="titre" name="titre" placeholder="le titre du produit">
        </div>
        <div class="mb-3">
          <textarea class="form-control" name="description" id="description" placeholder="la description du produit..."></textarea>
        </div>
        <div class="mb-3">
          <input class="form-control" type="text" id="couleur" name="couleur" placeholder="la couleur du produit">
        </div>
        <div class="mb-3">
          <label for="marque">Marque</label>
          <select name="marque" class="form-select" required>
              <option value="techno">Techno</option>
              <option value="itel">Itel</option>
              <option value="samsung">Samsung</option>
              <option value="iphone">Iphone</option>
          </select>
        </div> 
        <div class="mb-3">
            <label class="form-label" for="photo">photo</label><br>
            <input class="form-control" type="file" id="photo" name="photo">
        </div>
        <div class="mb-3">
            <input class="form-control" type="text" id="prix" name="prix" placeholder="le prix du produit" required>
        </div>
        <div class="mb-3">
          <input class="form-control" type="text" id="stock" name="stock" placeholder="le stock du produit">
        </div>

          <input class="btn btn-block btn-primary" type="submit" value="Enregistrement du produit">

      </form>

    </main>
  </div>
</div>';
}

require_once("inc/footer.php"); ?>