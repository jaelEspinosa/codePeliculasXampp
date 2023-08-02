


<div class="row">
        
    <div class="form-group col-md-4">
    
          <label for="titulo">Título  </label>
              <input class="form-control <?= session('validation') && session('validation')->hasError('titulo') ? 'is-invalid' : ''; ?>" 
                      type="text" placeholder="titulo" id="titulo" name="titulo" value="<?=old('titulo',$pelicula['titulo'])?> ">      
      </div>
  
      <div class="form-group col-md-4">
          <label for="categoria_id">Categoria</label>
          <select class="form-control <?= session('validation') && session('validation')->hasError('categoria_id') ? 'is-invalid' : ''; ?>"
                  name="categoria_id" id="categoria_id" 
                  class="form-control" 
                  value="<?=old('categoria_id',$pelicula['categoria_id'])?> ">
               <option value="">selccione una categoria</option>
           <?php foreach ($categorias as $c): ?>
              <option value="<?=$c['id']?>" <?php echo ($c['id'] == $pelicula['categoria_id']) ? 'selected' : ''?> ><?= $c['titulo']?> </option>
              
          <?php endforeach ?>  
          </select>
      </div>
  
      <div class="form-group col-md-4">
          <label for="description">Descripción </label>
              <textarea class="form-control <?= session('validation') && session('validation')->hasError('description') ? 'is-invalid' : '';?>"  
              placeholder="Descripción" 
              id="description" 
              name="description"><?=old('description',$pelicula['description'])?></textarea>       
      </div>
  
      <?php if($pelicula['id']): ?>
      <div class="form-group col-md-4">
          <label for="imagen">Imagen</label>
              <input class="form-control" type="file" name="imagen">     
      </div>
      <?php endif ?>
    </div>  

   
    <div class="col-md-6 row mx-1 my-5">
        <button class="btn btn-primary col-4"><?= $oc ?></button>
        <div class="col-4"></div>
        <a href="<?php echo base_url().'dashboard/pelicula'?>" class="btn btn-primary col-4">volver</a>

    </div>

    
