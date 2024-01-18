<?php
include_once "controller.php";
class schedule_controller extends controller{
    public function index(){
        // $model = $this->model("demo"); 
        $my_model = $this->model("schedule");
        $arr = $my_model->search_shedule('', '', '');
        $teachers =  $my_model->read_table_by_name('teachers');
        $subjects = $my_model->read_table_by_name('subjects');
        $this->view("schedule/schedule",[
            'arr' =>  $arr,
            'teachers' => $teachers,
            'subjects' => $subjects,
            'search_school_year' => '',
            'search_subject' => '',
            'search_teacher' => '',
        ]);
    }
    public function search(){

        $searchSchoolYear = $_POST['search_school_year'] ?? '';
        $searchSubject = $_POST['search_subject'] ?? '';
        $searchTeacher = $_POST['search_teacher'] ?? '';

        $my_model = $this->model("schedule");
        $arr = $my_model->search_shedule($searchSchoolYear, $searchSubject, $searchTeacher);
        $teachers =  $my_model->read_table_by_name('teachers');
        $subjects = $my_model->read_table_by_name('subjects');
        // var_dump($arr);
        // die();
        $this->view("schedule/schedule",[
            'search_school_year' => $searchSchoolYear,
            'search_subject' => $searchSubject,
            'search_teacher' => $searchTeacher,

            'teachers' => $teachers,
            'subjects' => $subjects,
            'arr' =>  $arr
        ]);
    }
    public function update_schedule(){
        // var_dump($_POST);
        // die();
        $id = $_POST['update_id'];
        $my_model = $this->model("schedule");
        $arr_data = $my_model->read_schedule_by_id($id);
        $arr_data->lession = explode(",", $arr_data->lession);
        if (isset($_POST['re_modify'])){

            $post_data = $_POST;
            $arr_data = new stdClass();
        
            foreach ($post_data as $key => $value) {
                $arr_data->$key = $value;
            }
        }

        $teachers = $my_model->read_table_by_name('teachers');
        $subjects = $my_model->read_table_by_name('subjects');
        // var_dump($my_model->read_table_by_name('teachers'));
        $view = "schedule/update_schedule";
        return $this->view($view, [
            "data" => $arr_data,
            'subjects' => $subjects,
            'teachers' => $teachers,
            "update_id" => $id
        ]);
    }
    public function complete(){
        $view = "schedule/complete";
        $this->view($view);
    }
    public function confirm_update_schedule(){
        $data = $_POST;

        $view = "schedule/confirm_schedule";
        $my_model = $this->model("schedule");
        $teachers = $my_model->read_table_by_id_name($_POST['teacher_id'], 'teachers');
        $subjects = $my_model->read_table_by_id_name($_POST['subject_id'],'subjects');
        $this->view($view, [
            'data' => $data,
            'subjects' => $subjects,
            'teachers' => $teachers
        ]);
    }
    public function update(){
        $school_year = $_POST['school_year'];
        $subject_id = $_POST['subject_id'];
        $teacher_id = $_POST['teacher_id'];
        $week_day = $_POST['week_day'];
        $lesson = implode(',',$_POST['lession']);
        $notes = $_POST['notes'];
        $my_model = $this->model("schedule");

        $id = $_POST['confirm_id'];
        $rs = $my_model->update_schedule($id, $school_year, $subject_id, $teacher_id, $week_day, $lesson, $notes);
        if ($rs){
            header("location: complete");
        } else {
            ?>
            <script>alert("Xảy ra lỗi")</script>
            <?php
            header("location: index");
        }
    }
    public function delete_schedule(){
        // var_dump($_POST);
        // die();
        $my_model = $this->model("schedule");
        $rs = $my_model->delete_schedule($_POST['delete_id']);
        if ($rs){
            header("location: index");
        } else {
            ?>
            <script>alert("Xảy ra lỗi")</script>
            <?php
            header("location: index");
        }
    }
    public function add_schedule(){
        $view = "schedule/add_schedule";
        $my_model = $this->model("schedule");
        // var_dump($_POST);
        $teachers = $my_model->read_all_table_by_id_name('', 'teachers');
        $subjects = $my_model->read_all_table_by_id_name('','subjects');
        return $this->view($view, [
            'data' => $_POST,
            'subjects' => $subjects,
            'teachers' => $teachers,
        ]);
    }
    public function confirm_add_schedule(){
        $data = $_POST;
        $my_model = $this->model("schedule");
        $teachers = $my_model->read_table_by_id_name($_POST['teacher_id'], 'teachers');
        $subjects = $my_model->read_table_by_id_name($_POST['subject_id'],'subjects');
        $view = "schedule/confirm_add_schedule";
        return $this->view($view, [
            'data' => $data,
            'subjects' => $subjects,
            'teachers' => $teachers
        ]);

    }
    public function insert_schedule(){

        $school_year = $_POST['school_year'];
        $subject_id = $_POST['subject_id'];
        $teacher_id = $_POST['teacher_id'];
        $week_day = $_POST['week_day'];
        $lesson = implode(",",$_POST['lesson']);
        $notes = $_POST['notes'];
        $my_model = $this->model("schedule");
        $rs = $my_model->insert_schedule($school_year, $subject_id, $teacher_id, $week_day, $lesson, $notes);
        if (!$rs){
            ?>
            <script>alert("Xảy ra lỗi")</script>
            <?php
            header("location: index");
            exit();
        } 
        
        header("location: complete");;
        exit();
    }

}
?>