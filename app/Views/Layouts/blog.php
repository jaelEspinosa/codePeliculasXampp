<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->

    <link rel="stylesheet" href="<?= base_url() ?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>css/globalStyle.css">
    <script src="<?= base_url() ?>bootstrap/js/bootstrap.min.js"></script>

    <!-- font-awesome-icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css global -->
  
    <title>Modulo de Admin</title>
</head>

<body>
  
    <div class="container mt-3">
    <h2 class="text-secondary">Peliculas<span class="text-primary">Blog</span></h2>
        <div class="mx-5 mt-2 d-flex align-items-center justify-content-around">
          

            <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
        <p class="text-secondary mb-0 p-2 desk-solo list">CodePeliculas</p>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#my-navbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
        <div class="collapse navbar-collapse menu-movil" id="my-navbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a  class="nav-link" href="<?=base_url().'blog/pelicula'?>">Películas</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url()?>dashboard/pelicula" class="nav-link <?=session('type') !== 'admin' ? 'disabled':'' ?>">AdminPanel</a>
                </li>
               
                <li class="nav-item">
                  <a class="movil-solo" href="<?= base_url() . 'logout' ?>">
                  <i class="fa-sharp fa-solid fa-arrow-right-from-bracket"></i> Logout
                  </a>
                </li>
                
            </ul>
       
        </div>
        </div>
    </nav>
    <?php if(session('username')):?>
    <h5 class="d-flex align-items-start gap-1 text-primary"><i class="fa fa-user" aria-hidden="true"></i>
    <?= session('username') ?></h5>
    <?php endif?>
    <?php if(session('username')):?>
        <a class="btn btn-sm btn-outline btn-primary desk-solo" href="<?= base_url() . 'logout' ?>">
            <i class="fa-sharp fa-solid fa-arrow-right-from-bracket"></i> Logout
        </a>
    <?php endif?>
    <?php if(session('username')== ''):?>
        <a class="btn btn-sm btn-outline btn-primary desk-solo" href="<?= base_url() . 'login' ?>">
            <i class="fa-sharp fa-solid fa-arrow-right-from-bracket"></i> Login
        </a>
    <?php endif?>


</div>

<div class="border shadow-lg mb-3"></div>

<?php if (session('Mensaje')) : ?>
    <div class="tostada">
        <?= view('partials/_session') ?>
    </div>
            <?php endif ?>
            <?php if (session('mensaje')) : ?>
                <div class="tostada-ok">
                    <?= view('partials/_session') ?>
                </div>
                <?php endif ?>
                
                <?= $this->renderSection('contenido') ?>
                
            </div>
</body>

</html>