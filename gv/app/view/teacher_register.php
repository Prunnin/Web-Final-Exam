<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../../web/css/teacher.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>


<body id="body">
    <form style="margin-top: 2cm;" id="regis_form" action="teacher_confirm.php" method="post" enctype="multipart/form-data">
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
        <fieldset>
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

        <fieldset style="display: flex;">
            <label id="avatar_label" for="avatar">Avatar</label>
            <div style="margin-left: 0.85cm;" id="filePathDisplay"></div>
            <!-- <button id="chose_file_button" onclick="document.getElementById('input_avatar').click()">Browse</button> -->
            <label style="
                margin-left: 0;
                padding: 12px 12px 8px 12px;
                border: 2px solid rgb(29, 21, 21);
                background-color: #5983d6;
            " for="input_avatar" class="btn">Browse</label>
            <input type="text" style="display: none;" name="name_avatar" id="name_avatar">
            <input type="file" style="visibility: hidden;" id="input_avatar" name="avatar" accept=".jpg, .png, .jpeg">
        </fieldset>
        <div class="alert_validate" id="alert_avatar"></div>

        <fieldset>
            <label id="description_lael" for="description">Mô tả thêm</label>
            <textarea id="input_description" name="description" rows="7" cols="80" maxlength="1000"></textarea>
        </fieldset>
        <div class="alert_validate" id="alert_description"></div>

        <fieldset style="text-align: center;display:block;">
            <button id="buton_register" type="submit">Xác nhận</button>
        </fieldset>
    </form>

    <script type="text/javascript" src="../../web/js/teacher.js"></script>
    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        // Kiểm tra nếu có giá trị truyền từ URL, thì điền giá trị vào các trường input
        var name = '<?php echo isset($_GET['name']) ? $_GET['name'] : ''; ?>';
        if (name) {
            document.getElementById('input_name').value = name;
        }

        var department = '<?php echo isset($_GET['department']) ? $_GET['department'] : ''; ?>';
        if (department) {
            document.getElementById('input_department').value = department;
        }

        var degree = '<?php echo isset($_GET['degree']) ? $_GET['degree'] : ''; ?>';
        if (degree) {
            document.getElementById('input_degree').value = degree;
        }

        var description = '<?php echo isset($_GET['description']) ? $_GET['description'] : ''; ?>';
        if (description) {
            document.getElementById('input_description').value = description;
        }

        var avatar = '<?php echo isset($_GET['avatar']) ? $_GET['avatar'] : ''; ?>';
        if (avatar) {
            // Hiển thị ảnh đã chọn (nếu có)
            document.getElementById("filePathDisplay").textContent = avatar;
            document.getElementById("name_avatar").value = avatar;
        }
        // });
    </script>
</body>

</html>