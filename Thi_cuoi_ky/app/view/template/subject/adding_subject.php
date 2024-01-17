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

    .my-btn {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #99bbf4;
    color: #fff;  /* Màu chữ */
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    }

    .my-btn:hover {
        background-color: #4c87ae;
    }
</style>
<?php
// var_dump($data);
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">

<div class="container_s container">
    <div><?php echo isset($data['avatar']) && !empty($data['avatar']) ? '<img src = "web/avatar/tmp/'.$data['avatar'].'" style="max-height: 100px;"' : ''; ?></div>
    <form action="subject/showinfor" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
    <div id="notification" style="color: red; width: 100%;"><?php if (!empty($data['notification']) && isset($data['notification'])) echo $data['notification']; ?></div>    
    <div class="input-group">
            <label for="name">Tên môn học</label>
            <input type="text" name="name" class="entering" value="<?php echo isset($data['name']) ? $data['name'] : ''; ?>">
        </div>

        <div class="input-group">
            <label for="school_year">Khóa</label>
            <select name="school_year[]" id="multiple_select" multiple>
                <option value="Năm 1" <?php echo isset($data['school_year']) && in_array('Năm 1', explode(",", $data['school_year'])) ? 'selected' : ''; ?>>Năm 1</option>
                <option value="Năm 2" <?php echo isset($data['school_year']) && in_array('Năm 2', explode(",", $data['school_year'])) ? 'selected' : ''; ?>>Năm 2</option>
                <option value="Năm 3" <?php echo isset($data['school_year']) && in_array('Năm 3', explode(",", $data['school_year'])) ? 'selected' : ''; ?>>Năm 3</option>
                <option value="Năm 4" <?php echo isset($data['school_year']) && in_array('Năm 4', explode(",", $data['school_year'])) ? 'selected' : ''; ?>>Năm 4</option>
            </select>
        </div>


        <div class="input-group">
            <label for="description">Mô tả chi tiết</label>
            <textarea name="description" rows="4" class="entering"><?php echo isset($data['description']) ? $data['description'] : ''; ?></textarea>
        </div>
            
        <div class="input-group">

            <label for="avatar">Avatar</label>
            <input type="file" name="avatar" class="avatar entering" accept="image/*" >
        </div>
        
        <input type="hidden" name="hidden_img" value="<?php echo isset($data['avatar']) ? $data['avatar'] : ''; ?>">
        <input type="submit" class="my-btn" value="Xác nhận">
    </form>
</div><script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>
<script>
    new MultiSelectTag('multiple_select')  // id
</script>
