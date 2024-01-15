
<p>Tên môn học: <?php echo $data["name"]; ?></p>
<p>Mô tả chi tiết: <?php echo $data['description']; ?></p>
<p>Avatar: <img src = "web/avatar/tmp/<?php echo $data['avatar']; ?>"></p>
<p>Khóa học: <?php echo $data['school_year']; ?></p>

<form id="myForm" method="POST">
    <input type="hidden" name="subject_id" value="<?php echo $data['subject_id']; ?>">
    <input type="hidden" name="name" value="<?php echo $data['name']; ?>">
    <input type="hidden" name="avatar" value="<?php echo $data['avatar']; ?>">
    <input type="hidden" name="description" value="<?php echo $data['description']; ?>">
    <input type="hidden" name="school_year" value="<?php echo $data['school_year']; ?>">
</form>

 <div style="display: flex;">
    <button class="btn_button" type="button" name="btn_modifier" id="btn_modifier">Sửa lại</button>
    <button class="btn_button" type="button" name="btn_submit" id="btn_submit">Đăng ký</button>
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