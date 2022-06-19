<?php
namespace Mods\Router;

Class Router{
    public $way = null;
    public $static_list = null;

    public function __construct(){
        $this->upload_static_list();
        $this->start();
        return;
    }

    public function upload_static_list(){

        $this->static_list["url"][] = "install";
        $this->static_list["adress"][] = "install.php";
        //----
    }

    public function start(){
        $this->way = $this->way();
        $this->statik_list($this->way);
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

    public function statik_list($way){
        $timed = 0;
        foreach($this->static_list["url"] as $url){
            if($url == $way[1]){
                include $this->static_list["adress"]["$timed"];
                
            }
            $timed++;
        }
        //var_dump("<pre>",$way);
        //var_dump("<pre>",$this->static_list);
    }

    

}