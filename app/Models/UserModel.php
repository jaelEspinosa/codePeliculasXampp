<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{  
    protected $table            = 'users';   
    protected $primaryKey       = 'id';   
    protected $allowedFields    = ['username','email','password'];   
   // protected $returnType       = 'object';


   public function passwordHash($password)
   
    {    
        return password_hash($password, PASSWORD_DEFAULT); 
    }
    

  public function passVerify($password, $hasPassword)

    {
        return password_verify($password, $hasPassword);
    } 

}