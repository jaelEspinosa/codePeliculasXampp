


        
    <div class="form-group col-md-6">
        <label for="titulo">Título  </label>
            <input class="form-control <?= session('validation') && session('validation')->hasError('titulo') ? 'is-invalid' : ''; ?>"
                   type="text" placeholder="titulo" 
                   id="titulo" name="titulo" 
                   value="<?= old('titulo', $categoria['titulo']);?> ">
      
    </div>
   
    
    <div class="col-md-6 row mx-1 mt-2">
    <button class="btn btn-primary col-4"><?= $oc ?></button>
        <div class="col-4"></div>
        <a href="<?php echo base_url().'dashboard/categoria'?>" class="btn btn-primary col-4">volver</a>
    </div>

    
