<?php
require_once "app/common/database.php";
class home extends database{
    public function check_login($username, $password){
        $sql = "SELECT * FROM admins WHERE admins.login_id = ? AND admins.password = ?";
        $this->setQuery($sql);
        return $this->loadAllRows(array($username, md5($password)));
    }
}
?>