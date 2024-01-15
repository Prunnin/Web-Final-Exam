<?php
require_once "app/common/database.php";
class teacher extends database{
    public function insert_teacher($name, $file_name, $description, $department, $degree){
        $query = "INSERT INTO teachers (name, avatar, description, specialized, degree, updated, created)
                  VALUES (?,?,?,?,?, NOW(), NOW())";

        $this->setQuery($query);
        return $this->execute(array($name, $file_name, $description, $department, $degree));

    }
    public function update_teacher($name, $file_name, $description, $department, $degree,  $teacherId)
    {
        $query = "UPDATE teachers
                  SET name = ?, avatar = ?, description = ?,
                      specialized = ?, degree = ?, updated = NOW()
                  WHERE id = ?";
        $this->setQuery($query);
        return $this->execute(array($name, $file_name, $description, $department, $degree,  $teacherId));


    }
    public function get_teacher_by_id($id){
        $query = "SELECT id, name, avatar, specialized, description, degree   FROM teachers WHERE id = ?"; 
        $this->setQuery($query);
        return $this->loadRow(array($id));
    }
    public function read_all(){
        $sql = "SELECT * FROM teachers";
        $this->setQuery($sql);
        return $this->loadAllRows(array());
    }
    public function delete_one($id){
        $sql = "DELETE 
            FROM teachers 
            WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute(array($id));

    }
    public function search_teacher($keyword, $department){
        $sql = "SELECT * FROM teachers WHERE";
    
        if (!empty($department)) {
            $sql .= " specialized = ?";
        } else {
            $sql .= " specialized IS NULL";
        }
    
        if (!empty($keyword)) {
            if (!empty($department)) {
                $sql .= " AND";
            }
            $sql .= " (name LIKE ? OR description LIKE ? OR degree LIKE ?)";
        }
    
        $this->setQuery($sql);
    
        $params = array();
    
        if (!empty($department)) {
            $params[] = $department;
        }
    
        if (!empty($keyword)) {
            $params[] = "%" . $keyword . "%";
            $params[] = "%" . $keyword . "%";
            $params[] = "%" . $keyword . "%";
        }
    
        return $this->loadAllRows($params);
    }
}

?>