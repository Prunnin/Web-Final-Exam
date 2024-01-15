<?php
include_once "controller.php";
class teacher_controller extends controller{
    public function index(){
        $teacher_model = $this->model("teacher");
        $arr = $teacher_model->read_all();
        $view = "teacher/teacher";
        $this->view($view, [
            'teachers' => $arr,
        ]);
    }
    public function teacher_register(){
        $view = "teacher/teacher_register";
        $this->view($view);
    }
    public function teacher_confirm(){
        $view = "teacher/teacher_confirm";
        $this->view($view);
    }
    public function teacher_adjust(){
        $view = "teacher/teacher_adjust";
        $this->view($view);
    }
    public function teacher_delete(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $teacher_model = $this->model("teacher");
            $id = $_POST['id'];
            $rs = $teacher_model->delete_one($id);
            if ($rs){
                echo "delete successfully";
            }
        }

    }
    public function search_teacher(){
        $departments = array(
            "000" => "",
            "001" => "Khoa học máy tính",
            "002" => "Khoa học dữ liệu",
            "003" => "Hải dương học");
        
        // Xử lý form tìm kiếm
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            // Lấy dữ liệu từ form
            $department = $_GET["department"];
            $keyword = $_GET["keyword"];
        
            $my_model = $this->model("teacher");
            $teachers = $my_model->search_teacher($keyword, $department);
        }
        
        
        // Tạo HTML mới cho tbody
        $newTbodyHTML = '';
        foreach ($teachers as $key => $value) {
          $newTbodyHTML .= '<tr>';
          $newTbodyHTML .= '<td>' . $value->id . '</td>';
          $newTbodyHTML .= '<td>' . $value->name . '</td>';
          $newTbodyHTML .= '<td>' . $departments[$value->specialized] . '</td>';
          $newTbodyHTML .= '<td>' . $value->description . '</td>';
          $newTbodyHTML .= '<td>';
          $newTbodyHTML .= '  <button class="delete-button" onclick="openPopup()" data-id="'. $value->id.'" data-name="'. $value->name.'" >Xóa</button>
          <form action = "teacher/teacher_adjust" method="POST" id="teacher_form_'.$value->id.'" style="display: None;">
              <input type="text" name="id" value="'.$value->id.'">
          </form><button class="update-button" onclick="$(\' #teacher_form_\'+'.$value->id.').submit()">Sửa</button>';
          // Cập nhật lại đường dẫn của sửa
            $newTbodyHTML .= '</td>';
          $newTbodyHTML .= '</tr>';
         }
        
         // Trả về HTML mới cho tbody
         echo $newTbodyHTML;
    }
    public function register(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $teacher_model = $this->model("teacher");
            
            $name = $_POST["name"];
            $department = $_POST["department"];
            $degree = $_POST["degree"];
            $description = $_POST["description"];
            $file_name = $_POST["name_avatar"];
            $old_file = $_POST["old_path"];

            
            // echo $old_file;
            // die();
            $teacher_id = $_POST["id"];

            if ($teacher_id == "") {
                $teacher = $teacher_model->insert_teacher($name, $file_name, $description, $department, $degree);
                if ($teacher) {
                    $teacher_id = $teacher_model->getLastId();

                    if (!file_exists("web/avatar/$teacher_id")) {
                        // Tạo thư mục mới với quyền truy cập 0755 (có thể điều chỉnh theo nhu cầu)
                        if (mkdir("web/avatar/$teacher_id")) {
        
                            // echo 'Thư mục đã được tạo thành công.';
                            if (rename("web/avatar/tmp/" . $file_name, "web/avatar/$teacher_id/" . $file_name)) {
                                // echo 'File moved successfully.';
                                chmod("web/avatar/$teacher_id/" . $file_name, 0666);
                                echo json_encode(array("id" => $teacher_id));
                            } // else {
                            //     echo 'Failed to move file.';
                            // }
                        } else {
                            if (rename("web/avatar/tmp/" . $file_name, "web/avatar/$teacher_id/" . $file_name)) {
                                // echo 'File moved successfully.';
                                chmod("web/avatar/$teacher_id/" . $file_name, 0666);
                                echo json_encode(array("id" => $teacher_id));
                            }
                        }
                    }
                } else {
                    echo  json_encode(array("id" => -1));
                }
            }else{ # xoá ảnh cũ đi
                if ($file_name != ""){
                    if (file_exists("web/avatar/$teacher_id/" . $old_file)) {
                        // Kiểm tra xem tệp tồn tại hay không
                        unlink("web/avatar/$teacher_id/" . $old_file);               
                    }
                    if (rename("web/avatar/tmp/" . $file_name, "web/avatar/$teacher_id/" . $file_name)) {
                        // echo 'File moved successfully.';
                        chmod("web/avatar/$teacher_id/" . $file_name, 0666);
                    }
                    $teacher_model->update_teacher($name, $file_name, $description, $department, $degree, $teacher_id);
                    echo json_encode(array("id" => $teacher_id));
                } else {
                    $teacher_model->update_teacher($name, $old_file, $description, $department, $degree, $teacher_id);
                    echo json_encode(array("id" => $teacher_id));
                } 
            }
        } 
          
    }
    public function get_teacher(){
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            // require_once "../common/db.php";
            // $database = new Database("localhost", "schedule_management", "tam", "1");
            // $db = $database->get_connection();
            $my_model = $this->model("teacher");

            $teacher_id = "";
            if (isset($_GET["id"])) {
                $teacher_id = $_GET["id"];
            } else {
                // echo  json_encode(array("id" => -1));
                header("Location: index.php");
                exit();
            }
        
            $teacher_info = $my_model->get_teacher_by_id($teacher_id);
        
            if (!$teacher_info) {
                echo  json_encode(array("id" => -1));
                exit();
            }
        
            echo json_encode($teacher_info);
        } else {
            echo  json_encode(array("id" => -1));
        }
    }

}
?>