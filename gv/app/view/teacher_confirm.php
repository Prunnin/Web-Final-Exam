<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation Page</title>
    <link rel="stylesheet" type="text/css" href="../../web/css/teacher.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div id="confirm_div">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy thông tin từ form
            $name = $_POST["name"];
            $department = $_POST["department"];
            $degree = $_POST["degree"];
            $description = $_POST["description"];

            // Xử lý file avatar (lưu vào thư mục avatar/tmp)
            $avatarDirectory = "../../web/avatar/tmp/";
            $file_name = $_POST["name_avatar"];
            $avatar_path = $avatarDirectory . $file_name;

            if (basename($_FILES["avatar"]["name"])) {
                move_uploaded_file($_FILES["avatar"]["tmp_name"], $avatar_path);
                // phan quyền cho ảnh 
                chmod($avatar_path, 0666);
            }
            $depart = array(
                "000" => "",
                "001" => "Khoa học máy tính",
                "002" => "Khoa học dữ liệu",
                "003" => "Hải dương học"
            );

            $deg = array(
                "000" => "",
                "001" => "Cử nhân",
                "002" => "Thạc sĩ",
                "003" => "Tiến sĩ",
                "004" => "Phó giáo sư",
                "005" => "Giáo sư"
            );
        } else {
            header("Location: ../../index.php");
            exit();
        }
        ?>

        <fieldset style="margin-top: 2cm;">
            <label id="name_label" for="name">Họ và Tên</label>
            <div style=" 
                margin-left: 0.3cm;
                display: flex; 
                align-items: center;
                height: 1cm;
                width: 8.13cm;
                border: 1px solid rgb(29, 21, 21);
                background-color: #d8d9db;"> <?php echo $name; ?> </div>
        </fieldset>


        <fieldset>
            <label id="deparment_label" for="department">Bộ môn</label>
            <div style=" 
                margin-left: 0.7cm;
                display: flex; 
                align-items: center;
                height: 1cm;
                width: 8.13cm;
                border: 1px solid rgb(29, 21, 21);
                background-color: #d8d9db;"> <?php echo $depart[$department]; ?> </div>
        </fieldset>

        <fieldset>
            <label id="degree_label" for="degree">Học vị</label>
            <div style=" 
                margin-left: 0.9cm;
                display: flex; 
                align-items: center;
                height: 1cm;
                width: 8.13cm;
                border: 1px solid rgb(29, 21, 21);
                background-color: #d8d9db;"> <?php echo $deg[$degree]; ?> </div>
        </fieldset>


        <fieldset style="display: flex;">
            <label id="avatar_label" for="avatar">Avatar</label>
            <div style="margin-left: 0.9cm;">
                <img style="  width: 300px; height: 200px; " id="img_teacher" src="<?php if ($file_name) {
                                                                                        echo $avatar_path;
                                                                                    } else {
                                                                                        echo "../../web/avatar/" . $_POST["id"] . "/" . $_POST["old_avatar"];
                                                                                    } ?>" alt='Avatar'>
            </div>
        </fieldset>


        <fieldset>
            <label id="description_lael" for="description">Mô tả thêm</label>
            <div style=" 
                height: 4cm;
                width: 15cm;
                border: 1px solid rgb(29, 21, 21);
                background-color: #d8d9db;"> <?php echo $description; ?> </div>
        </fieldset>

        <?php
        if (isset($_POST["id"])) {

        ?>
            <form id="form_change" action="../view/teacher_adjust.php" method="post" style="display: none;">
                <input type="text" name="id" value="<?php echo $_POST["id"]; ?>">
                <input type="text" name="name" value="<?php echo $name; ?>">
                <input type="text" name="department" value="<?php echo $department; ?>">
                <input type="text" name="degree" value="<?php echo $degree; ?>">
                <input type="text" name="avatar" value="<?php echo $file_name; ?>">
                <input type="text" name="description" value="<?php echo $description; ?>">

            </form>
        <?php
        }
        ?>
        <fieldset style="text-align: center;display:block;">
            <?php
            if (isset($_POST["id"])) {
                echo "<button onclick=\"$('#form_change').submit();\">Sửa lại</button>";
            } else {
                echo "<button onclick=\"window.location.href='teacher_register.php?name=$name&department=$department&degree=$degree&description=$description&avatar=$file_name'\">Sửa lại</button>";
            }
            ?>
            <button type="button" id="confirm_button">Đăng ký</button>
        </fieldset>
    </div>
    <!-- <p id="test_result"> asdasd </p> -->
    <div id="done" style="height: 100%; width: 100%; display: none; text-align: center;">
        <p style="margin-top: 20%;">Bạn đã đăng ký thành công</p>
        <a href="../../index.php"><u>Trở về trang chủ</u></a>
    </div>
    <script>
        $("#confirm_button").click(function() {

            $.ajax({
                type: "POST",
                url: "../controllers/teacher_controller.php",
                data: {
                    id: "<?php echo isset($_POST['id']) ? $_POST['id'] : ''; ?>",
                    old_path: "<?php echo isset($_POST['old_avatar']) ? $_POST['old_avatar'] : ''; ?>",
                    name: "<?php echo $name ?>",
                    department: "<?php echo $department ?>",
                    degree: "<?php echo $degree ?>",
                    description: "<?php echo $description ?>",
                    name_avatar: "<?php echo $file_name ?>",
                    button: "confirm"
                },
                success: function(response) {


                    let result = JSON.parse(response) /* assume you have the data from PHP in a variable named 'result' */ ;
                    console.log(JSON.stringify(result));
                    if (result["id"] != -1) {
                        document.getElementById("done").style.display = "block";
                        document.getElementById("confirm_div").style.display = "none";
                    } else {
                        alert("error");
                    }

                },
                error: function(error) {
                    document.getElementById("test_result").innerHTML = JSON.stringify(error);
                    console.error('Error:', error);
                }
            });
        });
    </script>
</body>

</html>