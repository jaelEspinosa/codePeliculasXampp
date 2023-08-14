
<?=$this->extend('Layouts/blog')?>
<?= $this->section('contenido') ?>
<form method='get' class="my-2 bg-secondary p-3 rounded">
        <div class="card-body">

            <div class="d-flex gap-2 mb-2">
                <select class="form-control w-50" id="categoria_id" name="categoria_id" id="">
                    <option value= "">Buscar por Categoria</option>
                    <?php foreach ($categorias as $c):?>
                    <option value= "<?=$c['id']?>"><?=$c['titulo']?></option>
                    <?php  endforeach ?>
                </select>
                <select disabled class="bg-secondary form-control w-50" id="etiqueta_id" name="etiqueta_id" id="">   
                </select>
            </div>
        <div class="d-flex gap-2">
            <input class="form-control" type="text" name="buscar" placeholder="buscar">
            <input class="btn btn-light" type="submit" value="Enviar">
        </div>        
    </div>
</form>


<div style="width:100%; 
            height:calc(100vh - 380px); 
            overflow-y: scroll; " 
    class="border shadow p-2">


<?php foreach ($peliculas as $p) :?>
    <div class="border rounded mb-3 p-2">
        <div class="card-body">
        <div class="card-title">
            <h4><?=$p['titulo']?></h4>
            <h6><?=$p['categoria']?></h6>
        </div>
        <p class="card-text"><?=$p['description']?></p>
        </div>
        <a href="<?=base_url().'blog/pelicula/show/'. $p['id']?>" class="btn btn-sm btn-outline-secondary">Ver</a>
    </div>
<?php endforeach?>    
</div>
<?= $pager->links() ?>


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