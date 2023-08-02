<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
      // $categoriaModel = new CategoriaModel();  // esto es para borrar la semilla que haya en la db

       // $categoriaModel->where('id>=', 1)->delete // esto es para borrar la semilla que haya en la db

      for ($i=0; $i < 20; $i++) { 
        
          $this->db->table('categorias')->insert(
           [
             'titulo' => "categoria $i"
           ]
           );
      }

    }
}
