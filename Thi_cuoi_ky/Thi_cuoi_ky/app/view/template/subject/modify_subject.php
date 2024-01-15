<div id="notification"><?php if (!empty($notification))
 echo $notification; ?></div>

<form action="subject/confirm_update" method="post" enctype="multipart/form-data">
    <input type="hidden" name="subject_id" value="<?php echo $data['subject_id']; ?>">

    <label for="name">Tên môn học</label>
    <input type="text" name="name" value="<?php echo $data['name']; ?>" required>

    <label for="school_year">Khóa học</label>
    <select name="school_year" required>
        <option value="Năm 1" <?php echo (ucfirst($data['school_year']) == 'Năm 1') ? 'selected' : ''; ?>>Năm 1</option>
        <option value="Năm 2" <?php echo (ucfirst($data['school_year']) == 'Năm 2') ? 'selected' : ''; ?>>Năm 2</option>
        <option value="Năm 3" <?php echo (ucfirst($data['school_year']) == 'Năm 3') ? 'selected' : ''; ?>>Năm 3</option>
        <option value="Năm 4" <?php echo (ucfirst($data['school_year']) == 'Năm 4') ? 'selected' : ''; ?>>Năm 4</option>
    </select>

    <label for="description">Mô tả chi tiết</label>
    <textarea name="description" rows="4" required><?php echo $data['description']; ?></textarea>

    <label for="avatar">Avatar</label>
    <img src="web/avatar/tmp/<?php echo $data['avatar']; ?>" alt="Current Avatar" style="max-width: 100px; max-height: 100px;">

    <!-- Input to choose a new avatar image -->
    <input type="file" name="new_avatar" accept="image/*">
    <input type="hidden" name="hidden_image" value="<?php echo $data['avatar']; ?>">
    <input type="submit" value="Xác nhận">
</form>