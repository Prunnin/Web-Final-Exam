<?php
include_once "controller.php";
class login_controller extends controller{
    public function __construct(){}
    public function index(){
        $view = "login/login";
        $this->view($view);
    }
    public function check_login(){
       $account = $_POST['account'];
       $password = $_POST['password'];
       $arr = array(
        'status'=> 1,
        'response' => "Đăng nhập thành công"
       );

       $user_model = $this->model("login");
       $check_exist = $user_model->check_login($account, $password);

       if (empty($check_exist)){
        $arr['status'] =  0;
        $arr['response'] = "login id và password không đúng";
       } else {
            $_SESSION['id'] = $check_exist->id;
            $_SESSION['login_id'] = $check_exist->login_id;
       }
       echo json_encode($arr);
    }
}
?>