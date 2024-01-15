<?php
include_once "controller.php";

class password_controller extends controller{
    public function index(){
        $view = "password/reset";
        $this->view($view);
    }
    private function check_password($account_name_check){
        $result = array(
            "status" => 1,
            "error_message" => "password hợp lệ"
        );
        if (empty($account_name_check)) {
            $result['status'] = 0;
            $result['error_message'] = "Hãy nhập login id";

        } elseif (strlen($account_name_check) < 4) {
            $result['status'] = 0;
            $result['error_message'] = "Hãy nhập login id tối thiểu 4 ký tự";
        } 

        return $result;
    }
    public function validate(){
        $account_name_check  = $_POST['account'];

        $error_message = "";

        $view = "password/reset";

        $check = $this->check_password($account_name_check);
        if ($check['status'] == 0){
            $error_message = $check['error_message'];
        } else {

            $check_account_obj = $this->model("password");
            $account_user = $check_account_obj->exists($account_name_check);

            if (empty($account_user)){

                $error_message = "Login Id không tồn tại trong hệ thống";

            } else {
                echo "<script>const BASE_URL = '" . BASE_URLS . "';</script>";
 
                $id_user = $account_user[0]->id;
                echo $id_user;
                $rs = $check_account_obj->reset_password_token($id_user);
                if ($rs){
                    ?>
                    
                        <script>
                            alert("Reset token password thành công")
                            window.location.href = BASE_URL + "login" 
                        </script>
                    <?php
                } else{
                    $error_message = "Xảy ra lỗi";
                }
                // header("Location: login");
            }

        }
        $this->view($view, [
            "error_message" => $error_message
        ]);
        return;
    }
    public function manager(){
        $user_model = $this->model("password");
        $user_token = $user_model->load_user_exist_token();

        $view = "password/reset_password_home";

        $this->view($view, [
            "user_data" => $user_token,
        ]);
    }
    public function confirm_password(){
        // var_dump($_POST);
        // die();
        $key = key($_POST);
        $user_id = explode('_', $key)[2];
        $password = current($_POST);
        $error_message = "";
        $view = "password/reset_password_home";
        $user_model = $this->model("password");
        $user_token = $user_model->load_user_exist_token();


        $check = $this->check_password($password);
        // var_dump($check);
        // die();
        if ($check['status'] == 0){
            $error_message = $check['error_message'];
        } else {
            $rs = $user_model->update_password($user_id, $password);
            if ($rs){
                header("location: manager");
            } else {
                $error_message ="Xảy ra lỗi";
            }
        }
        $this->view($view, [
            $key => $error_message,
            "user_data" => $user_token,
        ]);
        return;

    }
}

?>