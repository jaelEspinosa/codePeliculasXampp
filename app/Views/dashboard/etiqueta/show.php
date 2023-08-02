




<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('contenido') ?>


    
<div class="d-flex align-items-center justify-content-between ">
        <h1><?= $etiqueta['titulo'] ?></h1>
        <a href="<?php echo base_url().'dashboard/etiqueta'?>" class="btn  btn-primary">volver</a>
    </div>




<?= $this->endSection() ?>