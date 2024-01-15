
<link rel="stylesheet" type="text/css" href="web/css/teacher.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



<body id="body">
    <?php
    $teacher_id = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["id"])) {
            $teacher_id = $_POST["id"];
        } else {
            header("Location: index.php");
            exit();
        }
    } else {
        header("Location: index.php"); 
        exit();
    }
    ?>

    <form style="margin-top: 0.5cm;" id="regis_form" action="teacher/teacher_confirm" method="post" enctype="multipart/form-data">
        <?php
        $depart = array(
            "000" => "",
            "001" => "Khoa học máy tính",
            "002" => "Khoa học dữ liệu",
            "003" => "Hải dương học"
        );

        $degree = array(
            "000" => "",
            "001" => "Cử nhân",
            "002" => "Thạc sĩ",
            "003" => "Tiến sĩ",
            "004" => "Phó giáo sư",
            "005" => "Giáo sư"
        );
        ?>
        <input type="text" style="display: none;" id="id_teacher" name="id" value=<?php echo $teacher_id; ?>>

        <fieldset style=" align-items: flex-start;">
            <label id="name_label" for="name">Họ và Tên</label>
            <input style="margin-left: 0.23cm;" type="text" id="input_name" name="name" maxlength="100">
        </fieldset>
        <div class="alert_validate" id="alert_name"></div>

        <fieldset>
            <label id="deparment_label" for="department">Bộ môn</label>
            <select style="margin-left: 0.65cm;" id="input_department" name="department">
                <?php
                foreach ($depart as $key => $value) :

                    echo '<option value="' . $key . '">' . $value . '</option>'; //close your tags!!

                endforeach;
                ?>
            </select>
        </fieldset>
        <div class="alert_validate" id="alert_depart"></div>

        <fieldset>
            <label id="degree_label" for="degree">Học vị</label>
            <select style="margin-left: 0.85cm;" id="input_degree" name="degree">
                <?php
                foreach ($degree as $key => $value) :

                    echo '<option value="' . $key . '">' . $value . '</option>'; //close your tags!!

                endforeach;
                ?>
            </select>
        </fieldset>
        <div class="alert_validate" id="alert_degree"></div>

        <fieldset style="display: flex; flex-direction: column; align-items: flex-start; margin-bottom:-1cm;">
            <label id="avatar_label" for="avatar">Avatar</label>
            <div style="display: flex; align-items: center;">
                <img style="  width: 200px; height: 100px; margin-left: 14.7cm;" id="img_teacher" src='' alt='Avatar'>
                <input type="text" id="old_avatar" name="old_avatar" style="display: none;" value="">
            </div>

            <div style="display: flex; align-items: center; margin-bottom:0;">
                <div style="margin-left: 14.7cm;" id="filePathDisplay"></div>
                <label style="
            margin-left: 0cm;
            padding: 13px 12px 9px 12px;
            border: 1px solid rgb(29, 21, 21);
            background-color: #5983d6;
        " for="input_avatar" class="btn">Browse</label>
            </div>

            <input type="text" style="display: none;" name="name_avatar" id="name_avatar">
            <input type="file" style="visibility: hidden;" id="input_avatar" name="avatar" accept=".jpg, .png, .jpeg">
        </fieldset>
        <div class="alert_validate" id="alert_avatar"></div>

        <fieldset style="margin-top:0;">
            <label id="description_lael" for="description">Mô tả thêm</label>
            <textarea id="input_description" name="description" rows="7" cols="80" maxlength="1000"></textarea>
        </fieldset>
        <div class="alert_validate" id="alert_description"></div>

        <fieldset style="text-align: center;display:block;">
            <button id="buton_register" type="submit">Xác nhận</button>
        </fieldset>
    </form>


<script>
    let teacher_id = <?php echo $teacher_id; ?>;
    $.ajax({
        type: "GET",
        url: "teacher/get_teacher?id=" + teacher_id,
        success: function(response) {

            let result = JSON.parse(response) /* assume you have the data from PHP in a variable named 'result' */ ;
            console.log(JSON.stringify(result));
            if (result["id"] != -1) {
                document.getElementById("input_name").value = result["name"];
                document.getElementById("input_department").value = result["specialized"];
                document.getElementById("input_degree").value = result["degree"];
                document.getElementById('img_teacher').src = "web/avatar/" + teacher_id + "/" + result["avatar"];
                document.getElementById("filePathDisplay").textContent = result["avatar"];
                document.getElementById("old_avatar").value = result["avatar"];
                document.getElementById("input_description").value = result["description"];

                var name = '<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>';
                if (name) {
                    document.getElementById('input_name').value = name;
                }

                var department = '<?php echo isset($_POST['department']) ? $_POST['department'] : ''; ?>';
                if (department) {
                    document.getElementById('input_department').value = department;
                }

                var degree = '<?php echo isset($_POST['degree']) ? $_POST['degree'] : ''; ?>';
                if (degree) {
                    document.getElementById('input_degree').value = degree;
                }

                var description = '<?php echo isset($_POST['description']) ? $_POST['description'] : ''; ?>';
                if (description) {
                    document.getElementById('input_description').value = description;
                }

                var avatar = '<?php echo isset($_POST['avatar']) ? $_POST['avatar'] : ''; ?>';
                if (avatar) {
                    // Hiển thị ảnh đã chọn (nếu có)
                    document.getElementById("filePathDisplay").textContent = avatar;
                    document.getElementById("name_avatar").value = avatar;
                }

            } else {
                alert("error when find information of the teacher");
                window.location.href = 'index.php'
            }

        },
        error: function(error) {
            document.getElementById("test_result").innerHTML = JSON.stringify(error);
            console.error('Error:', error);
        }
    });
</script>
<script type="text/javascript" src="web/javascript/teacher.js"></script>
