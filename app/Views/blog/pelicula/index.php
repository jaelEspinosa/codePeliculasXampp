
<?=$this->extend('Layouts/blog')?>
<?= $this->section('contenido') ?>
<form method='get' class="my-2 bg-secondary p-3 rounded">
        <div class="card-body">

            <div class="d-flex gap-2 mb-2">
                <select class="form-control w-50" id="categoria_id" name="categoria_id" id="">
                    <option value= "">Buscar por Categoria</option>
                    <?php foreach ($categorias as $c):?>
                       <option <?= $c['id']==$categoria_id ? 'selected' : '' ?> value= "<?=$c['id']?>"><?=$c['titulo']?></option>
                    <?php  endforeach ?>
                </select>
                <select <?= $categoria_id !== null ? '' : 'disabled'  ?>  class="<?= $categoria_id !== null ? '' : 'bg-secondary'  ?> form-control   w-50" id="etiqueta_id" name="etiqueta_id" id=""> 
                <?php foreach ($etiquetas as $e):?> 
                    <option <?= $e['id']==$etiqueta_id ? 'selected' : '' ?> value= "<?=$c['id']?>"><?= $e['titulo']?></option>
                <?php  endforeach ?>    
                </select>
            </div>
        <div class="d-flex gap-2">
            <input class="form-control" type="text" name="buscar" placeholder="buscar" value = "<?=$buscar?>">
            <input class="btn btn-light" type="submit" value="Filtrar">
            <a style = "width:150px;" href="<?= base_url(route_to('blog.pelicula.index'))?>" class="btn btn-success" >Limpiar filtro</a>
        </div>        
    </div>
</form>

<?= view('partials/_peliculas') ?>


<script>

const $etiquetas = document.querySelector('#etiqueta_id')

document.querySelector('#categoria_id').addEventListener('change', ()=>{
  

   const url = '<?=base_url().'/api/etiquetas_por_categoria/'?>'+ document.querySelector('#categoria_id').value
   
   fetch(url)
   .then(res => res.json())
   .then(res => {
        let etiquetas = `<option value="">Buscar por Etiqueta</option>`
        res.forEach(e=> {
            etiquetas += `
                  <option value="${e.id}">${e.titulo}</option>
            `
        })
    $etiquetas.classList.remove('bg-secondary')  
    $etiquetas.removeAttribute('disabled')
    $etiquetas.innerHTML = etiquetas
   })
})
</script>

<?= $this->endSection() ?>