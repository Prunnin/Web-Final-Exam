<?php
class controller{
    public function __construct(){

    }
    public function model($model){
        require_once "app/model/".$model.".php";
        return new $model;
    }
    public function view($views, $data = []){

        $view = "app/view/template/".$views.".php";
        
        return require_once "app/view/layout.php";
    }
}
?>