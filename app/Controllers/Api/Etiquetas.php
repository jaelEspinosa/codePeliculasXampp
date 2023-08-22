<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Etiquetas extends ResourceController {

    protected $modelName = 'App\Models\EtiquetaModel';
    protected $format = 'json';

public function index() 
    
    {
       
          return $this->respond($this->model->findAll());
      
    }

   
public function show($id = null) 
    
     {
        if($id!== null){

           $filteredData = $this->model->find($id);
           return $this->respond($filteredData); 
        }else{
           return $this->respond($this->model->findAll());
        }
     }


public function create()
    
     {
        if ($this->validate('etiquetas')){
      
           $id = $this->model-> insert([
              'titulo' => $this->request->getPost('titulo'),
              'categoria_id' => $this->request->getPost('categoria_id')
            ]);

        }else{
            return $this->respond($this->validator->getErrors(), 400);
            
        }

        $data = ['mensaje' => 'Etiqueta añadida con éxito', 'etiqueta' => $this->model->find($id)];
        return $this->respond($data, 200);
     
    }
public function update($id = null) 
  
    {
      if ($this->validate('etiquetas')){
       $this->model->update($id,[
          'titulo' => $this->request->getRawInput()['titulo'],
          'categoria_id' => $this->request->getRawInput()['categoria_id'],
        ]);
      }else{
          return $this->respond($this->validator->getErrors(), 400);
      }
   return $this->respond(['Mensaje'=>'Etiqueta actualizada','etiqueta'=>$this->model->find($id)], 200);
    }

public function delete($id = null) 
  
  {
   $this->model->delete($id); 
   return $this->respond(['msg' => 'Registro eliminado..']);
  } 
}
    
      



    
