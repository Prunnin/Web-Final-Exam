<?php
require_once "app/common/app.php";
class router extends app{
    public function __construct(){
        parent::__construct();
        $url = $this->process();
        if (!isset($_SESSION['login_id'])){
            $url[0] = "login";
            $this->call($url);
        } else{
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