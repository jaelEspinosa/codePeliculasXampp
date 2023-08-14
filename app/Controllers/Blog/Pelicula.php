<?php

namespace App\Controllers\Blog;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\PeliculaModel;
use App\Models\EtiquetaModel;

class Pelicula extends BaseController

{

  public function index()
    {
      $categoriaModel = new CategoriaModel();
      $categorias = $categoriaModel->find();
      
      $etiquetasModel = new EtiquetaModel();
      $etiquetas = $etiquetasModel->find();

      $pelicula = new PeliculaModel();
      $peliculas = $pelicula->select('peliculas.*, categorias.titulo as categoria')
                            ->join('categorias','categorias.id = peliculas.categoria_id')
                            ->join('pelicula_etiqueta','pelicula_etiqueta.pelicula_id = peliculas.id','left')
                            ->join('etiquetas','etiquetas.id = pelicula_etiqueta.etiqueta_id','left');

                       
     
       //is hay termino de busqueda busca coincidencias de manera parcial con like()
       // 'both' busca coincidencias por atras y por delante del string
       // 'after' o 'before' las buscaria por atras o por delante respectivamente.
      
       $buscar = $this->request->getGet('buscar');
       $buscarCategoria = $this->request->getGet('categoria_id');
       $etiquetaBuscar = $this->request->getGet('etiqueta_id');
    
       if($buscar){
           $peliculas = $pelicula->groupStart()->orlike('peliculas.titulo', $buscar, 'both')
                                 ->orlike('peliculas.description', $buscar, 'both')->groupEnd();
           
       }

       if($buscarCategoria){
           $peliculas = $pelicula->where('peliculas.categoria_id', $buscarCategoria); 
       }

       if($etiquetaBuscar){
        $peliculas = $pelicula->where('etiquetas.id', $etiquetaBuscar); 
       }

     
        $peliculas = $pelicula->groupBy('peliculas.id')->paginate(5);

  
      return view('blog/pelicula/index', ['peliculas' => $peliculas, 
                                          'categorias' => $categorias,
                                        //  'etiquetas' => $etiquetas, 
                                          'pager' => $pelicula->pager]);
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

    //****JSON */


    /* public function etiquetasPorCategoria($categoriaId)
    {
      $etiquetaModel = new EtiquetaModel();

      return json_encode($etiquetaModel->where('categoria_id',$categoriaId)->findAll());
    } */
}