<?php
include_once "controller.php";
class subject_controller extends controller{
    public function index(){
        $data = [];
        if (isset($_POST) && !empty($_POST)){
            $data["name"] = $_POST['name'];
            $data["school_year"] = $_POST['school_year'];
            $data['description'] = $_POST['description'];
            $data['avatar'] = $_POST['avatar'];
        }

        $this->view("subject/adding_subject", $data);
    }
    public function notification() {
        $notification = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = trim($_POST["name"]);
            $avatar = $_FILES["avatar"]["name"];
            $description = trim($_POST["description"]);
            $schoolYear = $_POST["school_year"];

            // Check if the subject name is entered
            if (empty($name)) {
                $notification = "Hãy nhập môn học";
            }

            // Check if the subject name is below 100 characters
            elseif (strlen($name) > 100) {
                $notification = "Không nhập quá 100 từ";
            }

            // Check if the avatar is chosen
            elseif (empty($avatar)) {
                $notification = "Hãy chọn avatar";
            }

            // Check if the description is entered
            elseif (empty($description)) {
                $notification = "Hãy mô tả chi tiết";
            }

            // Check if the description is below 1000 characters
            elseif (strlen($description) > 1000) {
                $notification = "Hãy nhập dưới 1000 từ";
            }

            // Check if the school year is selected
            elseif (empty($schoolYear)) {
                $notification = "Hãy chọn khóa học";
            }

        }
        $this->view("subject/adding_subject",[
            "notification" => $notification
        ]);
    }
    public function showinfor() {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $name = isset($_POST["name"]) ? $_POST["name"] : '';
            $description = isset($_POST["description"]) ? $_POST["description"] : '';
            $school_year = isset($_POST["school_year"]) && !empty($_POST["school_year"]) ? $_POST["school_year"] : array();
            
            $notification = "";
            $flag = true;
            if (empty($name)){
                $notification = "Hãy nhập tên môn học";
                $flag = false;
            } elseif (strlen($name) > 100){
                $flag = false;
                $notification = "Tên môn học không nhập quá 100 ký tự";
            } elseif (empty($school_year)){
                $flag = false;
                $notification = "Hãy nhập khoá học";
            } elseif (empty($description)){
                $flag = false;
                $notification = "Hãy nhập mô tả chi tiết";
            } elseif (strlen($description) > 1000) {
                $flag = false;
                $notification = "Mô tả chi tiết không nhập quá 1000 ký tự";
            } elseif (empty($_POST['hidden_img']) && empty($_FILES['avatar']['name'])) {
                $flag = false;
                $notification = "Hãy chọn avatar";
            }

            if (!$flag){
                return $this->view("subject/adding_subject", [
                    "name" => $name,
                    "school_year" => implode(',', $school_year),
                    'description' => $description,
                    'avatar' => !empty($_POST['hidden_img']) ? $_POST['hidden_img'] : '',
                    'notification' => $notification
                ]);
            }
            
            if (!empty($_FILES['avatar']['name'])) {
                $avatar_name = basename($_FILES["avatar"]["name"]);

                $unique_string = uniqid();
                $unique_string = substr($unique_string, -6);

                $avatar_name_with_unique = $unique_string . '_' . $avatar_name;

                $target_dir = "web/avatar/tmp/";
                $target_file = $target_dir . $avatar_name_with_unique;
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                if ($_FILES["avatar"]["size"] > 500000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }

                if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }

                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                    header("location: index");
                } else {
                    if (!empty($_POST['hidden_img'])) {
                        $imagePath = $target_dir . $_POST['hidden_img'];

                        if (file_exists($imagePath)) {
                            unlink($imagePath);
                            
                        } else {
                            echo "Image does not exist!";
                        }
                    }

                    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                        return $this->view("subject/confirm_adding_subject", [
                            "name" => $name,
                            "school_year" => $school_year,
                            "description" => $description,
                            "avatar" => $avatar_name_with_unique,
                        ]);
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                        header("location: index");
                    }
                }
            } else {
                if (!empty($_POST['hidden_img'])) {
                    return $this->view("subject/confirm_adding_subject", [
                        "name" => $name,
                        "school_year" => $school_year,
                        "description" => $description,
                        "avatar" => $_POST['hidden_img'],
                    ]);
                } else {
                    header("location: index");
                }
            }
        }
    }


    public function complete(){
        $this->view("complete/complete");
    }
    public function search_subject() {
        $this->view("subject/search_subjects");
    }
    private $model;

    public function __construct() {
        include_once"app/model/subject.php";
        $this->model = new subject();
        
    }
    public function delete() {
        if (isset($_POST['delete'])) {
            $my_model = $this->model("subject");
            $subject_id_to_delete = $_POST['subject_id'];
            $rs = $my_model->delete_subject($subject_id_to_delete);

            if ($rs) {
                header("Location: search_and_delete");
                exit(); // Add exit to stop further execution
            } else {
                ?>
                <script type="text/javascript">alert("Xảy ra lỗi")</script>
                <?php
                header("Location: index.php");
                exit(); // Add exit to stop further execution
            }
        }
    }

    public function search_and_delete() {
        // Process the form submission and retrieve data
        $name_filter = isset($_GET['name']) ? $_GET['name'] : '';
        $school_year_filter = isset($_GET['school_year']) ? $_GET['school_year'] : '';
        // var_dump($school_year_filter);
        // die();

        $subject_model = $this->model("subject");
    
        // Retrieve subjects using the model
        $subjects = $subject_model->getsubjects($name_filter,  $school_year_filter);
    
        // Handle delete action
    
        // Load the view
        $this->view('subject/search_subjects', ['subjects' => $subjects]);
    }
    
    public function confirm_update() {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $view = "subject/confirm_modify";
            $subject_id = $_POST['subject_id'];

            $subject_model = $this->model("subject");

            $subject = $subject_model->read_subject_by_id($subject_id);

            $name = $_POST['name'];
            $avatar = $_POST['hidden_image'];
            $description = $_POST['description'];
            $school_year = $_POST['school_year'];

            if (!empty($_FILES["new_avatar"]['name'])){
                $avatar_name = basename($_FILES["new_avatar"]["name"]);

                $unique_string = uniqid();
                $unique_string = substr($unique_string, -6);

                $avatar_name_with_unique = $unique_string . '_' . $avatar_name;

                $target_dir = "web/avatar/tmp/";
                $target_file = $target_dir . $avatar_name_with_unique;
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                if ($_FILES["new_avatar"]["size"] > 500000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }

                if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }

                if ($uploadOk == 0) {

                    echo "Sorry, your file was not uploaded.";
                    header("location: index");
                } else {
                    if (!empty($_POST['hidden_image'])) {
                        $imagePath = $target_dir . $_POST['hidden_image'];

                        // if (file_exists($imagePath)) {
                        //     unlink($imagePath);
                            
                        // } else {
                        //     echo "Image does not exist!";
                        // }
                    }
                    if (move_uploaded_file($_FILES["new_avatar"]["tmp_name"], $target_file)) {
                        $avatar = $avatar_name_with_unique;
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }

                    
                }
            }
            return $this->view($view, [
                    "subject_id" => $subject_id,
                    "name" => $name,
                    "avatar" => $avatar,
                    "description" => $description,
                    "school_year" => $school_year
                ]);


        } else {
            header("location: index.php");
        }

        
    }
    public function modify_subject(){
        $model = $this->model("subject");
        $subject_id = $_POST['subject_id'];

        $subject = $model->read_subject_by_id($subject_id);

        // $name = $subject->name;
        // $avatar = $subject->avatar;
        // $description = $subject->description;
        // $school_year = $subject->school_year;
        $name = isset($_POST['name']) ? $_POST['name'] : $subject->name;
        $avatar = $subject->avatar;
        $description = isset($_POST['description']) ? $_POST['description'] : $subject->description ;
        $school_year = isset($_POST['school_year']) ? $_POST['school_year'] : $subject->school_year;

        $view = "subject/modify_subject";
         return $this->view($view, [
            "subject_id" => $subject_id,
            "name" => $name,
            "avatar" => $avatar,
            "description" => $description,
            "school_year" => $school_year
        ]);
    }

    public function insert_subject(){
        
        $my_model = $this->model("subject");

        $name = $_POST['name'];
        $avatar = $_POST['avatar'];
        $description = $_POST['description'];
        $school_year = $_POST['school_year'];
        // var_dump($_POST['school_year']);
        // die();
        $rs = $my_model->insert_subject($name, $avatar, $description, $school_year);
        if ($rs){
            header("location: complete");
        } else {
            header("location: index");
        }
    }

    public function modify(){
        $model = $this->model("subject");

        $subject_id = $_POST['subject_id'];
        $name = $_POST['name'];
        $avatar = $_POST['avatar'];
        $description = $_POST['description'];
        $school_year = $_POST['school_year'];

        $rs = $model->update_subject($subject_id, $name, $avatar, $description, $school_year);
        if ($rs){
            header("location: complete");
        } else {
            header("location: index");
        }
    }
    
}

?>