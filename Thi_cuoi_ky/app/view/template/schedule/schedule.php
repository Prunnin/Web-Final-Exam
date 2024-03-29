<link rel="stylesheet" href="web/css/search_subjects.css"> 
<script>
        function confirmDelete(id) {
            var result = confirm("Are you sure you want to delete the schedule?");
            if (result) {
                // If the user clicks OK, submit the delete form
                document.getElementById('delete_form_' + id).submit();
            }
        }
    </script>
    <a href="home"><button><<</button><a>
<div class="container">

        <!-- Search form -->
        <form action="schedule/search" method="post">
            <div style="padding: 5px;">
                <label for="search_school_year">Khóa </label>
                <select name="search_school_year">
                    <option value=""></option>
                    <option value="Năm 1"<?php echo (ucfirst($data['search_school_year']) == "Năm 1" && !empty($data['search_school_year'])) ? "selected" : ''; ?>>Năm 1</option>
                    <option value="Năm 2"<?php echo (ucfirst($data['search_school_year']) == "Năm 2" && !empty($data['search_school_year'])) ? "selected" : ''; ?>>Năm 2</option>
                    <option value="Năm 3"<?php echo (ucfirst($data['search_school_year']) == "Năm 3" && !empty($data['search_school_year'])) ? "selected" : ''; ?>>Năm 3</option>
                    <option value="Năm 4"<?php echo (ucfirst($data['search_school_year']) == "Năm 4" && !empty($data['search_school_year'])) ? "selected" : ''; ?>>Năm 4</option>
                </select>
                
            </div>
            <div style="padding: 5px;">
                <label for="search_subject">Môn học </label>
                <select name="search_subject" id="search_subject">
                    <option value=""></option>
                    <?php
                        foreach ($data['subjects'] as $key => $value) {
                    ?>
                        <option value="<?php echo $value->name; ?>" <?php echo $value->name == $data['search_subject'] ? "selected" : '' ?>><?php echo $value->name; ?></option>
                    <?php
                        }
                    ?>
                    
                </select>
            </div>
            <div style="padding: 5px;">
                <label for="search_teacher">Giáo viên</label>
                <select name="search_teacher" id="search_teacher">
                    <option value=""></option>
                    <?php
                        foreach ($data['teachers'] as $key => $value) {
                    ?>
                        <option value="<?php echo $value->name; ?>" <?php echo $value->name == $data['search_teacher'] ? "selected" : '' ?>><?php echo $value->name; ?></option>
                    <?php
                        }
                    ?>
                    
                </select>
            </div>
            <input type="submit" value="Tìm kiếm" style="padding: 0 20px; background-color: #81aae9; cursor: pointer;">
        </form>

        <!-- Display the number of records found -->
        <p>Số bản ghi tìm thấy : <?php echo count($data['arr']); ?></p>

        <table border="1" style="padding: 8px;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>School Year</th>
                    <th>Subject</th>
                    <th>Teacher</th>
                    <th>Week Day</th>
                    <th>Lesson</th>
                    <th>Notes</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              <?php
              $count = 1;
                foreach($data['arr'] as $key => $value)
                {
                    ?> 
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $value->school_year; ?></td>
                        <td><?php echo $value->subject_name; ?></td>
                        <td><?php echo $value->teacher_name; ?></td>
                        <td><?php echo $value->week_day; ?></td>
                        <td><?php echo $value->lession; ?></td>
                        <td><?php echo $value->notes ?></td>
                        <td>
                            <div style="display: flex; padding: 0 5px;" > 
                                <form id="delete_form_<?php echo $value->id; ?>" method="POST" action="schedule/delete_schedule" style="margin-right: 2%;">
                                    <input type="hidden" name="delete_id" value="<?php echo $value->id; ?>">
                                    <input type="button" value="Xóa" onclick="confirmDelete(<?php echo $value->id; ?>)" style="padding: 10px; background-color: #81aae3; cursor: pointer;">
                                </form>
                                <form id="update_form_<?php echo $value->id; ?>" method="POST" action="schedule/update_schedule">
                                    <input type="hidden" name="update_id" value="<?php echo $value->id; ?>">
                                    <input type="submit" value="Sửa" style="padding: 10px; background-color: #81aae3; cursor: pointer;">
                                </form>
                            </div>
                        </td>
                    </tr>
                      
                    
<?php
$count++;
                }
              ?>
            </tbody>
        </table>
    </div>
