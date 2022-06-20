<?php
namespace Mods\Weiv;

Class Weiv{
    //Загрузить страницу без шаблона
    public function show($mod,$file){
        $conf = new \Mods\View\Config;
        $thems = $conf->thems;

        $file_name = MYPOS.'\inter\thems\\'.$thems."\\".$mod."\\"$file.".php";  
                 
        //Проверка на существование файла
        if (file_exists($file_name)) {
            include  $file_name;
        }else{
            $log = new \Mod\Logs\Logs;
            $m = "Не найдет файл: ".$file_name;
            $log->loging("view", $m);
        }
    }

    //Загрузить страницу с шаблоном
    public function shows($mod,$file,$type){

    }


    

}