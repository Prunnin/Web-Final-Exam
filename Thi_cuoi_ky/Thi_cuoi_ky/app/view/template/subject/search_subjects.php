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
</style>

<!-- Search form -->
<form method="get">
    <label for="name">Từ khóa</label>
    <input type="text" name="name" id="name">

    <label for="school_year">Khóa học </label>
    <select name="school_year" id="school_year">
        <option value=""></option>
        <option value="Năm 1">Năm 1</option>
        <option value="Năm 2">Năm 2</option>
        <option value="Năm 3">Năm 3</option>
        <option value="Năm 4">Năm 4</option>
    </select>

    <input type="submit" value="Tìm kiếm">
</form>

<?php
if (isset($data["subjects"]) && is_array($data["subjects"]) && count($data["subjects"]) > 0) {
    echo '<p> Số môn học tìm thấy: ' . count($data["subjects"]) . '</p>';
    echo '<table>';
    echo '<tr>';
    echo '<th>No</th>';
    echo '<th>Tên môn học </th>';
    // echo '<th>Avatar</th>';
    echo '<th>Mô tả chi tiết</th>';
    echo '<th>Khóa</th>';
    echo '<th>Action</th>';
    echo '</tr>';

    foreach ($data["subjects"] as $key => $value) {
        echo '<tr>';
        echo '<td>' . $value->id . '</td>';
        echo '<td>' . $value->name . '</td>';
        echo '<td>' . $value->description . '</td>';
        echo '<td>' . $value->school_year . '</td>';

        // Action buttons
        echo '<td class="action-buttons">';
        echo '<form action="subject/modify_subject" method="post">';
        echo '<input type="hidden" name="subject_id" value="' . $value->id . '">';
        echo '<input type="submit" value="Sửa">';
        echo '</form>';

        echo '<form method="post" action="subject/delete">';
        echo '<input type="hidden" name="subject_id" value="' . $value->id . '">';
        echo '<button type="submit" name="delete" value="Xóa">Xóa</button>';
        echo '</form>';

        echo '</td>';

        echo '</tr>';
    }

    echo '</table>';
} else {
    echo '<p>No subjects found.</p>';
}
?>
