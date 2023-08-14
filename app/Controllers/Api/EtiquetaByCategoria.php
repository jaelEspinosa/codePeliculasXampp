<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class EtiquetaByCategoria extends ResourceController {

    protected $modelName = 'App\Models\EtiquetaModel';
    protected $format = 'json';



   
     public function show($id = null) 
    
     {
        if($id!== null){

           $filteredData = $this->model->where('categoria_id', $id)->findAll();
           return $this->respond($filteredData); 
        }else{
           return $this->respond($this->model->findAll());
        }
     }

}
    
      



    
