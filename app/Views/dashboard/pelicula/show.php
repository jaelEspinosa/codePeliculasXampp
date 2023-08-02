




<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('contenido') ?>


    
<div class="d-flex align-items-center justify-content-between ">
        <h1><?= $pelicula['titulo'] ?></h1>
        <a href="<?php echo base_url().'dashboard/pelicula'?>" class="btn  btn-primary">volver</a>
    </div>

    <p><?= $pelicula['description'] ?></p>
    <h3>Galería:</h3>
    <br>
    <div class="tscroll shadow border rounded row">
        <?php foreach ($images as $i):?>
         
            <div class="col-4 d-flex align-items-center justify-content-center p-3">
                
                <div class="card text-center" style="width: 12rem">
                    
                    <img class="card-img-top" src="<?=base_url()?>uploads/peliculas/<?= $i['imagen']?>" alt="<?=$i['extension']?>">  
                    <p class="card-title"><?= $i['extension'].' '?></p> 
                   
                
               
                
                </p> 
                   
                        
                        
                        <form class="p-2" action="<?= base_url(route_to('pelicula.imagen_delete', $i['id'] ))?>" method="post">
                            <button type="submit" class="btn btn-sm btn-outline-danger">Borrar</button>
                            <a href="<?= base_url(route_to('pelicula.imagen_download', $i['id']))?>" class="btn btn-sm btn-outline-success">Download</a>
                        </form>
                        
                        
                    
       
                </div>   
            </div>
        
        
         
        <?php endforeach ?>    
    </div>
    <h3>Etiquetas: </h3>
    <br>
       <div class="d-flex align-items-center justify-start gap-3">

           <?php foreach ($etiquetas as $e):?>
              <form action="<?= base_url(route_to('pelicula.etiqueta_delete', $pelicula['id'], $e['id']))?>" method="post">
            <button type="submit" class="btn btn-sm btn-outline-primary">
                <?= $e['id'].' '?> - <?= $e['titulo'].' '?>,
                  
           </button>
           </form>
           <?php endforeach ?>  
            
       </div>
   



<?= $this->endSection() ?>