<link rel="stylesheet" href="web/css/subject.css">
<div class="container"> 
    <form action="schedule/confirm_update_schedule" method="post">
        <input type="hidden" name="update_id"value="<?php echo $data['update_id']; ?>">
        
        <label for="school_year">Năm học</label>
        <select name="school_year" class="option" required>
            <option value="Năm 1" <?php echo isset($data['data']->school_year) && $data['data']->school_year == 'Năm 1' ? 'selected' : ''; ?>>Năm 1</option>
            <option value="Năm 2" <?php echo isset($data['data']->school_year) && $data['data']->school_year == 'Năm 2' ? 'selected' : ''; ?>>Năm 2</option>
            <option value="Năm 3" <?php echo isset($data['data']->school_year) && $data['data']->school_year == 'Năm 3' ? 'selected' : ''; ?>>Năm 3</option>
            <option value="Năm 4" <?php echo isset($data['data']->school_year) && $data['data']->school_year == 'Năm 4' ? 'selected' : ''; ?>>Năm 4</option>
        </select><br>

        <label for="subject_id">Môn học</label>
        <select name="subject_id" class="option" required>
            <?php
            foreach($data['subjects'] as $key => $value) {
                $selected = isset($data['data']->subject_id) && $data['data']->subject_id == $value->id ? 'selected' : '';
            ?>
                <option value="<?php echo $value->id; ?>" <?php echo $selected; ?>><?php echo $value->name; ?></option>
            <?php
            }
            ?>
        </select><br>


        <label for="teacher_id">Giáo viên</label>
        <select name="teacher_id" class="option" required>
            <?php
            foreach($data['teachers'] as $key => $value) {
                $selected = isset($data['data']->teacher_id) && $data['data']->teacher_id == $value->id ? 'selected' : '';
            ?>
                <option value="<?php echo $value->id; ?>" <?php echo $selected; ?>><?php echo $value->name; ?></option>
            <?php
            }
            ?>
        </select><br>

        <label for="week_day">Thứ</label>
        <select name="week_day" class="option" required>
            <option value="" <?php echo isset($data['data']->week_day) && $data['data']->week_day == '' ? 'selected' : ''; ?>></option>
            <option value="Thứ 2" <?php echo isset($data['data']->week_day) && $data['data']->week_day == 'Thứ 2' ? 'selected' : ''; ?>>Thứ 2</option>
            <option value="Thứ 3" <?php echo isset($data['data']->week_day) && $data['data']->week_day == 'Thứ 3' ? 'selected' : ''; ?>>Thứ 3</option>
            <option value="Thứ 4" <?php echo isset($data['data']->week_day) && $data['data']->week_day == 'Thứ 4' ? 'selected' : ''; ?>>Thứ 4</option>
            <option value="Thứ 5" <?php echo isset($data['data']->week_day) && $data['data']->week_day == 'Thứ 5' ? 'selected' : ''; ?>>Thứ 5</option>
            <option value="Thứ 6" <?php echo isset($data['data']->week_day) && $data['data']->week_day == 'Thứ 6' ? 'selected' : ''; ?>>Thứ 6</option>
            <option value="Thứ 7" <?php echo isset($data['data']->week_day) && $data['data']->week_day == 'Thứ 7' ? 'selected' : ''; ?>>Thứ 7</option>
            <option value="Chủ Nhật" <?php echo isset($data['data']->week_day) && $data['data']->week_day == 'Chủ Nhật' ? 'selected' : ''; ?>>Chủ Nhật</option>
        </select><br>


        <label for="lesson" class="lession">Tiết học</label><br>
        <?php
        $lessonsFromDatabase = isset($data['data']->lession) ? explode(",",trim($data['data']->lession)) : array();
    
        echo '<div class="optionLession" style="display: flex; flex-direction: row;">';

        for ($i = 1; $i <= 10; $i++) {
            $checked = in_array($i, $lessonsFromDatabase) ? 'checked' : '';
            echo '<label style="margin-right: 10px;"><input type="checkbox" name="lesson[]" value="' . $i . '" ' . $checked . '> Tiết ' . $i . '</label>';
        }

        echo '</div>';
        ?>
        <br>

        <label for="notes">Chú ý </label>
        <textarea class="option" name="notes" rows="4"><?php echo isset($data['data']->notes) ? $data['data']->notes : ''; ?></textarea><br>


        <input type="submit" class="button-container" value="Xác nhận">
    </form>
    </div>

    <script>
    document.querySelector('form').addEventListener('submit', function(event) {
        var checkboxes = document.querySelectorAll('input[name="lesson[]"]');
        var isChecked = Array.prototype.some.call(checkboxes, function(checkbox) {
            return checkbox.checked;
        });

        if (!isChecked) {
            alert('Vui lòng chọn ít nhất một tiết học.');
            event.preventDefault();
        }
    });
</script>