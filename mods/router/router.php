<?php
namespace Mods\Router;

Class Router{
    public $way = null;

    public function __construct(){
        $this->start();
        return;
    }

    public function start(){
        $this->way();
    }


    
    public function way(){
        //Получение адреса сайта
        $get =  $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 
        $array_adress_geter = explode("?", $get);
        $array_adress = explode("/", $array_adress_geter[0]);
        //удаление пустых элементов адреса
        $array_get_clean = array_filter($array_adress);
        unset ($array_get_clean[0]);

        return $array_get_clean;
        
    }

}