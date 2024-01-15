<?php
class app{
    protected $controller = "home_controller";
    protected $function = "index";
    protected $params = [];
    public function __construct(){
        // $url = $this->process();
        // $this->call($url);
    }
    public function call($url){
        // var_dump($url, $this->controller, $this->function);
        // die();
        if (isset($url[0])){
            if (file_exists("app/controller/".strtolower($url[0])."_controller.php")){
                $this->controller = strtolower($url[0])."_controller";
                unset($url[0]);
            } 
        }
    
        require_once "app/controller/".$this->controller.".php";
        $this->controller = new $this->controller;


        if (isset($url[1])){
            if (method_exists($this->controller, $url[1])){
                $this->function = $url[1];
            }
            unset($url[1]);
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->function], $this->params);
    }
    
}

?>