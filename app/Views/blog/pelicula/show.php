





<?= $this->extend('Layouts/blog') ?>
<?= $this->section('contenido') ?>


    
<div class="d-flex align-items-center justify-content-between ">
        <h1><?= $pelicula['titulo'] ?></h1>
        <a href="<?php echo base_url().'blog/pelicula'?>" class="btn  btn-primary">volver</a>
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
            
                </div>   
            </div>
        
        
         
        <?php endforeach ?>    
    </div>
    <h3>Etiquetas: </h3>
    <br>
       <div class="d-flex align-items-center justify-start gap-3">

           <?php foreach ($etiquetas as $e):?>
              
            <button type="button" class="btn btn-sm btn-outline-primary">
                <?= $e['id'].' '?> - <?= $e['titulo'].' '?>,
                  
           </button>
         
           <?php endforeach ?>  
            
       </div>
   



<?= $this->endSection() ?>