<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('contenido') ?>

   <h2 class="text-center">Etiquetas</h2>

  <form class="row border mt-5 m-2 p-5 shadow rounded"  method="post">
        
    <div class="form-group col-md-4">
        <label for="titulo">Título  </label>
            <input disabled class="form-control <?= session('validation') && session('validation')->hasError('titulo') ? 'is-invalid' : ''; ?>" 
                    type="text" placeholder="titulo" id="titulo" name="titulo" value="<?=old('titulo',$pelicula['titulo'])?> ">      
    </div>

    <div class="form-group col-md-4">
        <label for="categoria_id">Categorias</label>
        <select class="form-control"
                name="categoria_id" id="categoria_id" 
                class="form-control">
             <option value="">selccione una categoria</option>
         <?php foreach ($categorias as $c): ?>
            <option value="<?=$c['id']?>" <?php echo $c['id'] == $categoria_id ? 'selected' : ''?> ><?= $c['titulo']?> </option>
            
        <?php endforeach ?>  
        </select>
    </div>

    <div class="form-group col-md-4">
        <label for="etiqueta_id">Etiqueta</label>
        <select <?= !$etiquetas ? 'disabled':'' ?> class="form-control <?= session('validation') && session('validation')->hasError('etiqueta_id') ? 'is-invalid' : ''; ?>"
                name="etiqueta_id" id="etiqueta_id" 
                class="form-control" 
                >
             <option value="">selccione una etiqueta</option>
         <?php foreach ($etiquetas as $e): ?>
            <option  value="<?= $e['id']?>"><?= $e['titulo']?> </option>
            
        <?php endforeach ?>  
        </select>
    </div>

   
    
    <div class="col-md-6 row mx-1 mt-5">
        <button <?= !$etiquetas ? 'disabled':'' ?> class="btn btn-primary col-4" id="send">Enviar</button>
        <div class="col-4"></div>
        <a href="<?php echo base_url().'dashboard/pelicula'?>" class="btn btn-primary col-4">volver</a>

    </div>

    </form> 

    <script>

        function toggleButton(){
            if(document.querySelector('#etiqueta_id').value == '' ){ 
                document.querySelector('#send').setAttribute('disabled','disabled')
            }else{
                document.querySelector('#send').removeAttribute('disabled')
                } 
        }                

        document.querySelector('#categoria_id').onchange = function(e) {
            window.location.href = '<?= base_url(route_to('pelicula.etiquetas', $pelicula['id']))?>?categoria_id='+e.target.value
        }


        document.querySelector('#etiqueta_id').onchange = function() {
            toggleButton()
        }

       toggleButton()

    </script>
   



    <?= $this->endSection() ?>

   