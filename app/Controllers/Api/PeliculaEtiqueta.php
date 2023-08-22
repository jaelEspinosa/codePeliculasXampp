<?php

namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;



class PeliculaEtiqueta extends ResourceController {

    protected $modelName = 'App\Models\PeliculaEtiquetaModel';
   
    protected $format = 'json';






 public function etiqueta_delete($id=null, $etiquetaId=null)
 {
    
 
    $this->model->where('etiqueta_id', $etiquetaId)
                ->where('pelicula_id', $id)
                ->delete();
                     if ($this->model->affectedRows() == 1) {
                      return $this->respond(['mensaje'=>'Etiqueta eliminada']);
                  } else {
                    // Obtén información sobre el error
                      $dbError = $this->model->error();
                      // Si no se eliminó ninguna fila, puedes devolver un mensaje de error.
                      return $this->respond(['mensaje'=>'etiqueta NO borrada','etiqueta' => $etiquetaId, 'pelicula'=>$id, 'error'=>$dbError],400);
                  }           
 }

 
  
}
    
      



    
