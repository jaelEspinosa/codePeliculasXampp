<?php

namespace App\Controllers\Api;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class User extends ResourceController {

    protected $modelName = 'App\Models\UserModel';
    protected $format = 'json';



    public function login() 

    
     {
         $userName = $this->request->getPost('username');
         $password = $this->request->getPost('password');

         if ($password === null) {
            $password = '0';
        }

         // cargamos el model
         $userDb = new UserModel();

         // buscamos al user para ver si existe en la db
         $user = $userDb->where('username', $userName)->first();
          
  
        //verificamos que existe y el password

        if($user && $userDb->passVerify($password, $user['password'])){
            
            session()->set('user_id', $user['id']);
            session()->set('username', $user['username']);
            session()->set('type', $user['type']);

            return $this->respond(['msg'   => 'Inicio de sesión correcto.',
                                   'user'  => $user['username'],
                                   'email' => $user['email'] 
                                ], 200);
        }else{
            return $this->respond(['msg' => 'Usuario o Password inválido'], 401);
        };

     }
    

     public function register() 

    
     {
         $userName = $this->request->getPost('username');
         $email = $this->request->getPost('email');
         $password = $this->request->getPost('password');

         // nos aseguramos que password no es null
         if ($password === null){
            $password = '0';
         }

         $userDb = new UserModel();

         $userDb->groupStart();
         $userDb->where('email',$email);
         $userDb->orWhere('username', $userName);
         $userDb->groupEnd();
         
         $count = $userDb->countAllResults();

        if($this->validate('users')){

        if($count > 0){
            return $this->respond(['msg'=>'Este email y/o usuario ya está en registrado.'], 400);
        } 

       
       
           $newUser = $this->model->insert([
              'username' => $userName,
              'email'    => $email,
              'password' => $userDb->passwordHash($password)
           ]);
        }else{
            return $this->respond($this->validator->getErrors(), 400);
        }

        $data = [
            'msg' => 'Usuario registrado con éxito',
            'data'=> $this->model->find($newUser)
        ];

        return $this->respond($data, 200);   
     }
    
    }