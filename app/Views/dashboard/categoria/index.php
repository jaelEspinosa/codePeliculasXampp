<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('contenido') ?>
<div class="container">
    <h5>Listado de categorias</h5>
    <p><?php echo $nombreVariableVista ?></p>

    <a class="btn btn-primary mx-3 mb-2" href="<?=base_url()?>dashboard/categoria/new"><i class="fa fa-add"></i></a><span class="span">Nueva categoria</span>
    <div class="border roundez shadow">
        <table class="table table-striped-columns">
            <tr>
                <th>id</th>
                <th>titulo</th>
                <th>Opciones</th>
            </tr>
            <?php foreach ($categorias as $key => $value) : ?>

                <tr>
                    <td><?= $value['id'] ?></td>
                    <td><?= $value['titulo'] ?></td>
                    <td class="d-flex align-items-center justify-content-around">
                        <a class="btn btn-sm btn-primary" href="<?=base_url()?>dashboard/categoria/edit/<?= $value['id'] ?>"><i class="fa fa-edit"></i></a>

                        <form action="<?=base_url()?>dashboard/categoria/delete/<?= $value['id'] ?>" method="post">
                            <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>

            <?php endforeach ?>
        </table>
    </div>

    <?= $pager->links() ?>

</div>

<?= $this->endSection() ?>