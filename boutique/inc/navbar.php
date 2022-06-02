<!-- Navbar Start -->
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
        <a href="" class="text-decoration-none d-block d-lg-none">
            <img src="<?php echo RACINE_SITE; ?>boutique/img/logo.png" alt="" width="100" height="60">
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <?php 
                if(internauteEstConnecteEtEstAdmin())
                {
                    // echo '<a href="' . RACINE_SITE . 'admin/index.php" class="nav-item nav-link">Admin</a>';
                    header("location: admin/index.php");
                }
                if(internauteEstConnecte())
                {
                    echo '<div class="navbar-nav mr-auto py-0">';
                    echo '<a href="' . RACINE_SITE . 'boutique/profil.php" class="nav-item nav-link active">VOIR VOTRE PROFIL</a>';
                    echo '<a href="' . RACINE_SITE . 'boutique/boutique.php" class="nav-item nav-link">ACCES A LA BOUTIQUE</a>';
                    echo '<a href="' . RACINE_SITE . 'boutique/panier.php" class="nav-item nav-link">VOIR PANIER</a>';
                    echo '</div>';
                    echo '<div class="navbar-nav ml-auto py-0">';
                    echo '<a href="' . RACINE_SITE . 'login.php?action=deconnexion" class="nav-item nav-link">DECONNEXION</a>';
                    echo '</div>';
                }
                else
                {
                    echo '<div class="navbar-nav mr-auto py-0">';
                    echo '<a href="' . RACINE_SITE . 'boutique/index.php" class="nav-item nav-link active">ACCUEIL</a>';
                    echo '<a href="' . RACINE_SITE . 'boutique/boutique.php" class="nav-item nav-link">ACCES A LA BOUTIQUE</a>';
                    echo '</div>';
                    echo '<div class="navbar-nav ml-auto py-0">';
                    echo '<a href="' . RACINE_SITE . 'login.php" class="nav-item nav-link">CONNEXION</a>';                    
                    echo '<a href="' . RACINE_SITE . 'register.php" class="nav-item nav-link">INSCRIPTION</a>';                    
                    echo '</div>';
                }
            ?>
        </div>
    </nav>
</div>
<!-- Navbar End -->