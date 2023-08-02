



<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('contenido') ?>

   <h2 class="text-center">Nueva Pelicula</h2>

    <form  class="row border mt-5 m-2 p-5 shadow rounded" action="<?=base_url()?>dashboard/pelicula/create" method="post">
        
         <?= view('dashboard/pelicula/_form', ['oc' => 'Crear']) ?>
         <?php if (session('validation')) : ?>
            <div class="validator">
                <?= view('partials/_form-error') ?>
            </div>
        <?php endif ?>
    </form>
 


<?= $this->endSection() ?>