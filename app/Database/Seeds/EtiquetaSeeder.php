<?php

namespace App\Database\Seeds;

use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use CodeIgniter\Database\Seeder;

class EtiquetaSeeder extends Seeder
{ public function run()
    {
        
          // $this->db->table('categorias');

          // $peliculaModel = new PeliculaModel();  // esto es para borrar la semilla que haya en la db

          $etiquetaModel = new EtiquetaModel();
          $categoriaModel = new CategoriaModel();
          
          $categorias = $categoriaModel->limit(5)->findAll();

          $etiquetaModel->where('id>=', 1)->delete; // esto es para borrar la semilla que haya en la db
          
                      foreach ($categorias as $c) {
                        
                        
                        for ($i=0; $i < 20; $i++) { 
                          
                          
                          $etiquetaModel->insert(
                            [
                              'titulo' => "tag - $i -".$c['titulo'],
                              'categoria_id' => $c['id'],
                              
                              ]
                            );
                          }
                        }
    
        }
}
