<body>
    <div id="notification"></div>
    <div class="container"> 
        <form action="schedule/confirm_add_schedule" method="post" style="padding: 10px;">
            <label for="school_year">Khóa</label>
            <select name="school_year" class="selectOption entering" style="margin-left: 159px;">
                <option value="năm 1" <?php echo isset($data['data']['school_year']) && $data['data']['school_year'] == "năm 1" ? "selected" : '' ?>>Năm 1</option>
                <option value="năm 2" <?php echo isset($data['data']['school_year']) && $data['data']['school_year'] == "năm 2" ? "selected" : '' ?>>Năm 2</option>
                <option value="năm 3" <?php echo isset($data['data']['school_year']) && $data['data']['school_year'] == "năm 3" ? "selected" : '' ?>>Năm 3</option>
                <option value="năm 4" <?php echo isset($data['data']['school_year']) && $data['data']['school_year'] == "năm 4" ? "selected" : '' ?>>Năm 4</option>
            </select><br>

            <label for="subject_id">Môn học</label>
            <select name="subject_id" class="option entering" required>
                <?php
                foreach($data['subjects'] as $key => $value) {
                    $selected = (isset($data['data']['subject_id']) && $data['data']['subject_id'] == $value->id) ? 'selected' : '';
                    echo '<option value="' . $value->id . '" ' . $selected . '>' . $value->name . '</option>';
                }
                ?>
            </select><br>

            <label for="teacher_id">Giáo viên</label>
            <select name="teacher_id" class="option entering" required>
                <?php
                foreach($data['teachers'] as $key => $value) {
                    $selected = (isset($data['data']['teacher_id']) && $data['data']['teacher_id'] == $value->id) ? 'selected' : '';
                    echo '<option value="' . $value->id . '" ' . $selected . '>' . $value->name . '</option>';
               
                }
                ?>
            </select><br>

            <label for="lesson" class="lession">Tiết học</label><br>
                <?php
            
                echo '<div class="optionLession" style="display: flex; flex-direction: row;">';

                for ($i = 1; $i <= 10; $i++) {
                    $isChecked = (isset($data['data']['lesson']) && in_array($i, $data['data']['lesson'])) ? 'checked' : '';
                    echo '<label style="margin-right: 10px;"><input type="checkbox" name="lesson[]" value="' . $i . '" ' . $isChecked . '> Tiết ' . $i . '</label>';

                }

                echo '</div>';
                ?>
            <br>

            <label for="name">Thứ</label>
            <select name="week_day" class="option entering">
                <option value="Thứ 2" <?php echo isset($data['data']['week_day']) && $data['data']['week_day'] == "Thứ 2" ? 'selected' : ''; ?>>Thứ 2</option>
                <option value="Thứ 3" <?php echo isset($data['data']['week_day']) && $data['data']['week_day'] == "Thứ 3" ? 'selected' : ''; ?>>Thứ 3</option>
                <option value="Thứ 4" <?php echo isset($data['data']['week_day']) && $data['data']['week_day'] == "Thứ 4" ? 'selected' : ''; ?>>Thứ 4</option>
                <option value="Thứ 5" <?php echo isset($data['data']['week_day']) && $data['data']['week_day'] == "Thứ 5" ? 'selected' : ''; ?>>Thứ 5</option>
                <option value="Thứ 6" <?php echo isset($data['data']['week_day']) && $data['data']['week_day'] == "Thứ 6" ? 'selected' : ''; ?>>Thứ 6</option>
                <option value="Thứ 7" <?php echo isset($data['data']['week_day']) && $data['data']['week_day'] == "Thứ 7" ? 'selected' : ''; ?>>Thứ 7</option>
                <option value="Chủ Nhật" <?php echo isset($data['data']['week_day']) && $data['data']['week_day'] == "Chủ Nhật" ? 'selected' : ''; ?>>Chủ Nhật</option>
            </select><br>

            <label for="notes">Mô tả chi tiết</label>
            <textarea name="notes" rows="4" class="entering"required><?php echo isset($data['data']['notes']) ? $data['data']['notes'] : ''; ?></textarea><br>

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