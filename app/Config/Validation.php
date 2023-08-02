<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------


    public $categorias = [
         'titulo' => 'required|min_length[3]|max_length[255]'
    ];
    
    public $peliculas = [
        'titulo' => 'required|min_length[3]|max_length[255]',
        'description' => 'required|min_length[3]|max_length[2000]',
        'categoria_id' => 'required',

    ];
    public $etiquetas = [
        'titulo' => 'required|min_length[3]|max_length[255]',
        'categoria_id' => 'required',

    ];  

    public $users = [
        'username' => 'required|min_length[3]|max_length[255]',
        'email' => 'required|valid_email',
        'password' => 'required|min_length[3]',
        'password2' => 'matches[password]'
    ];

    public $image = [
          'uploaded[imagen]',
          'mime_in[imagen,image/jpeg,image/gif,image/png]',
          'max_size[imagen, 4096]'
    ];

    
}
