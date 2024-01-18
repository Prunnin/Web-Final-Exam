<style>
    table {
        width: 100%;
        border-collapse: collapse;
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

    .action-buttons {
        display: flex;
        gap: 5px;
    }
    .delete, .modify {
        background-color: lightgreen;
        color: black;
        padding: 5px;
        border-radius: 5px;
        width: 70px;
        height: 50px;
        margin: 10px;
        cursor: pointer;
    }
    
</style>
<a href="home"><button><<</button><a>
<!-- Search form -->
<form method="get">
   
    <br>
    <label for="school_year" class="username">Khóa học </label>
    <select name="school_year" id="school_year" class="entering">
        <option value=""></option>
        <option value="Năm 1">Năm 1</option>
        <option value="Năm 2">Năm 2</option>
        <option value="Năm 3">Năm 3</option>
        <option value="Năm 4">Năm 4</option>
    </select><br>

    <label for="name" class="username">Từ khóa</label>
    <input type="text" name="name" id="name" class="entering">    <br>


    <input class="button-container" type="submit" value="Tìm kiếm">
</form>

<?php
if (isset($data["subjects"]) && is_array($data["subjects"]) && count($data["subjects"]) > 0) {
    echo '<p> Số môn học tìm thấy: ' . count($data["subjects"]) . '</p>';
    echo '<table>';
    echo '<tr>';
    echo '<th>No</th>';
    echo '<th>Tên môn học </th>';
    echo '<th>Mô tả chi tiết</th>';
    echo '<th>Khóa</th>';
    echo '<th>Action</th>';
    echo '</tr>';
    $count = 1;
    foreach ($data["subjects"] as $key => $value) {
        echo '<tr>';
        echo '<td>' .  $count . '</td>';
        echo '<td>' . $value->name . '</td>';
        echo '<td>' . $value->description . '</td>';
        echo '<td>' . $value->school_year . '</td>';

        // Action buttons
        echo '<td class="action-buttons">';
        echo '<form action="subject/modify_subject" method="post">';
        echo '<input type="hidden" name="subject_id" value="' . $value->id . '">';
        echo '<input type="submit" class="modify" value="Sửa">';
        echo '</form>';

        echo '<form method="post" action="subject/delete" id="form_' . $value->id . '" onsubmit="return confirmDelete(\''. htmlspecialchars($value->name) .'\');">';
        echo '<input type="hidden" name="subject_id" value="' . $value->id . '">';
        echo '<button type="submit" name="delete" class="delete" value="Xóa">Xóa</button>';
        echo '</form>';
        
        echo '</td>';

        echo '</tr>';
        $count++;
    }

    echo '</table>';
} else {
    echo '<p>No subjects found.</p>';
}
?>
<script src="web/javascript/jquery-3.6.0.min.js"></script>
<script>

    function confirmDelete(name) {
        var confirmResult = confirm("Bạn có chắc muốn xóa môn "+name+" này?");
        return confirmResult;
    }
</script>
