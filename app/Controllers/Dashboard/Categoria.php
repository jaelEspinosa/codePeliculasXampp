<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;

class Categoria extends BaseController

{

  public function index()
  {

    $categoriaModel = new CategoriaModel();
    $categorias = $categoriaModel ->paginate(5);
  
      
       $data = ['nombreVariableVista'=>'Contenido', 'categorias' => $categorias, 'pager'=>$categoriaModel->pager];
       return view('dashboard/categoria/index', $data);
    }
    
    public function new()
    {
      $categoria = ['id'=>'','titulo'=> ''];

      echo view ('dashboard/categoria/new',['categoria'=>$categoria]);
    }

    public function show($id)
    {
      $categoriaModel = new CategoriaModel();
    
      $categoria = $categoriaModel->find($id);
    
      echo view('dashboard/categoria/show', ['categoria' => $categoria]);
    }

   public function create(){

    $categoriaModel = new CategoriaModel();

    if ($this->validate('categorias')){
      $categoriaModel -> insert([
        'titulo' => $this->request->getPost('titulo')
      ]);

    }else{
      session()->setFlashdata([
        'validation' => $this->validator
      ]);
      return redirect()->back()->withInput();
    }
    return redirect()->to('/dashboard/categoria')->with('Mensaje','Registro Creado correctamente');
  }


  public function edit($id) 
  {
    $categoriaModel = new CategoriaModel();
    
    echo view ('dashboard/categoria/edit',['categoria' => $categoriaModel->find($id)]);
  }

  public function update($id) 
  {
    $categoriaModel = new CategoriaModel();
    if ($this->validate('categorias')){
      $categoriaModel -> update($id,[
        'titulo' => $this->request->getPost('titulo')
      ]);
    
    }else{
      session()->setFlashdata([
        'validation' => $this->validator
      ]);
      return redirect()->back()->withInput();

    }
    return redirect()->to('/dashboard/categoria')->with('Mensaje','Registro actualizado correctamente');
  }

 public function delete($id) 
 {
  $categoriaModel = new CategoriaModel();
  $categoriaModel->delete($id);

  session()->setFlashdata('Mensaje', 'Registro eliminado correctamente'); // otra manera de mostrar el mensaje flash

  //return redirect()->to('/dashboard/categoria')->with('Mensaje','Registro eliminado correctamente');
  return redirect()->to('/dashboard/categoria');
 } 
}


?>