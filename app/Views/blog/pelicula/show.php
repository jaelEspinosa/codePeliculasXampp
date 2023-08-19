

<?= $this->extend('Layouts/blog') ?>
<?= $this->section('contenido') ?>


    
<div class="d-flex align-items-center justify-content-between ">
    
        <h1><?= $pelicula['titulo'] ?></h1>
        <a href="<?php echo base_url().'blog/pelicula'?>" class="btn btn-primary">volver</a>
    </div>
   
    <p><?= $pelicula['description'] ?></p>
    <a <a href="<?=base_url(route_to('blog.peliculas.categoria', $pelicula['categoria_id']))?>"class="btn btn-sm btn-primary" ><?=$pelicula['categoria']?></a>
    
    
    <br>
    <div style="height: calc(100vh - 450px);" class="row border tscroll rounded shadow mt-2">
    <?php if(empty($images))  :?>
                <div class="text-center" style="width: 12rem">                    
                    <img style="width:250px;" class="card-img-top" src="<?=base_url()?>uploads/peliculas/no_image.jpg" >  
                </div> 
    <?php endif  ?>
        <?php foreach ($images as $i):?>         
            <div class="col-2 d-flex align-items-center justify-content-start p-3">                
                <div class="text-center " style="width: 12rem">                    
                    <img class="card-img-top" src="<?=base_url()?>uploads/peliculas/<?= $i['imagen']?>" alt="<?=$i['extension']?>">  
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