<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');
/* $routes->presenter('/pelicula'); */

//$routes->get('pelicula', 'PeliculaController::index');

$routes->group('dashboard', function($routes){
    
    $routes->get('pelicula/(:num)/download','Dashboard\Pelicula::download_img/$1',['as' => 'pelicula.imagen_download']); 
    
    $routes->get('pelicula/etiqueta/(:num)','Dashboard\Pelicula::etiquetas/$1',['as' => 'pelicula.etiquetas']); 
   
    $routes->post('pelicula/etiqueta/(:num)','Dashboard\Pelicula::etiquetas_post/$1',['as' => 'pelicula.etiquetas']); 

    $routes->post('pelicula/(:num)/etiqueta/(:num)/delete','Dashboard\Pelicula::etiqueta_delete/$1/$2',['as' => 'pelicula.etiqueta_delete']); 

    $routes->post('pelicula/(:num)/delete','Dashboard\Pelicula::imagen_delete/$1',['as' => 'pelicula.imagen_delete']); 

    
    $routes->presenter('pelicula', ['controller' => 'Dashboard\Pelicula']);
    $routes->presenter('etiqueta', ['controller' => 'Dashboard\Etiqueta']);
    $routes->presenter('categoria', ['except' => 'show', 'controller' => 'Dashboard\Categoria']); 

    
    // añadiendo en opciones except me muestra todas las rutas excepto show
   // $routes->presenter('categoria', ['only' => 'show']); // aqui sería al contrario es decir me muestra solo show
   
   /* en ambos casos si quiero exceptuar mas de una o mostrar un grupo, seria poner un array como este:

          $routes->presenter('categoria', ['only' => ['show', 'index']]);
   */
});


$routes->group('blog', function($routes){

$routes->get('pelicula', 'Blog\Pelicula::index', ['as'=>'blog.pelicula.index']);
$routes->get('pelicula/(:num)', 'Blog\Pelicula::show/$1', ['as'=>'blog.pelicula.show']);
$routes->get('pelicula/categoria/(:num)', 'Blog\Pelicula::peliculasByCategoria/$1', ['as'=>'blog.peliculas.categoria']);
$routes->get('pelicula/etiqueta/(:num)', 'Blog\Pelicula::peliculasByEtiqueta/$1', ['as'=>'blog.peliculas.etiqueta']);
  //  $routes->get('etiquetas_por_categoria/(:num)', 'Blog\Pelicula::etiquetasPorCategoria/$1', ['as' => 'blog.pelicula.etiquetas_por_categoria'] );
});

$routes->group('api', ['namespace' => 'App\Controllers\Api'],function($routes){
 
//**RUTAS PERSONALIZADAS PARA RELACIONES ENTRE PELICULAS Y CATEGORIAS */  
$routes->get('pelicula/paginado', 'Pelicula::paginado');
$routes->get('pelicula/paginado_full', 'Pelicula::paginado_full');
$routes->get('pelicula/index_por_categoria/(:num)', 'Pelicula::index_por_categoria/$1');
$routes->get('pelicula/index_por_etiqueta/(:num)', 'Pelicula::index_por_etiqueta/$1');
$routes->post('pelicula/asignar_imagen/(:num)', 'Pelicula::asignar_imagen/$1');
$routes->delete('pelicula/imagen_delete/(:num)', 'Pelicula::imagen_delete/$1');

$routes->delete('pelicula/(:num)/etiqueta/(:num)/delete','PeliculaEtiqueta::etiqueta_delete/$1/$2'); 
$routes->post('pelicula/etiqueta/(:num)','Pelicula::etiquetas_post/$1'); 

//**CRUD DE PELICULAS */
$routes->resource('pelicula');

//**CRUD DE CATEGORIAS */
$routes->resource('categoria');

 //**CRUD DE ETIQUETAS */
$routes->get('etiquetas', 'Etiquetas::index');
$routes->post('etiquetas', 'Etiquetas::create');
$routes->get('etiquetas/(:num)', 'Etiquetas::show/$1');
$routes->put('etiquetas/(:num)', 'Etiquetas::update/$1');
$routes->delete('etiquetas/(:num)', 'Etiquetas::delete/$1');


});

$routes->group('auth', ['namespace' => 'App\Controllers\Api'],function($routes){

   $routes->post('login', 'User::login');
   $routes->post('register', 'User::register');
    
    
});

$routes->get('login', '\App\Controllers\Web\User::login',['as'=>'usuario.login']);
$routes->get('register', '\App\Controllers\Web\User::register',['as'=>'usuario.register']);
$routes->get('logout', '\App\Controllers\Web\User::logout',['as'=>'usuario.logout']);

$routes->post('login_post', '\App\Controllers\Web\User::login_post',['as'=>'usuario.login_post']);
$routes->post('register_post', '\App\Controllers\Web\User::register_post',['as'=>'usuario.register_post']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
