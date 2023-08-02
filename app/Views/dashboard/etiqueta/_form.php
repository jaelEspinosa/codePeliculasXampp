


        
    <div class="form-group col-md-4">
        <label for="titulo">Título  </label>
            <input class="form-control <?= session('validation') && session('validation')->hasError('titulo') ? 'is-invalid' : ''; ?>" 
                    type="text" placeholder="titulo" id="titulo" name="titulo" value="<?=old('titulo',$etiqueta['titulo'])?> ">      
    </div>

    <div class="form-group col-md-4">
        <label for="categoria_id">Categoria</label>
        <select class="form-control <?= session('validation') && session('validation')->hasError('categoria_id') ? 'is-invalid' : ''; ?>"
                name="categoria_id" id="categoria_id" 
                class="form-control" 
                value="<?=old('categoria_id',$etiqueta['categoria_id'])?> ">
             <option value="">selccione una categoria</option>
         <?php foreach ($categorias as $c): ?>
            <option value="<?=$c['id']?>" <?php echo ($c['id'] == $etiqueta['categoria_id']) ? 'selected' : ''?> ><?= $c['titulo']?> </option>
            
        <?php endforeach ?>  
        </select>
    </div>

   
    
    <div class="col-md-6 row mx-1 mt-4">
        <button class="btn btn-primary col-4"><?= $oc ?></button>
        <div class="col-4"></div>
        <a href="<?php echo base_url().'dashboard/etiqueta'?>" class="btn btn-primary col-4">volver</a>

    </div>

    
