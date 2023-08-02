
<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('contenido') ?>
<div class="container">
    <h2 class="text-center">Nueva Categoria</h2>

    <form class="row border mt-5 m-2 p-5 shadow rounded" action="<?=base_url()?>dashboard/categoria/create" method="post">

        <?= view('dashboard/categoria/_form', ['oc' => 'Crear']) ?>
        <?php if (session('validation')) : ?>
            <div class="validator">
                <?= view('partials/_form-error') ?>
            </div>
        <?php endif ?>
    </form>
</div>
<?= $this->endSection() ?>


