<!-- Spinner Start -->
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Chargement...</span>
    </div>
</div>
<!-- Spinner End -->


<!-- Topbar Start -->
<div class="container-fluid btn-primary p-0">
    <div class="row gx-0 d-none d-lg-flex">
        <div class="col-lg-7 px-5 text-start">
            <div class="h-100 d-inline-flex align-items-center me-4 text-white">
                <small class="fa fa-map-marker-alt me-2"></small>
                <small>Sonfonia T7, Conakry, Guinée</small>
            </div>
            <div class="h-100 d-inline-flex align-items-center text-white">
                <small class="far fa-clock me-2"></small>
                <small>Lundi - Dimanche : 08h.00 - 08h.00</small>
            </div>
        </div>
        <div class="col-lg-5 px-5 text-end">
            <div class="h-100 d-inline-flex align-items-center me-4 text-white">
                <small class="fa fa-phone-alt me-2"></small>
                <small>+224 626 46 53 83</small>
            </div>
            <div class="h-100 d-inline-flex align-items-center mx-n2">
                <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary" href=""><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary" href=""><i class="fab fa-twitter"></i></a>
                <a class="btn btn-square btn-link rounded-0 border-0 border-end border-secondary" href=""><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-square btn-link rounded-0" href=""><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-light navbar-light sticky-top p-0">
    <a class="navbar-brand" href="#">
        <img src="<?php echo RACINE_SITE; ?>inc/img/logo.png" alt="" width="100" height="60">
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <?php 
                if(internauteEstConnecteEtEstAdmin())
                {
                    // echo '<a href="' . RACINE_SITE . 'admin/index.php" class="nav-item nav-link">Admin</a>';
                    header("location: admin/index.php");
                }
                if(internauteEstConnecte())
                {
                    echo '<a href="' . RACINE_SITE . 'profil.php" class="nav-item nav-link">Voir votre profil</a>';
                    echo '<a href="' . RACINE_SITE . 'boutique/index.php" class="nav-item nav-link">Boutique</a>';
                    echo '<a href="' . RACINE_SITE . 'boutique/panier.php" class="nav-item nav-link">Voir panier</a>';
                    echo '<a href="' . RACINE_SITE . 'login.php?action=deconnexion" class="nav-item nav-link">Se déconnecter</a>';
                }
                else
                {
                    echo '<a href="' . RACINE_SITE . 'index.php" class="nav-item nav-link active">Accueil</a>';
                    echo '<a href="' . RACINE_SITE . 'boutique/index.php" class="nav-item nav-link">Boutique</a>';
                    echo '<a href="' . RACINE_SITE . 'repair.php" class="nav-item nav-link">Reparation</a>';
                    echo '<div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Se Connecter</a>
                        <div class="dropdown-menu bg-light m-0">
                            <a href="' . RACINE_SITE . 'register.php" class="dropdown-item">Inscription</a>
                            <a href="' . RACINE_SITE . 'login.php" class="dropdown-item">Connexion</a>
                        </div>
                    </div>';
                    echo '<a href="' . RACINE_SITE . 'about.php" class="nav-item nav-link">A Propos</a>';
                    echo '<a href="' . RACINE_SITE . 'contact.php" class="nav-item nav-link">Contact</a>';
                }                    
            ?>
        </div>
    </div>
</nav>
<!-- Navbar End -->