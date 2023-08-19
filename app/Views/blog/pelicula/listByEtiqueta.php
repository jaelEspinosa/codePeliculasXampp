<?=$this->extend('Layouts/blog')?>
<?= $this->section('contenido') ?>

<div class="d-flex align-items-center justify-content-between ">
<h3>Listado de Peliculas con Etiqueta, <span class="text-primary"><?=$etiqueta['titulo']  ?></span></h3>
<a href="<?php echo base_url().'blog/pelicula'?>" class="btn btn-sm btn-primary mb-2">volver</a>
</div>

<?= view('partials/_peliculas') ?>


<?= $this->endSection() ?>