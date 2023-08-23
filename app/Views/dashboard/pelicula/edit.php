

<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('contenido') ?>

    <h4 class="text-center">Actualizar Pelicula</h4>

    <form enctype="multipart/form-data" class="row border mt-5 m-2 p-5 shadow rounded" action="<?=base_url()?>dashboard/pelicula/update/<?= $pelicula['id'] ?>" method="post">

        <?= view('dashboard/pelicula/_form', ['oc' => 'Actualizar']) ?>
        <?php if (session('validation')) : ?>
            <div class="validator">
                <?= view('partials/_form-error') ?>
            </div>
        <?php endif ?>
    </form>



<?= $this->endSection() ?>