<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;

class Etiqueta extends BaseController

{
  public function index()
  {
    $session = session();
    $user = $session->get('user');
    $etiquetaModel = new EtiquetaModel();
    $etiquetas = $etiquetaModel ->paginate(5);
    $categoriaModel = new CategoriaModel();
    $categorias = $categoriaModel->find();

       $data = ['nombreVariableVista'=>'Contenido', 'etiquetas' => $etiquetas, 'user' => $user, 'categorias'=>$categorias, 'pager'=>$etiquetaModel->pager];
       
       return view('dashboard/etiqueta/index', $data);
       
    }
    
    public function new()
    {
      $etiqueta = ['id'=>'','titulo'=>'','description'=>'', 'categoria_id'=>''];

      $categoriaModel = new CategoriaModel();
      $categorias = $categoriaModel->find();

     return view ('dashboard/etiqueta/new',['etiqueta'=>$etiqueta, 'categorias'=>$categorias]);
    }

    public function show($id)
    {
      $etiquetaModel = new EtiquetaModel();
      $etiqueta = $etiquetaModel->find($id);

    
      echo view('dashboard/etiqueta/show', ['etiqueta' => $etiqueta, 
                                            
                                          ]);
                                        }

    

   public function create(){

    $etiquetaModel = new EtiquetaModel();
    
    if ($this->validate('etiquetas')){
      
      $etiquetaModel -> insert([
        'titulo' => $this->request->getPost('titulo'),        
        'categoria_id' => $this->request->getPost('categoria_id')
      ]);

    }else{
      session()->setFlashdata([
        'validation' => $this->validator
      ]);
      return redirect()->back()->withInput();

    }
   return redirect()->to('/dashboard/etiqueta')->with('mensaje','Registro creado correctamente');
  }




  public function edit($id) 
  {
    $etiquetaModel = new EtiquetaModel();
    $categoriaModel = new CategoriaModel();
    $categorias = $categoriaModel->find();
    
    echo view ('dashboard/etiqueta/edit',['etiqueta' => $etiquetaModel->find($id), 'categorias' => $categorias]);
  }




  public function update($id) 
  {
    $etiquetaModel = new EtiquetaModel();

    if ($this->validate('etiquetas')){
      $etiquetaModel -> update($id,[
        'titulo' => $this->request->getPost('titulo'),
        'categoria_id' => $this->request->getPost('categoria_id')
      ]);
    }else{
      session()->setFlashdata([
        'validation' => $this->validator
      ]);
      return redirect()->back()->withInput();
    }


    return redirect()->to('/dashboard/etiqueta')->with('mensaje','Registro actualizado correctamente');
  }



 public function delete($id) 
 {
  $etiquetaModel = new EtiquetaModel();
  $etiquetaModel->delete($id);

  session()->setFlashdata('Mensaje', 'Registro eliminado correctamente'); // otra manera de mostrar el mensaje flash


  return redirect()->to('/dashboard/etiqueta');
 } 



}


?>