
<?=$this->extend('Layouts/blog')?>
<?= $this->section('contenido') ?>


<div style="width:100%" class="border shadow p-2">
<?php foreach ($peliculas as $p) :?>
    <div class="border rounded mb-3 p-2">
        <div class="card-body">
        <div class="card-title">
            <h4><?=$p['titulo']?></h4>
        </div>
        <p class="card-text"><?=$p['description']?></p>
        </div>
        <a href="<?=base_url().'blog/pelicula/show/'. $p['id']?>" class="btn btn-sm btn-outline-secondary">Ver</a>
    </div>
<?php endforeach?>    
</div>
<?= $pager->links() ?>
<?= $this->endSection() ?>