<?php

namespace App\Controllers\Blog;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\PeliculaModel;

class Pelicula extends BaseController

{

  public function index()
    {
      $pelicula = new PeliculaModel();
      $peliculas = $pelicula->paginate(5);

  
      return view('blog/pelicula/index', ['peliculas' => $peliculas, 'pager' => $pelicula->pager]);
      
    }

  public function show($id)
    {
      $peliculaModel = new PeliculaModel();
      $categoriaModel = new CategoriaModel();
    
      $pelicula = $peliculaModel->find($id);
      $categorias = $categoriaModel->find();

      echo view('blog/pelicula/show', ['pelicula' => $pelicula, 
                                            'categorias' => $categorias, 
                                            'images'=>$peliculaModel->getImagesById($id),
                                            'etiquetas'=>$peliculaModel->getEtiquetasById($id),
                                          ]);
      
    }
}