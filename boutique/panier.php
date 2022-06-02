<?php
require_once("../inc/init.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- AJOUT PANIER ---//
if(isset($_POST['ajout_panier'])) 
{   // debug($_POST);
    $resultat = executeRequete("SELECT * FROM produit WHERE id_produit='$_POST[id_produit]'");
    $produit = $resultat->fetch_assoc();
    ajouterProduitDansPanier($produit['titre'],$_POST['id_produit'],$_POST['quantite'],$produit['prix']);
}
//--- VIDER PANIER ---//
if(isset($_GET['action']) && $_GET['action'] == "vider")
{
    unset($_SESSION['panier']);
}
//--- PAIEMENT ---//
if(isset($_POST['payer']))
{
    for($i=0 ;$i < count($_SESSION['panier']['id_produit']) ; $i++) 
    {
        $resultat = executeRequete("SELECT * FROM produit WHERE id_produit=" . $_SESSION['panier']['id_produit'][$i]);
        $produit = $resultat->fetch_assoc();
        if($produit['stock'] < $_SESSION['panier']['quantite'][$i])
        {
            $contenu .= '<hr><div class="erreur">Stock Restant: ' . $produit['stock'] . '</div>';
            $contenu .= '<div class="erreur">Quantité demandée: ' . $_SESSION['panier']['quantite'][$i] . '</div>';
            if($produit['stock'] > 0)
            {
                $contenu .= '<div class="erreur">la quantité de l\'produit ' . $_SESSION['panier']['id_produit'][$i] . ' à été réduite car notre stock était insuffisant, veuillez vérifier vos achats.</div>';
                $_SESSION['panier']['quantite'][$i] = $produit['stock'];
            }
            else
            {
                $contenu .= '<div class="erreur">l\'produit ' . $_SESSION['panier']['id_produit'][$i] . ' à été retiré de votre panier car nous sommes en rupture de stock, veuillez vérifier vos achats.</div>';
                retirerProduitDuPanier($_SESSION['panier']['id_produit'][$i]);
                $i--;
            }
            $erreur = true;
        }
    }
    if(!isset($erreur))
    {
        executeRequete("INSERT INTO commande (id_users, montant, date_enregistrement) VALUES (" . $_SESSION['user']['id_users'] . "," . montantTotal() . ", NOW())");
        $id_commande = $mysqli->insert_id;
        for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
        {
            executeRequete("INSERT INTO details_commande (id_commande, id_produit, quantite, prix) VALUES ($id_commande, " . $_SESSION['panier']['id_produit'][$i] . "," . $_SESSION['panier']['quantite'][$i] . "," . $_SESSION['panier']['prix'][$i] . ")");
        }
        unset($_SESSION['panier']);
        mail($_SESSION['user']['email'], "confirmation de la commande", "Merci votre n° de suivi est le $id_commande", "From:jerometounkara@gmail.com");
        $contenu .= "<div class='validation'>Merci pour votre commande. votre n° de suivi est le $id_commande</div>";
    }
}
//--------------------------------- AFFICHAGE HTML ---------------------------------//
include("inc/header.php");
include("inc/navbar.php");

echo $contenu;
echo '<div class="container">';
echo '<hr><h4 class="text-center">Votre Panier</h4>';
echo '<table class="table">';
echo '
<thead>
    <tr>
        <th scope="col">Titre</th>
        <th scope="col">Produit</th>
        <th scope="col">Quantité</th>
        <th scope="col">Prix Unitaire</th>
    </tr>
</thead>';
if(empty($_SESSION['panier']['id_produit'])) // panier vide
{
    echo "<hr><tbody><tr><td>Votre panier est vide</td></tr></tbody>";
}
else
{
    for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++) 
    {
        echo "<tbody>";
        echo "<tr>";
        echo "<td>" . $_SESSION['panier']['titre'][$i] . "</td>";
        echo "<td>" . $_SESSION['panier']['id_produit'][$i] . "</td>";
        echo "<td>" . $_SESSION['panier']['quantite'][$i] . "</td>";
        echo "<td>" . $_SESSION['panier']['prix'][$i] . "</td>";
        echo "</tr>";
        echo "</tbody>";
    }
    echo "<tr><th>Total</th><td>" . montantTotal() . " FG</td></tr>";
    if(internauteEstConnecte()) 
    {
        echo '<form method="post" action="">';
        echo '<tbody><tr><td><input type="submit" name="payer" value="Valider et déclarer le paiement" class="form-control bg-success text-white"></td></tr></tbody>';
        echo '</form>';   
    }
    else
    {
        echo '<tbody><tr><td>Veuillez vous <a href="register.php">inscrire</a> ou vous <a href="login.php">connecter</a> afin de pouvoir payer</td></tr></tbody>';
    }
    echo "<tbody><tr><td><a href='?action=vider'>Vider mon panier</a></td></tr></tbody>";
}
echo "</table>";
echo "<i>Réglement par Orange Money uniquement au numéro suivant : <strong>+224 626 46 53 83<strong></i><br>";
echo "</div>";
//echo "<hr>session panier:<br>"; //debug($_SESSION);
include("inc/footer.php");
?>
