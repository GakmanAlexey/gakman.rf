<?php
// Константы костыли.
define("MYPOS" , __DIR__);
define("SLASH" ,"\\");

//Дебаг режим
if(True){
    
        ini_set('error_reporting', E_ALL);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);    
    
};

//Автозагрузка классов.
spl_autoload_register(function ($class_name) {   
    $class_name = str_replace('\\','/',$class_name);
    $class_name = strtolower($class_name);
    if(file_exists(MYPOS."/".$class_name . '.php')){include_once MYPOS."/".$class_name . '.php';}    
});

//Запуск ядра
include "core/core.php";

?>