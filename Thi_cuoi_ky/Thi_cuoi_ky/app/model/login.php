<?php
require_once "app/common/database.php";
class login extends database{
    public function check_login($username, $password){
        $sql = "SELECT * FROM admins WHERE admins.login_id = ? AND admins.password = ?";
        $this->setQuery($sql);
        return $this->loadRow(array($username, md5($password)));
    }
}
?>