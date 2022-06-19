<?php
namespace Mods\Router;

Class Router{
    public $way = null;

    public function __construct(){
        $this->way();
    }
    public function way(){
        $get = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];   
        var_dump($get);     
    }

}