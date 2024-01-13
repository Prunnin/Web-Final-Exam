<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style2.css">
    <title>Add Subject</title>
</head>
<body>
    <div id="notification"></div>
    <div class="container"> 
        <form action="confirm_adding_subject.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <label for="name">Tên môn học</label>
            <input type="text" name="name" class="entering" required><br>

            <label for="school_year">Khóa</label>
            <select name="school_year" class="selectOption" style="margin-left: 159px;">
                <option value="">Chọn khóa học:</option> 
                <option value="năm 1">Năm 1</option>
                <option value="năm 2">Năm 2</option>
                <option value="năm 3">Năm 3</option>
                <option value="năm 4">Năm 4</option>
            </select><br>

            <label for="description">Mô tả chi tiết</label>
            <textarea name="description" rows="4" class="entering"required></textarea><br>

            <label for="avatar">Avatar</label>
            <input type="file" name="avatar" class="avatar" accept="image/*" required><br>
            <input type="submit" class="button-container" value="Xác nhận">
        </form>

    </div>

    <script src="./javascript/addingsubject.js"></script>
</body>
</html>