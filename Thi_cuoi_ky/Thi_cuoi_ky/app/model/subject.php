<?php
require_once "app/common/database.php";
class subject extends database {
    public function addsubject($name, $avatar, $description, $schoolyear) {
        $sql = "INSERT INTO subjects (name, avatar, description, school_year, created, updated)
                VALUES (?, ?, ?, ?, NOW(), NOW())";
        
        $this->setQuery($sql);

        $options = array($name, $avatar, $description, $schoolyear);
        $this->execute($options);

        return $this->getLastId();
    }

    public function getsubjects($name_filter, $school_year_filter) {
        // Ensure your SQL query is correct
        $sql = "SELECT id, school_year, description, name 
                FROM subjects
                WHERE (school_year LIKE CONCAT('%', ?, '%') AND name LIKE CONCAT('%', ?, '%'))";
        
        $this->setQuery($sql);
    
        // Ensure you are passing the parameters in the correct order
        return $this->loadAllRows([$school_year_filter, $name_filter]);
    }
    

    public function delete_subject($subjectId) {
        $sql = "DELETE 
            FROM subjects 
            WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute(array($subjectId));
    }

    // public function update_subject($subjectId, $name, $avatar, $description, $school_year) {
    //     $sql = "UPDATE subjects
    //             SET name=?, avatar=?, description=?, school_year=?, updated=NOW()
    //             WHERE id=?";
        
    //     $this->setQuery($sql);

    //     $options = array($name, $avatar, $description, $school_year, $subjectId);
    //     $this->execute($options);
    // }
    public function get_subject_by_Id($subjectId) {
        $sql = "SELECT * FROM subjects WHERE id = ?";
        $this->setQuery($sql);

        $options = array($subjectId);
        return $this->loadRow($options);
    }
    public function insert_subject($name, $avatar, $description, $school_year){
        $sql = "INSERT INTO subjects(subjects.name, subjects.avatar, subjects.description, subjects.school_year, subjects.updated, subjects.created) VALUES (?, ?, ?, ?, NOW(), NOW())";
        $this->setQuery($sql);
        return $this->execute(array($name, $avatar, $description, $school_year));
    }

    public function read_subject_by_id($id){
        $sql = "SELECT * FROM subjects WHERE id = ?";
        $this->setQuery($sql);
        return $this->loadRow(array($id));
    }
    public function update_subject($subject_id, $name, $avatar, $description, $school_year){
        $sql = "UPDATE subjects
                SET name=?, avatar=?, description=?, school_year=?, updated=NOW()
                WHERE id=?";
        $this->setQuery($sql);
        return $this->execute(array($name, $avatar, $description, $school_year, $subject_id));
    }
}

?>