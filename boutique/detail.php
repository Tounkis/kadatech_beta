<?php
require_once("../inc/init.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if(isset($_GET['id_produit']))  { $resultat = executeRequete("SELECT * FROM produit WHERE id_produit = '$_GET[id_produit]'"); }
if($resultat->num_rows <= 0) { header("location:boutique.php"); exit(); }

$produit = $resultat->fetch_assoc();

$contenu .= '
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Detail Du Produit</h1>
        <div class="d-inline-flex">
            <p class="m-0 text-center">Ventes en boutique et en ligne 100% Garantie Avec les meilleurs services après vente</p>
        </div>
    </div>
</div>
<!-- Page Header End -->
';
$contenu .= "
<!-- Shop Detail Start -->
    <div class=\"container-fluid py-5\">
        <div class=\"row px-xl-5\">
            <div class=\"col-lg-5 pb-5\">
                <div id=\"product-carousel\" class=\"carousel slide\" data-ride=\"carousel\">
                    <div class=\"carousel-inner border\">
                        <div class=\"carousel-item active\">
                            <img class=\"w-100 h-100\" src='$produit[photo]' ='150' alt=\"Image\">
                        </div>
                    </div>
                </div>
            </div>

            <div class=\"col-lg-7 pb-5\">
";
$contenu .= "<h3 class=\"font-weight-semi-bold\"> $produit[titre]</h3><br>";
$contenu .= "<h3 class=\"font-weight-semi-bold mb-4\">Prix : $produit[prix] FG</h3>";
$contenu .= "<p class=\"mb-4\">Categorie: $produit[categorie]</p>";
$contenu .= "<div class=\"d-flex mb-3\">
                <p class=\"text-dark font-weight-medium mb-0 mr-3\">Marque: $produit[marque]</p>
            </div>";
$contenu .= "<div class=\"d-flex mb-4\">
                <p class=\"text-dark font-weight-medium mb-0 mr-3\">Couleur: $produit[couleur]</p>
            </div>";



if($produit['stock'] > 0)
{
    $contenu .= "<i>Nombre d'produit(s) disponible : $produit[stock] </i><br><br>";
    $contenu .= '<form method="post" action="panier.php">';
        $contenu .= "<input type='hidden' name='id_produit' value='$produit[id_produit]'>";
        $contenu .= '<label for="quantite">Quantité :  &nbsp;</label>';
        $contenu .= '<select id="quantite" name="quantite">';
            for($i = 1; $i <= $produit['stock'] && $i <= 5; $i++)
            {
                $contenu .= "<option>$i</option>";
            }
        $contenu .= '</select>';
        $contenu .= '&nbsp;&nbsp;';
        $contenu .= '<input type="submit" name="ajout_panier" value="ajout au panier" class="btn btn-primary px-3 text-white">';
    $contenu .= '</form>';
}
else
{
    $contenu .= 'Rupture de stock !';
}
$contenu .= "<br><a href='boutique.php?categorie=" . $produit['categorie'] . "'>Retour vers la séléction de " . $produit['categorie'] . "</a>";



$contenu .= '
<div class="d-flex pt-2">
    <p class="text-dark font-weight-medium mb-0 mr-2">Partager:</p>
    <div class="d-inline-flex">
        <a class="text-dark px-2" href="">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a class="text-dark px-2" href="">
            <i class="fab fa-twitter"></i>
        </a>
        <a class="text-dark px-2" href="">
            <i class="fab fa-linkedin-in"></i>
        </a>
        <a class="text-dark px-2" href="">
            <i class="fab fa-pinterest"></i>
        </a>
    </div>
</div>
';

$contenu .= "</div>
        </div>";

$contenu .= "
<div class=\"row px-xl-5\">
    <div class=\"col\">
        <div class=\"tab-content\">
            <div class=\"tab-pane fade show active\" id=\"tab-pane-1\">
                <h4 class=\"mb-3\">Description Du Produit</h4>
                <p><i>$produit[description]</i></p>
            </div>
        </div>
    </div>
</div>
";

$contenu .= "</div>";

$contenu .= '
<!-- Products Start -->
<div class="container-fluid py-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Vous Pouvez Aussi Aimer</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                <div class="card product-item border-0">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="img/img1.jpg" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">Samsung Galaxie J7+</h6>
                        <div class="d-flex justify-content-center">
                            <h6>5 000 000 FG</h6><h6 class="text-muted ml-2"><del>6 500 000 FG</del></h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Voir Les Details</a>
                    </div>
                </div>
                <div class="card product-item border-0">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="img/img2.jpg" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">Iphone 13+</h6>
                        <div class="d-flex justify-content-center">
                            <h6>10 000 000 FG</h6><h6 class="text-muted ml-2"><del>11 500 000 FG</del></h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Voir Les Details</a>
                    </div>
                </div>
                <div class="card product-item border-0">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="img/img3.jpg" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">Samsung Galaxie A10</h6>
                        <div class="d-flex justify-content-center">
                            <h6>3 000 000 FG</h6><h6 class="text-muted ml-2"><del>4 000 000 FG</del></h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Voir Les Details</a>
                    </div>
                </div>
                <div class="card product-item border-0">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="img/img1.jpg" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">Samsung Galaxie J7 Pro</h6>
                        <div class="d-flex justify-content-center">
                            <h6>4 500 000 FG</h6><h6 class="text-muted ml-2"><del>5 000 000 FG</del></h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Voir Les Details</a>
                    </div>
                </div>
                <div class="card product-item border-0">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="img/img2.jpg" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">Iphone 7</h6>
                        <div class="d-flex justify-content-center">
                            <h6>8 000 000 FG</h6><h6 class="text-muted ml-2"><del>9 500 000 FG</del></h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Voir Les Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Products End -->
';

//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("inc/header.php");
require_once("inc/navbar.php");

echo $contenu;

require_once("inc/footer.php");
