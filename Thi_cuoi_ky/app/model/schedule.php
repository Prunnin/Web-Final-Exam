<?php
require_once "app/common/database.php";
class schedule extends database{
    public function search_shedule($searchSchoolYear, $searchSubject, $searchTeacher){
        $sql = "SELECT s.id, s.school_year, su.name AS subject_name, t.name AS teacher_name, s.week_day, s.lession, s.notes
                    FROM schedules s
                    JOIN subjects su ON s.subject_id = su.id
                    JOIN teachers t ON s.teacher_id = t.id
                    WHERE (s.school_year LIKE CONCAT('%', ?, '%')
                        AND su.name LIKE CONCAT('%', ?, '%')
                        AND t.name LIKE CONCAT('%', ?, '%'))";
        $this->setQuery($sql);
        return $this->loadAllRows(array($searchSchoolYear, $searchSubject, $searchTeacher));
        
    }
    public function read_schedule_by_id($id){
        $sql = "SELECT * FROM schedules WHERE id = ?";
        $this->setQuery($sql);
        return $this->loadRow(array($id));
    }
    public function read_table_by_name($name){
        $sql = "SELECT * FROM $name";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    public function read_table_by_id_name($id, $name){
        $sql = "SELECT * FROM $name WHERE id = ?";


        $this->setQuery($sql);
        return $this->loadRow(array($id));
    }
    public function update_schedule($id,$school_year, $subject_id, $teacher_id, $week_day, $lesson, $notes){
        $sql = "UPDATE schedules
                SET schedules.school_year = ?, schedules.subject_id = ?, 
                schedules.teacher_id = ?, schedules.week_day = ?, 
                schedules.lession = ?, schedules.notes = ?, schedules.updated = NOW()
                WHERE schedules.id = ?";
        $this->setQuery($sql);
        return $this->execute(array($school_year, $subject_id, $teacher_id, $week_day, $lesson, $notes, $id));
    }
    public function delete_schedule($id){
        $sql = "DELETE FROM schedules
            WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute(array($id));
    }
    public function read_all_table_by_id_name($id, $name){
        $sql = "SELECT * FROM $name";

        if (!empty($id)){
            $sql .= " WHERE id = ?";
        }

        $this->setQuery($sql);
        return $this->loadAllRows(array($id));
    }

    public function insert_schedule($school_year, $subject_id, $teacher_id, $week_day, $lesson, $notes){
        $sql = "INSERT INTO schedules(schedules.school_year, schedules.subject_id,schedules.teacher_id, schedules.week_day, schedules.lession, schedules.notes, schedules.created) 
        VALUES (?,?,?,?,?,?,NOW())";
        $this->setQuery($sql);
        return $this->execute(array($school_year, $subject_id, $teacher_id, $week_day, $lesson, $notes));
    }

}
?>