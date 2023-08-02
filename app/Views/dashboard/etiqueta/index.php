<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('contenido') ?>


<h2>Listado de etiquetas</h2>
<?php if ($user) : ?>
    <h2>User: <?= $user['username'] ?></h2>
<?php endif ?>

<p><?php echo $nombreVariableVista ?></p>

<a class="btn btn-primary mx-3 my-4" href="<?=base_url()?>dashboard/etiqueta/new"><i class="fa fa-add"></i></a><span class="span">Nueva etiqueta</span>
<div class="border rounded shadow">

    <table class="table table-striped-columns">
        <tr>
            <th>Id</th>
            <th>Titulo</th>

            <th>Categoria</th>
            <th>Opciones</th>
        </tr>
        <?php foreach ($etiquetas as $key => $value) : ?>
            <tr>
                <td><?= $value['id'] ?></td>
                <td><?= $value['titulo'] ?></td>

                <td><?php
                    foreach ($categorias as $key => $c) {
                        if ($c['id'] == $value['categoria_id']) {
                            echo ($c['titulo']);
                        }
                    }

                    ?></td>
                <td class="d-flex align-items-center justify-content-around">
                    <a class="btn btn-sm btn-success" href="<?=base_url()?>dashboard/etiqueta/show/<?= $value['id'] ?>"><i class="fa fa-eye"></i></a>
                    <a class="btn btn-sm btn-primary" href="<?=base_url()?>dashboard/etiqueta/edit/<?= $value['id'] ?>"><i class="fa fa-edit"></i></a>


                    <form action="<?=base_url()?>dashboard/etiqueta/delete/<?= $value['id'] ?>" method="post">
                        <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</div>

<?= $pager->links() ?>


<?= $this->endSection() ?>