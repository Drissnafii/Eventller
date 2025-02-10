<?php
namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;
use App\Controller\ProductController;
use App\Controller\UserController;

abstract class TwigController{

    protected $twig;
    public function __construct()
    {
        $loader = new FilesystemLoader(realpath($_SERVER["DOCUMENT_ROOT"] . '/../') .'\templates');
        $twig = new \Twig\Environment($loader, [
            //'cache' => realpath($_SERVER["DOCUMENT_ROOT"].'/src/cache'),    
        ]);
        $this->twig = $twig;
    }
}

?>