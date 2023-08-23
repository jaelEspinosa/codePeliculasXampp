
<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('contenido') ?>
  
<div class="d-flex align-items-center justify-content-between ">
        <h4><?= $pelicula['titulo'] ?></h4>
        <a href="<?php echo base_url().'dashboard/pelicula'?>" class="btn  btn-primary">volver</a>
    </div>
    <p><?= $pelicula['description'] ?></p>
    <h6 style="margin-bottom:0;" >Galería:</h6>
    <br>
    <div style="
            max-height: calc(100vh - 350px);
            overflow-y: scroll;
            " 
         class="shadow border rounded row">
        <?php if (empty($images)):?>           
              <img  style='width:150px;' class="card-img-top" src="<?=base_url()?>uploads/peliculas/no_image.jpg" alt="no_image"> 
        <?php else:  ?>
        <?php foreach ($images as $i):?>         
            <div class="col-12 col-sm-6 col-md-3 d-flex align-items-center justify-content-center p-3">                
                <div class="text-center" style="width: 12rem">                    
                    <img style='width:115px;' class="rounded" src="<?=base_url()?>uploads/peliculas/<?= $i['imagen']?>" alt="<?=$i['extension']?>">  
                      
                </p> 
                     <form class="p-2" action="<?= base_url(route_to('pelicula.imagen_delete', $i['id'] ))?>" method="post">
                            <button type="submit" title="Borrar imagen" class="btn btn-sm btn-outline-danger">Borrar</button>
                            <a title="Descargar Imagen" href="<?= base_url(route_to('pelicula.imagen_download', $i['id']))?>" class="btn btn-sm btn-outline-success">Download</a>
                        </form>
                </div>   
            </div>        
        <?php endforeach ?>  
        <?php endif;?>

    </div>

    <br>
       <div class="d-flex align-items-center justify-start gap-3 mb-4">

           <?php foreach ($etiquetas as $e):?>
              <form action="<?= base_url(route_to('pelicula.etiqueta_delete', $pelicula['id'], $e['id']))?>" method="post">
            <button type="submit" class="btn btn-sm btn-outline-primary" title="Borrar Etiqueta">
                <?= $e['id'].' '?> - <?= $e['titulo'].' '?>,                  
           </button>
           </form>
           <?php endforeach ?>    

       </div> 
<?= $this->endSection() ?>