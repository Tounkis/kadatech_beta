<!doctype html>
<html lang="zxx">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Admin - Kadatechnologie</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo RACINE_SITE; ?>admin/inc/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo RACINE_SITE; ?>admin/inc/css/all.min.css">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="<?php echo RACINE_SITE; ?>admin/inc/css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="<?php echo RACINE_SITE; ?>admin/index.php">KADATECH ADMIN</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Rechercher">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <?php 
        if(internauteEstConnecteEtEstAdmin())
        {
          echo '<a href="' . RACINE_SITE . 'login.php?action=deconnexion" class="nav-link px-3">Deconnexion</a>';
        }
      ?>
    </div>
  </div>
</header>