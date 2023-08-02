
<?= $this->extend('Layouts/web') ?>
<?= $this->section('contenido') ?>

<div class="container">
    <div class="border rounded shadow p-5 m-auto mt-5">
    <h2 class="text-center mb-5 text-primary">NUEVO USUARIO</h2>




<form  class="row" action="<?= base_url(route_to('usuario.register_post'))?>" method="post">

<div class="col-md-4"></div>
  <div class="form-group col-md-4">
     <label  class="my-3" for="username">Nombre</label>
    <input class="form-control <?= session('validation') && session('validation')->hasError('username') ? 'is-invalid' : ''; ?>" 
           type="text"
           id="username" name="username" 
           placeholder="Nombre"
           value= "<?=old('username',$user['username'])?>"
           >
           <?= session('validation') && session('validation')->hasError('username') ? "<span style='color:red;'>*Campo requerido</span>" : ''; ?>
  </div>
  <div class="col-md-4"></div>


  <div class="col-md-4"></div>
  <div class="form-group col-md-4">
     <label  class="my-3" for="email">email</label>
    <input class="form-control <?= session('validation') && session('validation')->hasError('email') ? 'is-invalid' : ''; ?>" 
           type="text"
           id="email" name="email" 
           placeholder="Email"
           value= "<?=old('email',$user['email'])?>"
           >
    <?= session('validation') && session('validation')->hasError('email') ? "<span style='color:red;'>*Formato de email no válido</span>" : ''; ?>
  </div>
  <div class="col-md-4"></div>

  <div class="col-md-4"></div>
  <div class="form-group col-md-4">
     <label class="my-3" for="password">Password</label>
    <input class="form-control <?= session('validation') && session('validation')->hasError('password') ? 'is-invalid' : ''; ?>"
           type="password" 
           id="password" name="password" 
           placeholder="Password"
           value= "<?=old('password',$user['password'])?>"
           >
    <?= session('validation') && session('validation')->hasError('password') ? "<span style='color:red;'>*Campo requerido</span>" : ''; ?>
  </div>
  <div class="col-md-4"></div>

  <div class="col-md-4"></div>
  <div class="form-group col-md-4">
     <label class="my-3" for="password2">Confirmar Password</label>
    <input type="password" 
           class="form-control <?= session('validation') && (session('validation')->hasError('password') || session('validation')->hasError('password2') )? 'is-invalid' : ''; ?>"
           id="password2" name="password2" 
           placeholder="Corfirme Password">
           <?= session('validation') && session('validation')->hasError('password') ? "<span style='color:red;'>*Campo requerido</span>" : ''; ?>       
           <?= session('validation') && session('validation')->hasError('password2') ? "<span style='color:red;'>*Contraseñas no coinciden</span>" : ''; ?>       
  </div>
  <div class="col-md-4"></div>

  <div class="row col-md-12 mt-5">
       <div class="col-4"></div>
       <input type="submit" class="btn btn-primary col-4" value='Login'>
       <div class="col-4"></div>

  </div>

  

  </form>
  <a href="<?= base_url().'login'?>">¿Ya tienes cuenta?</a>
</div>
</div>


<?= $this->endSection() ?>