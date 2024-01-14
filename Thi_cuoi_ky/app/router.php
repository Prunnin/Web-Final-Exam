<?php
require_once "app/common/app.php";
class router extends app{
    public function __construct(){
        parent::__construct();
        // var_dump($_SESSION);
        // die();
        $url = $this->process();
        if (!isset($_SESSION['login_id'])){
            // echo 123;
            // die();
            $url[0] = "login";
            $this->call($url);
        } else{
            // echo 456;
            // var_dump($url);
            // die();
            $this->call($url);
        }
    }
    public function process(){
        if (isset($_GET['url'])){
            $url = $_GET['url'];
            return array_values(array_filter(explode("/",$url)));
        }
    }
}
?>