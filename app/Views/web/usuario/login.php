

<?= $this->extend('Layouts/web') ?>
<?= $this->section('contenido') ?>

<div class="container">
    <div class="border rounded shadow p-5 m-auto mt-5">
    <h2 class="text-center mb-5">LOGIN</h2>
  <form  class="row" action="<?= base_url(route_to('usuario.login_post'))?>" method="post">
  <div class="col-md-4"></div>
  <div class="form-group col-md-4">
     <label  class="my-3" for="email">Usuario o email</label>
    <input class="form-control" type="text"
           id="email" name="email" 
           placeholder="usuario o Email">
  </div>
  <div class="col-md-4"></div>
  <div class="col-md-4"></div>
  <div class="form-group col-md-4">
     <label class="my-3" for="password">Password</label>
    <input class="form-control" type="password" 
           id="password" name="password" 
           placeholder="Password">
  </div>
  <div class="col-md-4"></div>

  <div class="row col-md-12 mt-5">
       <div class="col-4"></div>
       <input type="submit" class="btn btn-primary col-4" value='Login'>
       <div class="col-4"></div>

  </div>

  </form>
  </form>
  <a href="<?= base_url().'register'?>">¿No tienes cuenta?, Registrate aqui</a>
</div>
</div>

<?= $this->endSection() ?>