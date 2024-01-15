<?php
// var_dump($data);
?>
<style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: auto;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        .btn_button{
            padding: 10px 50px;
            margin: 5px;
            background-color: #408abb;
            color: #edebe7;
            cursor: pointer;
        }
        .btn_button:hover{
            background-color: #4c87ae;
        }
    </style>
<div class="container">
        <h2>Confirm Data</h2>
    
        <table>
            <tr>
                <td>Tên môn học</td>
                <td><?php echo $data["name"]; ?></td>
            </tr>
            <tr>
                <td>Khóa</td>
                <td><?php echo $data["school_year"]; ?></td>
            </tr>
            <tr>
                <td>Mô tả chi tiết</td>
                <td><?php echo $data["description"]; ?></td>
            </tr>
            <tr>
                <td>Avatar</td>
                <td><img src="web/avatar/tmp/<?php echo $data['avatar']; ?>" style="max-height: 100px;"></td>
            </tr>
        </table>


        <form method="post" id="myForm">
            <input type="hidden" name="name" value="<?php echo $data["name"]; ?>">
            <input type="hidden" name="avatar" value="<?php echo $data["avatar"]; ?>">
            <input type="hidden" name="description" value="<?php echo $data["description"]; ?>">
            <input type="hidden" name="school_year" value="<?php echo $data["school_year"]; ?>">
            
        </form>
        <div style="display: flex;">
            <button class="btn_button" type="button" name="btn_modifier" id="btn_modifier">Sửa lại</button>
            <button class="btn_button" type="button" name="btn_submit" id="btn_submit">Đăng ký</button>
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
            $('#myForm').attr('action', 'subject/index');
        } else if (action === 'register') {
            $('#myForm').attr('action', 'subject/insert_subject');
        }

        $('#myForm').submit();
    }
</script>