<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    
   public function login()
   {
    echo view('web/usuario/login');
   }

   public function register()
   
   {
      $user = ['username'=> '', 'email'=>'', 'password'=>'', 'password2'=>''];
      echo view('web/usuario/register',['user' => $user]);
   }

   public function login_post()

   {
      //Cargamos el modelo
    $userDb = new UserModel();

    $email = $this->request->getPost('email'); // valido para userName o email
    $password = $this->request->getPost('password'); 
     
    //Buscamos el usuario en la Db
    $user = $userDb->select('id, username, email, password, type')
                      ->orWhere('username', $email)
                      ->orWhere('email', $email)
                      ->first();
    
    //Verificamos que el usuario existe.
      if(!$user){
         return redirect()->back()->with('Mensaje', 'Usuario y/o Contraseña no válidos');
      };    
       
    //Comprobamos el password.
      if($userDb->passVerify($password, $user['password'])){
       //  $session = session();
         unset($user['password']);
        // $session->set($user);
        session()->set('user_id', $user['id']);
        session()->set('username', $user['username']);
        session()->set('type', $user['type']);

         // login ok redireccionamos al dashboard

         if($user['type']=='admin'){
           return redirect()->to('dashboard/pelicula')->with('mensaje','Bienvenid@, '.$user['username'])->with('user', $user['username']);
          }
          
          return redirect()->to('blog/pelicula')->with('mensaje','Bienvenid@, '.$user['username'])->with('user', $user['username']);
      }
         //contraseña fallida
        return redirect()->back()->with('Mensaje', 'usuario y/o contraseña no válidos');
        
      }
   
      public function register_post()

   {
      //Cargamos el modelo
    $userDb = new UserModel();
    $userName = $this->request->getPost('username');
    $email = $this->request->getPost('email'); 
    $password = $this->request->getPost('password'); 
    $password2 = $this->request->getPost('password2'); 

    
   //Buscamos el usuario en la Db
   $user = $userDb->select('id, username, email, password, type')
                  ->orWhere('username', $userName)
                  ->orWhere('email', $email)
                  ->first();

    //Verificamos que el usuario existe. si es asi mensaje de error
      if($user){
         return redirect()->back()->with('Mensaje', 'Nombre de usuario y/o correo no disponibles');
      };   

    //insertamos en la base de datos

    if($this->validate('users')){
     $userDb->insert([
         'username' => $userName,
         'email'    => $email,
         'password' => $userDb->passwordHash($password)
      ]);

    //buscamos el registro que acabo de insertar y establezco sesion
      $user = $userDb->select('id, username, email, password, type')
      ->orWhere('username', $userName)
      ->orWhere('email', $email)
      ->first();

      //$session = session();
      unset($user['password']);
      session()->set('user_id', $user['id']);
      session()->set('username', $user['username']);
      session()->set('type', $user['type']);
      if($user['type']=='admin'){
        return redirect()->to('dashboard/pelicula')->with('mensaje','Bienvenid@, '.$user['username'])->with('user', $user['username']);
       }
       
       return redirect()->to('blog/pelicula')->with('mensaje','Bienvenid@, '.$user['username'])->with('user', $user['username']); 
    }
      session()->setFlashdata([
         'validation' => $this->validator
       ]);
       return redirect()->back()->withInput(); 
        
  }
  
public function logout()
{
   session()->destroy();
  return  redirect()->to(route_to('usuario.login'));
}

}
