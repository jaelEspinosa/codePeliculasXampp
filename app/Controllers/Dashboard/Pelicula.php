<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Database\Migrations\Etiquetas;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use App\Models\ImagenModel;
use App\Models\PeliculaEtiquetaModel;
use App\Models\PeliculaImagenModel;
use App\Models\PeliculaModel;

class Pelicula extends BaseController

{
  public function index()
  {
    $session = session();
    $user = $session->get('user');
    $peliculaModel = new PeliculaModel();
    $peliculas = $peliculaModel ->paginate(5);
    $categoriaModel = new CategoriaModel();
    $categorias = $categoriaModel->find();


      
       $data = ['nombreVariableVista'=>'Contenido', 'peliculas' => $peliculas, 'user' => $user, 'categorias'=>$categorias, 'pager'=>$peliculaModel->pager];

       
       return view('dashboard/pelicula/index', $data);
       
    }
    
    public function new()
    {
      $pelicula = ['id'=>'','titulo'=>'','description'=>'', 'categoria_id'=>''];

      $categoriaModel = new CategoriaModel();
      $categorias = $categoriaModel->find();

     return view ('dashboard/pelicula/new',['pelicula'=>$pelicula, 'categorias'=>$categorias]);
    }

    public function show($id)
    {
      $peliculaModel = new PeliculaModel();
      $categoriaModel = new CategoriaModel();
    
      $pelicula = $peliculaModel->find($id);
      $categorias = $categoriaModel->find();

     // var_dump($peliculaModel -> getImagesById($id));
    
      echo view('dashboard/pelicula/show', ['pelicula' => $pelicula, 
                                            'categorias' => $categorias, 
                                            'images'=>$peliculaModel->getImagesById($id),
                                            'etiquetas'=>$peliculaModel->getEtiquetasById($id),
                                          ]);
                                        }

    

   public function create(){

    $peliculaModel = new PeliculaModel();
    
    if ($this->validate('peliculas')){
      
      $peliculaModel -> insert([
        'titulo' => $this->request->getPost('titulo'),
        'description' => $this->request->getPost('description'),
        'categoria_id' => $this->request->getPost('categoria_id')
      ]);

    }else{
      session()->setFlashdata([
        'validation' => $this->validator
      ]);
      return redirect()->back()->withInput();

    }
   return redirect()->to('/dashboard/pelicula')->with('Mensaje','Registro creado correctamente');
  }




  public function edit($id) 
  {
    $peliculaModel = new PeliculaModel();
    $categoriaModel = new CategoriaModel();
    $categorias = $categoriaModel->find();
    
    echo view ('dashboard/pelicula/edit',['pelicula' => $peliculaModel->find($id), 'categorias' => $categorias]);
  }




  public function update($id) 
  {
    $peliculaModel = new PeliculaModel();

    if ($this->validate('peliculas')){
      $peliculaModel -> update($id,[
        'titulo' => $this->request->getPost('titulo'),
        'description' => $this->request->getPost('description'),
        'categoria_id' => $this->request->getPost('categoria_id')
      ]);
     $this->asignar_imagen($id);
    }else{
      session()->setFlashdata([
        'validation' => $this->validator
      ]);
      return redirect()->back()->withInput();
    }

    
    return redirect()->to('/dashboard/pelicula')->with('mensaje','Registro actualizado correctamente');
  }



 public function delete($id) 
 {
  $peliculaModel = new PeliculaModel();
  $peliculaModel->delete($id);

  session()->setFlashdata('Mensaje', 'Registro eliminado correctamente'); // otra manera de mostrar el mensaje flash

 // return redirect()->to('/dashboard/pelicula')->with('Mensaje','Registro eliminado correctamente');
  return redirect()->to('/dashboard/pelicula');
 } 

 public function imagen_delete($imagenId) 
 
 {
  $imagenModel = new ImagenModel();
  $peliculaImagenModel = new PeliculaImagenModel();
  
  //!borrar archivo ***
  $imagen = $imagenModel->find($imagenId);

  if(!$imagen){
    return 'no existe imagen';
  }
  $imagenRuta = 'uploads/peliculas/'.$imagen['imagen'];
  unlink($imagenRuta);  
  //!borrar archivo ***

  $peliculaImagenModel->where('imagen_id', $imagenId)->delete();
  $imagenModel->delete($imagenId);


  return redirect()->back()->with('mensaje','Imagen eliminada!');
 }

 public function download_img($imageId)
 {
   $imagenModel = new ImagenModel();
   $imagen = $imagenModel->find($imageId);

   if(!$imagen){
    return 'No Existe imagen';
   }

   $imagenRuta = 'uploads/peliculas/'.$imagen['imagen'];

   return $this->response->download($imagenRuta, null)->setFileName('imagen_'.$imagen['id'].'.'.$imagen['extension']);

 }
 
 private function asignar_imagen($peliculaId)
 {
   helper('filesystem');
   if($imageFile = $this->request->getFile('imagen')){

    var_dump($imageFile);
    var_dump($imageFile->getTempName());
            //upload   
       
        if($this->validate('image')){
          $imageNombre = $imageFile->getRandomName();
          $ext = $imageFile->getClientExtension();

          /* $imageFile->move(WRITEPATH . 'uploads/peliculas', $imageNombre); */
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
        
        }
        return $this->validator->listErrors();
    
   } 
 }





 public function etiquetas($id)
 {
  $categoriaModel = new CategoriaModel();
  $etiquetaModel = new EtiquetaModel();
  $peliculaModel  = new PeliculaModel();

  $etiquetas= [];

  if($this->request->getGet('categoria_id')){
    $etiquetas= $etiquetaModel
    ->where('categoria_id', $this->request->getGet('categoria_id'))
    ->findAll();
  }

  echo view('dashboard/pelicula/etiquetas',[
    'pelicula'   => $peliculaModel->find($id),
    'categorias' => $categoriaModel->findAll(),
    'categoria_id' => $this->request->getGet('categoria_id'),
    'etiquetas'  => $etiquetas
  ]);

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
     return redirect()->back();
 }

public function etiqueta_delete($id, $etiquetaId)
{
   $peliculaEtiqueta = new PeliculaEtiquetaModel();

   $peliculaEtiqueta->where('etiqueta_id', $etiquetaId)
                    ->where('pelicula_id', $id)
                    ->delete();
         return redirect()->back()->with('mensaje','Etiqueta eliminada');           
}



}


?>