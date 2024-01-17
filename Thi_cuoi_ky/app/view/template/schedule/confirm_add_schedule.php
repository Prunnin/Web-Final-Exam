<link rel="stylesheet" href="web/css/subject.css">
<?php
$schoolYear = $data['data']['school_year'];
$subjectId = $data['data']['subject_id'];
$teacherId = $data['data']['teacher_id'];
$weekDay = $data['data']['week_day'];
$lessions = $data['data']['lesson'];
$notes = $data['data']['notes'];
// var_dump($data);
?>
<div class="container">
        <div>

            <div style="display: flex;">
                <label for="school_year" style="padding: 0 20px;">Năm học</label>
                <div><?php echo $schoolYear; ?></div>
            </div>
            <div style="display: flex;">
                <label for="subject_id" style="padding: 0 20px;">Môn học</label>
                <div><?php echo $data['subjects']->name; ?></div>
            </div>
            <div style="display: flex;">
                <label for="teacher_id" style="padding: 0 20px;">Giáo viên</label>
                <div><?php echo $data['teachers']->name; ?></div>
            </div>

            <div style="display: flex;">
                <label for="week_day" style="padding: 0 20px;">Thứ</label>
                <div> <?php echo $weekDay; ?></div>
            </div>
            <div style="display: flex;">
                <label for="lesson" class="lession" style="padding: 0 20px;">Tiết học</label><br>
                <div><?php
                echo "Tiết ".implode(",", $lessions);
                 ?></div>
            </div>
            <div style="display: flex;">
                <label for="notes" style="padding: 0 20px;">Chú ý </label>
                <div><?php echo $notes; ?></div>
            </div>
        </div>
        <div style="display: flex;">
            <form action="schedule/insert_schedule" method="post">
                <input type="hidden" name="school_year" value="<?php echo $schoolYear; ?>">
                <input type="hidden" name="subject_id" value="<?php echo $subjectId; ?>">
                <input type="hidden" name="teacher_id" value="<?php echo $teacherId; ?>">
                <input type="hidden" name="week_day" value="<?php echo $weekDay; ?>">
                <?php
                foreach ($lessions as $lesson) {
                    echo '<input type="hidden" name="lesson[]" value="' . $lesson . '">';
                }
                ?>
                <input type="hidden" name="notes" value="<?php echo $notes; ?>">
                <input class="register" type="submit" value="Đăng ký">
                
            </form>
            

            <form action="schedule/add_schedule" method="POST">
                <input type="hidden" name="school_year" value="<?php echo $schoolYear; ?>">
                <input type="hidden" name="subject_id" value="<?php echo $subjectId; ?>">
                <input type="hidden" name="teacher_id" value="<?php echo $teacherId; ?>">
                <input type="hidden" name="week_day" value="<?php echo $weekDay; ?>">
                <?php
                foreach ($lessions as $lesson) {
                    echo '<input type="hidden" name="lesson[]" value="' . $lesson . '">';
                }
                ?>
                <input type="hidden" name="notes" value="<?php echo $notes; ?>">
                <input class="re-modify" type="submit" value="Sửa lại">
            </form>
        </div>
    </div>
