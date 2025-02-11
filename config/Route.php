<?php

namespace Config;

class Route{
    public string $uri;
    public string $method;
    public $contoller;
    public array $parametres;

    public function __construct(string $uri, $contoller,string $method, array $parametres = []){
        $this->uri = $uri;
        $this->method = $method;
        $this->contoller = $contoller;
        $this->parametres = $parametres;
    }
    
}

?>