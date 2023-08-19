<div style="width:100%; 
            height:calc(100vh - 380px); 
            overflow-y: scroll; " 
    class="border shadow p-4">


<?php foreach ($peliculas as $p) :?>
    <div class="border rounded mb-3 p-2 row ">
      <div class="col-md-8 d-flex flex-column align-items-start justify-content-around">
      <div class="card-body mb-2">
        <div class="card-title">
            <h3 class="mb-5"><?=$p['titulo']?></h3>
            <a href="<?=base_url(route_to('blog.peliculas.categoria', $p['categoria_id']))?>"  class="btn btn-sm btn-secondary"><?=$p['categoria']?></a>
            
        </div>
        <p class="card-text mt-3"><span>Descripcion: </span><?=$p['description']?></p>
        <?php 
            $etiquetasArray = explode(",", $p['etiquetas']);
        ?>  
        <?php if($p['etiquetas'] !== null) : ?>
        <?php foreach ($etiquetasArray as $e):?>       
          <p class="border rounded bg-primary text-white p-2 d-inline"  ><?=$e?></p>        
        <?php endforeach  ?>   
        <?php endif  ?>
        </div>
        <a href="<?=base_url(route_to('blog.pelicula.show', $p['id']))?>" class="btn btn-sm btn-outline-secondary mt-4">Ver</a>
      </div>
      <div class="col-md-4">
        <?php if ($p['imagen']!== null): ?>
          <img class="w-50 rounded" src="<?= base_url().'uploads/peliculas/'.$p['imagen']?>">
        <?php endif ?>
        <?php if ($p['imagen']=== null): ?>
          <img class="w-50 rounded" src="<?= base_url().'uploads/peliculas/no_image.jpg'?>">
        <?php endif ?>
      </div>
    </div>
<?php endforeach?>    
</div>
<?= $pager->links() ?>