<?php

namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;

use App\Models\PeliculaEtiquetaModel;
use App\Models\ImagenModel;
use App\Models\PeliculaImagenModel;

class Pelicula extends ResourceController {

    protected $modelName = 'App\Models\PeliculaModel';
   
    protected $format = 'json';

public function index()     
     {
        
        return $this->respond($this->model->findAll());    
     }

public function paginado()     
     {
        
        return $this->respond($this->model->paginate(5));    
     }   
public function paginado_full()     
     {
      
      $peliculas = $this->model
                            ->when($this->request->getGet('buscar'), static function ($query, $buscar) {
                              $query->groupStart()->orLike('peliculas.titulo', $buscar, 'both');
                              $query->orLike('peliculas.descripcion', $buscar, 'both')->groupEnd();
                            })
                            ->when($this->request->getGet('categoria_id'), static function ($query, $categoriaId) {
                                $query->where('peliculas.categoria_id', $categoriaId);
                            })
                            ->when($this->request->getGet('etiqueta_id'), static function ($query, $etiquetaId) {
                              $query->where('etiquetas.id', $etiquetaId);
                            })
                            ->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(DISTINCT(etiquetas.titulo)) as etiquetas, MAX(imagenes.imagen) as imagen')
                            ->join('categorias','categorias.id = peliculas.categoria_id')
                            ->join('pelicula_etiqueta','pelicula_etiqueta.pelicula_id = peliculas.id','left')
                            ->join('etiquetas','etiquetas.id = pelicula_etiqueta.etiqueta_id','left')
                            ->join('pelicula_imagen','pelicula_imagen.pelicula_id = peliculas.id','left')
                            ->join('imagenes','imagenes.id = pelicula_imagen.imagen_id','left');


     
        $peliculas = $this->model->groupBy('peliculas.id')->paginate(5);

        return $this->respond($peliculas);    
     }          


public function index_por_categoria($categoriaId)     
     {
      $peliculas = $this->model
                ->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(DISTINCT(etiquetas.titulo)) as etiquetas, MAX(imagenes.imagen) as imagen')
                ->join('categorias','categorias.id = peliculas.categoria_id')
                ->join('pelicula_etiqueta','pelicula_etiqueta.pelicula_id = peliculas.id','left')
                ->join('etiquetas','etiquetas.id = pelicula_etiqueta.etiqueta_id','left')
                ->join('pelicula_imagen','pelicula_imagen.pelicula_id = peliculas.id','left')
                ->join('imagenes','imagenes.id = pelicula_imagen.imagen_id','left')
                ->where('peliculas.categoria_id', $categoriaId)
                ->groupBy('peliculas.id')
                ->paginate(5);

        return $this->respond($peliculas);    
     }

public function index_por_etiqueta($etiquetaId)     
     {
      $peliculas = $this->model
                ->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(DISTINCT(etiquetas.titulo)) as etiquetas, MAX(imagenes.imagen) as imagen')
                ->join('categorias','categorias.id = peliculas.categoria_id')
                ->join('pelicula_etiqueta','pelicula_etiqueta.pelicula_id = peliculas.id','left')
                ->join('etiquetas','etiquetas.id = pelicula_etiqueta.etiqueta_id','left')
                ->join('pelicula_imagen','pelicula_imagen.pelicula_id = peliculas.id','left')
                ->join('imagenes','imagenes.id = pelicula_imagen.imagen_id','left')
                ->where('etiquetas.id', $etiquetaId)
                ->groupBy('peliculas.id')
                ->paginate(5);

        return $this->respond($peliculas);    
     }     
public function show($id = null) 
    
     {

       $pelicula = $this->model->select('peliculas.* ,categorias.titulo as categoria')      
                                 ->join('categorias','categorias.id = peliculas.categoria_id')
                                 ->find($id);

      $data = [
                'pelicula' => $pelicula,
                'images' => $this->model->getImagesById($id),
                'etiquetas' =>$this->model->getEtiquetasById($id)
              ];

        return $this->respond($data); 
     }

public function create()
     {
        if ($this->validate('peliculas')){
      
           $id = $this->model-> insert([
              'titulo' => $this->request->getPost('titulo'),
              'description' => $this->request->getPost('description'),
              'categoria_id' => $this->request->getPost('categoria_id')
            ]);

        }else{
            return $this->respond($this->validator->getErrors(), 400);
            
        }
        return $this->respond($this->model->find($id), 200);
    }

public function update($id = null) 
  
  {
    if ($this->validate('peliculas')){
     $this->model->update($id,[
        'titulo' => $this->request->getRawInput()['titulo'],
        'description' => $this->request->getRawInput()['description'],
        'categoria_id' => $this->request->getRawInput()['categoria_id']
      ]);
     
    }else{
        return $this->respond($this->validator->getErrors(), 400);
    }
    return $this->respond($this->model->find($id), 200);
  }

public function delete($id = null) 
  {
   $this->model->delete($id);
   return $this->respond(['msg' => 'Registro eliminado...']);
  } 



public function etiquetas_post($id)
 {

        $peliculaEtiquetaModel = new PeliculaEtiquetaModel();

        $etiquetaId = $this->request->getPost('etiqueta_id');
        $peliculaId = $id;

        $peliculaEtiqueta = $peliculaEtiquetaModel->where('etiqueta_id', $etiquetaId)->where('pelicula_id', $peliculaId)->first();

    

        if(!$peliculaEtiqueta){
          $peliculaEtiquetaModel->insert([
            'pelicula_id' => $peliculaId,
            'etiqueta_id' => $etiquetaId
          ]);
        }
     return $this->respond(['mensaje'=>'ok, etiqueta asignada con éxito']);
 }
 

public function asignar_imagen($peliculaId)
 {
   helper('filesystem');
   if($imageFile = $this->request->getFile('imagen')){

            //upload   
       
        if($this->validate('image')){
          $imageNombre = $imageFile->getRandomName();
          $ext = $imageFile->getClientExtension();

          $imageFile->move('../public/uploads/peliculas', $imageNombre);

          $imagenModel = new ImagenModel();

          $imagenId = $imagenModel->insert([
            'imagen' => $imageNombre,
            'extension' => $ext,
            'data' => json_encode(get_file_info('../public/uploads/peliculas/' . $imageNombre)),
          ]);

          $peliculaImagenModel = new PeliculaImagenModel();
          $peliculaImagenModel->insert([
            'imagen_id' => $imagenId,
            'pelicula_id' => $peliculaId
          ]);
        
         return $this->respond(['mensaje'=>'imagen cargada con éxito'], 200);
          
        }
    
       } 
       return $this->respond(['mensaje'=>'la imagen es requerida'], 400);
    }

public function imagen_delete($imagenId) 
 
    {
     $imagenModel = new ImagenModel();
     $peliculaImagenModel = new PeliculaImagenModel();
     
     //!borrar archivo ***
     $imagen = $imagenModel->find($imagenId);
   
     if(!$imagen){
      return $this->respond(['mensaje'=>'No existe la imagen!']);
     }
     $imagenRuta = 'uploads/peliculas/'.$imagen['imagen'];
     unlink($imagenRuta);  
     //!borrar archivo ***
   
     $peliculaImagenModel->where('imagen_id', $imagenId)->delete();
     $imagenModel->delete($imagenId);
   
   
     return $this->respond(['mensaje'=>'Imagen eliminada!']);
    }  
}
    
      



    
