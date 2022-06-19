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

    //Список статичных страниц
    public function upload_static_list(){

        $this->static_list["url"][] = "install";
        $this->static_list["adress"][] = "install.php";
        //----
    }

    //Запуск роутера
    public function start(){
        $this->way = $this->way();
        $this->statik_list($this->way);        
        $this->class_loader_way($this->array_to_str_way($this->way));
    }

    //Формирование массива адреса
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

    //Подключение статических страниц
    public function statik_list($way){
        $timed = 0;
        foreach($this->static_list["url"] as $url){
            if($url == $way[1]){
                include $this->static_list["adress"]["$timed"];
                
            }
            $timed++;
        }
    }

    //Преоброзователь массива адреса в строку
    Public function array_to_str_way($way){
        $str_way = "/";
        foreach($way as $w){
            $str_way .=$w."/";
        }
        var_dump($str_way);
        return $str_way;
    }

    //Запускатор класса
    public function class_loader_way($way){
        
        //Запрос        
        $sql = new \Mods\Sql\Sql;
        $connect = $sql->db_connect;
            $sth = $connect->prepare("SELECT * FROM `router` WHERE `url` = ?");
            $sth->execute(array($way));
            $result_sql = $sth->fetch(\PDO::FETCH_ASSOC);
        //Проверка на сущность
        if(!($result_sql["id"] >= 1)) {
            $this->e404();
            die();
        }
        //Вывод класс
        $class = $result_sql["class"];
        $funct = $result_sql["funct"];
        $result = new $class;
        $result->$funct();
    }

    //404 ошибка
    public function e404(){
        echo "error 404: page don't faunt!!!";
        die();
    }

    

}