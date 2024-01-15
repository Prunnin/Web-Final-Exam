<style type="text/css">
    .container_s {
        width: 600px!important;
        height: 500px;
        margin: 0 auto;
    }

    .input-group {
        display: flex;
        margin-bottom: 10px;
    }

    label {
        flex: 0 0 120px;
        text-align: right;
        margin-right: 10px;
    }

    .entering,
    .selectOption,
    .avatar {
        flex: 1;
        box-sizing: border-box;
    }

    .btn-container {
        display: block;
        width: 100%;
        background-color: #99bbf4;
    }
</style>
<?php
// var_dump($data);
?>
<div id="notification"><?php if (!empty($notification)) echo $notification; ?></div>
<div class="container_s container">
    <div><?php echo isset($data['avatar']) ? '<img src = "web/avatar/tmp/'.$data['avatar'].'" style="max-height: 100px;"' : ''; ?></div>
    <form action="subject/showinfor" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <div class="input-group">
            <label for="name">Tên môn học</label>
            <input type="text" name="name" class="entering" value="<?php echo isset($data['name']) ? $data['name'] : ''; ?>" required>
        </div>

        <div class="input-group">
            <label for="school_year">Khóa</label>
            <select name="school_year" class="selectOption entering">
                <option value="">Chọn khóa học:</option>
                <option value="năm 1" <?php echo isset($data['school_year']) && $data['school_year'] == "năm 1" ? 'selected' : ''; ?>>Năm 1</option>
                <option value="năm 2" <?php echo isset($data['school_year']) && $data['school_year'] == "năm 2" ? 'selected' : ''; ?>>Năm 2</option>
                <option value="năm 3" <?php echo isset($data['school_year']) && $data['school_year'] == "năm 3" ? 'selected' : ''; ?>>Năm 3</option>
                <option value="năm 4" <?php echo isset($data['school_year']) && $data['school_year'] == "năm 4" ? 'selected' : ''; ?>>Năm 4</option>
            </select>
        </div>


        <div class="input-group">
            <label for="description">Mô tả chi tiết</label>
            <textarea name="description" rows="4" class="entering" required><?php echo isset($data['description']) ? $data['description'] : ''; ?></textarea>
        </div>
            
        <div class="input-group">

            <label for="avatar">Avatar</label>
            <input type="file" name="avatar" class="avatar entering" accept="image/*" >
        </div>
        
        <input type="hidden" name="hidden_img" value="<?php echo isset($data['avatar']) ? $data['avatar'] : ''; ?>">
        <input type="submit" class="btn-container" value="Xác nhận">
    </form>
</div>
