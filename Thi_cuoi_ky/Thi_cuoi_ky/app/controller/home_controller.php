<?php
include_once "controller.php";
class home_controller extends controller{
    public function index(){
        // $model = $this->model("demo"); 
        $this->view("home/home");
    }

}
?>