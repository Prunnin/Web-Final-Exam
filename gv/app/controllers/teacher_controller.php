<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../common/db.php";
    $database = new Database("localhost", "schedule_management", "tam", "1");
    $db = $database->get_connection();


    $name = $_POST["name"];
    $department = $_POST["department"];
    $degree = $_POST["degree"];
    $description = $_POST["description"];
    $file_name = $_POST["name_avatar"];
    $old_file = $_POST["old_path"];
    
    include "../model/teacher_regis_edit.php";
    $teacher = new Teacher($name, $file_name, $description, $department, $degree);
    $teacher_id = $_POST["id"];
    if ($teacher_id == "") {
        if ($teacher->create_teacher($db)) {
            $teacher_id = $teacher->get_id($db)[0]["id"];
            if (!file_exists("../../web/avatar/$teacher_id")) {
                // Tạo thư mục mới với quyền truy cập 0755 (có thể điều chỉnh theo nhu cầu)
                if (mkdir("../../web/avatar/$teacher_id")) {

                    // echo 'Thư mục đã được tạo thành công.';
                    if (rename("../../web/avatar/tmp/" . $file_name, "../../web/avatar/$teacher_id/" . $file_name)) {
                        // echo 'File moved successfully.';
                        chmod("../../web/avatar/$teacher_id/" . $file_name, 0666);
                        echo json_encode(array("id" => $teacher_id));
                    } // else {
                    //     echo 'Failed to move file.';
                    // }
                } else {
                    if (rename("../../web/avatar/tmp/" . $file_name, "../../web/avatar/$teacher_id/" . $file_name)) {
                        // echo 'File moved successfully.';
                        chmod("../../web/avatar/$teacher_id/" . $file_name, 0666);
                        echo json_encode(array("id" => $teacher_id));
                    }
                }
            }
            // else {
            //     echo 'Thư mục đã tồn tại.';
            // }
        } else {
            echo  json_encode(array("id" => -1));
        }
    }else{
        if ($file_name != ""){
            if (file_exists("../../web/avatar/$teacher_id/" . $old_file)) {
                // Kiểm tra xem tệp tồn tại hay không
                unlink("../../web/avatar/$teacher_id/" . $old_file);               
            }
            if (rename("../../web/avatar/tmp/" . $file_name, "../../web/avatar/$teacher_id/" . $file_name)) {
                // echo 'File moved successfully.';
                chmod("../../web/avatar/$teacher_id/" . $file_name, 0666);
            }
        }else{
            $teacher->set_avatar($old_file);
        }

        $teacher->update_teacher($teacher_id, $db);
        echo json_encode(array("id" => $teacher_id));
        
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") { // get infor of teacher
    require_once "../common/db.php";
    $database = new Database("localhost", "schedule_management", "tam", "1");
    $db = $database->get_connection();
    $teacher_id = "";
    if (isset($_GET["id"])) {
        $teacher_id = $_GET["id"];
    } else {
        // echo  json_encode(array("id" => -1));
        header("Location: ../../index.php");
        exit();
    }

    include "../model/teacher_regis_edit.php";

    $teacher = new Teacher("", "", "", "", "");

    $teacher_info = $teacher->get_teacher_by_id($teacher_id, $db);

    if (!$teacher_info) {
        echo  json_encode(array("id" => -1));
        exit();
    }

    echo json_encode($teacher_info);
} else {
    echo  json_encode(array("id" => -1));
}
