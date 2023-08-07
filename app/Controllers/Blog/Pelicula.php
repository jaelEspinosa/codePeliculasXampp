<?php

namespace App\Controllers\Blog;

use App\Controllers\BaseController;
use App\Models\PeliculaModel;

class Pelicula extends BaseController

{

  public function index()
    {
      $pelicula = new PeliculaModel();
      $peliculas = $pelicula->paginate(5);

  
      return view('blog/pelicula/index', ['peliculas' => $peliculas, 'pager' => $pelicula->pager]);
      
    }


}