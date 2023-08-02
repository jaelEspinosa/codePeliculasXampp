<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Bootstrap -->
    <link rel="stylesheet" href="<?= base_url()?>bootstrap/css/bootstrap.min.css">


  
    <link rel="stylesheet" href="<?php echo base_url()?>css/globalStyle.css">
    <title>Modulo Web</title>
</head>
<body>
    <h1>WebPanel</h1>
<?php if(session('Mensaje')): ?>
    <div class="tostada">
        <?= view('partials/_session') ?>
    </div>
    <?php endif ?>

    
  

  <?= $this->renderSection('contenido') ?>
    
</body>
</html>