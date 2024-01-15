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
<div class="container">
        <h2>List of Schedules</h2>

        <!-- Search form -->
        <form action="schedule/search" method="post">
            <div style="padding: 5px;">
                <label for="search_school_year">Search by School Year:</label>
                <input type="text" name="search_school_year" value="<?php echo (isset($data['search_school_year'])) ? $data['search_school_year'] : ''; ?>" >
            </div>
            <div style="padding: 5px;">
                <label for="search_subject">Search by Subject:</label>
                <input type="text" name="search_subject" value="<?php echo (isset($data['search_subject'])) ? $data['search_subject'] : ''; ?>">
            </div>
            <div style="padding: 5px;">
                <label for="search_teacher">Search by Teacher:</label>
                <input type="text" name="search_teacher" value="<?php echo (isset($data['search_teacher'])) ? $data['search_teacher'] : ''; ?>">
            </div>
            <input type="submit" value="Search" style="padding: 0 20px; background-color: #81aae9; cursor: pointer;">
        </form>

        <!-- Display the number of records found -->
        <p>Number of records found: <?php echo count($data['arr']); ?></p>

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
                                    <input type="button" value="Delete" onclick="confirmDelete(<?php echo $value->id; ?>)" style="padding: 10px; background-color: #81aae3; cursor: pointer;">
                                </form>
                                <form id="update_form_<?php echo $value->id; ?>" method="POST" action="schedule/update_schedule">
                                    <input type="hidden" name="update_id" value="<?php echo $value->id; ?>">
                                    <input type="submit" value="Update" style="padding: 10px; background-color: #81aae3; cursor: pointer;">
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
