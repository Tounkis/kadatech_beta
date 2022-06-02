<?php
require_once("../inc/init.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- AFFICHAGE DES CATEGORIES ---//
$categories_des_produits = executeRequete("SELECT DISTINCT categorie FROM produit");

$contenu .= '
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Votre Boutique En Ligne</h1>
        <div class="d-inline-flex">
            <p class="m-0 text-center">Nous vendons le telephone qu\'il vous faut</p>
        </div>
        <button class="btn btn-danger border-0 py-3">Achetez Maintenant</button>
    </div>
</div>
<!-- Page Header End -->
';

$contenu .= '
<!-- Shop Start -->
<div class="container-fluid">
    <div class="row pb-3">
';


$contenu .= '
<div class="col-12 pb-1">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <form action="">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Entrez le nom d\'un produit">
                <div class="input-group-append">
                    <span class="input-group-text bg-transparent text-primary">
                        <i class="fa fa-search"></i>
                    </span>
                </div>
            </div>
        </form>
        <div class="dropdown ml-4">
            <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                        Catégorie
                    </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">';
while($cat = $categories_des_produits->fetch_assoc())
{
    $contenu .= "<a class=\"dropdown-item\" href='?categorie=" . $cat['categorie'] . "'>" . $cat['categorie'] . "</a>";
}
$contenu .= "</div>
        </div>
    </div>
</div>";
//--- AFFICHAGE DES PRODUITS ---//
$contenu .= '
<!-- Start Product -->
<div class="col-12 pb-1">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h2 class="font-weight-semi-bold mb-3">Nos Produits</h2>
    </div>
</div>
';
$contenu .= '
<div class="col-md-3">
    <div class="card product-item border-0 mb-4">
        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
            <img class="img-fluid w-100" src="img/img1.jpg" alt="">
        </div>
        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
            <h6 class="text-truncate mb-3">Techno Camon 12</h6>
            <div class="d-flex justify-content-center">
                <h6>1 500 000 FG</h6><h6 class="text-muted ml-2"><del>1 800 000 FG</del></h6>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between bg-light border">
            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Voir Les Details</a>
        </div>
    </div>
</div>       
<!-- End techno -->
';
$contenu .= '
<div class="col-md-3">
    <div class="card product-item border-0 mb-4">
        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
            <img class="img-fluid w-100" src="img/img2.jpg" alt="">
        </div>
        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
            <h6 class="text-truncate mb-3">Techno Camon 12</h6>
            <div class="d-flex justify-content-center">
                <h6>1 500 000 FG</h6><h6 class="text-muted ml-2"><del>1 800 000 FG</del></h6>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between bg-light border">
            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Voir Les Details</a>
        </div>
    </div>
</div>      
<!-- End techno -->
';
$contenu .= '
<div class="col-md-3">
    <div class="card product-item border-0 mb-4">
        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
            <img class="img-fluid w-100" src="img/img3.jpg" alt="">
        </div>
        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
            <h6 class="text-truncate mb-3">Techno Camon 12</h6>
            <div class="d-flex justify-content-center">
                <h6>1 500 000 FG</h6><h6 class="text-muted ml-2"><del>1 800 000 FG</del></h6>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between bg-light border">
            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Voir Les Details</a>
        </div>
    </div>
</div>      
<!-- End techno -->
';
$contenu .= '
<div class="col-md-3">
    <div class="card product-item border-0 mb-4">
        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
            <img class="img-fluid w-100" src="img/img4.jpg" alt="">
        </div>
        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
            <h6 class="text-truncate mb-3">Techno Camon 12</h6>
            <div class="d-flex justify-content-center">
                <h6>1 500 000 FG</h6><h6 class="text-muted ml-2"><del>1 800 000 FG</del></h6>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between bg-light border">
            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Voir Les Details</a>
        </div>
    </div>
</div>       
<!-- End techno -->
';

if(isset($_GET['categorie']))
{
    $donnees = executeRequete("select id_produit,reference,titre,photo,prix from produit where categorie='$_GET[categorie]'");  
    while($produit = $donnees->fetch_assoc())
    {
        $contenu .= '<div class="col-md-3">
                        <div class="card product-item border-0 mb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">';
        $contenu .= "<a href=\"detail.php?id_produit=$produit[id_produit]\"><img class=\"img-fluid w-100\" src=\"$produit[photo]\" =\"130\" ></a>";
        $contenu .= '</div>';
        $contenu .= '<div class="card-body border-left border-right text-center p-0 pt-4 pb-3">';
        $contenu .= "<h6 class=\"text-truncate mb-3\">$produit[titre]</h6>";
        $contenu .= '<div class="d-flex justify-content-center">';
        $contenu .= "<h6>$produit[prix] FG</h6><h6 class=\"text-muted ml-2\"><del>$produit[prix] FG</del></h6>";
        $contenu .= '</div>';
        $contenu .= '</div>';
        $contenu .= '<div class="card-footer d-flex justify-content-between bg-light border">';
        $contenu .= '<a class="btn btn-block text-dark" href="detail.php?id_produit=' . $produit['id_produit'] . '"><i class="fas fa-eye text-primary mr-1"></i>Voir Détails</a>';
        $contenu .= '</div>';
        $contenu .= '</div>';
        $contenu .= '</div>';
    }
}

//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("inc/header.php");
require_once("inc/navbar.php");

echo $contenu;

require_once("inc/footer.php"); 

?>
