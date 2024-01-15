<?php
require_once "app/common/database.php";
class password extends database{
    public function __construct()
    {
        parent::__construct();
    }
    public function load_user_by_user_name(){

    }
    public function exists($accout_name_check){
        $sql = "SELECT * FROM admins WHERE admins.login_id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows(array($accout_name_check));
    }
    public function reset_password_token($id_user){
        $micro_time = microtime(true);
        $sql = "UPDATE admins
                 SET admins.reset_password_token = ?, admins.updated = NOW()
                 WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute(array($micro_time, $id_user));
    }
    public function load_user_exist_token(){
        $sql = "SELECT *
            FROM admins
            WHERE admins.reset_password_token IS NOT NULL
             AND TRIM(admins.reset_password_token) <> ''";
        $this->setQuery($sql);
        return $this->loadAllRows(array());
    }
    public function update_password($user_id, $password){
        $sql = "UPDATE admins
            SET password = ?, reset_password_token = '', updated = NOW()
            WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute(array(md5($password), $user_id));
    }
}

?>