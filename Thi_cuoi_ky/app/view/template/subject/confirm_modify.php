<style>
    .btn-container {
        background-color: lightgreen;
        color: black;
        padding: 5px;
        border-radius: 5px;
        width: 70px;
        height: 50px;
        margin: 10px;
        cursor: pointer;
    }

    table {
        border-collapse: collapse;
        width: 50%;
        margin: 20px auto;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .btn_button {
        padding: 10px 50px;
        margin: 5px;
        cursor: pointer;
        background-color: #99bbf4;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
    }

    .btn_button:hover {
        background-color: #4c87ae;
    }

</style>
<div class="container"> 
    <p>Tên môn học: <?php echo $data["name"]; ?></p>
    <p>Mô tả chi tiết: <?php echo $data['description']; ?></p>
    <p>Avatar: <img src = "web/avatar/tmp/<?php echo $data['avatar']; ?>" style="max-width: 100px;"></p>
    <p>Khóa học: <?php echo $data['school_year']; ?></p>

    <form id="myForm" method="POST">
        <input type="hidden" name="subject_id" value="<?php echo $data['subject_id']; ?>">
        <input type="hidden" name="name" value="<?php echo $data['name']; ?>">
        <input type="hidden" name="avatar" value="<?php echo $data['avatar']; ?>">
        <input type="hidden" name="description" value="<?php echo $data['description']; ?>">
        <input type="hidden" name="school_year" value="<?php echo $data['school_year']; ?>">
    </form>

    <div style="display: flex;">
        <button class="btn-container" type="button" name="btn_modifier" id="btn_modifier">Sửa lại</button>
        <button class="btn-container" type="button" name="btn_submit" id="btn_submit">Đăng ký</button>
    </div>
</div>



<script src="web/javascript/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#btn_modifier").click(function(){
            submitForm("edit");
        });

        $("#btn_submit").click(function(){
            submitForm("register");
        });
    });

    function submitForm(action) {
        if (action === 'edit') {
            $('#myForm').attr('action', 'subject/modify_subject');
        } else if (action === 'register') {
            $('#myForm').attr('action', 'subject/modify');
        }

        $('#myForm').submit();
    }
</script>