<p>Tên login: <?php echo $_SESSION['login_id']; ?> </p>
<p>Thời gian login: <span id="loginTime"></span></p>
<table>
    <tr>
        <td>Phòng học</td>
        <td>Giáo viên</td>
        <td>Môn học</td>
        <td>Thời khóa biểu</td>
    </tr>
    <tr>
        <td>Tìm kiếm</td>
        <td><a href="teacher_searching.html">Tìm kiếm</a></td>
        <td><a href="list_subject.php">Tìm kiếm</a></td>
        <td><a href="schedule_seaching.html">Tìm kiếm</a></td>
    </tr>
    <tr>
        <td>Thêm mới</td>
        <td>Thêm mới</td>
        <td><a href="adding_subject.php">Thêm mới</a></td>
        <td><a href="schedule_register.php">Thêm mới</a></td>
    </tr>
</table>
<script>
    function formatDateTime() {
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');

        const formattedDateTime = `${year}-${month}-${day} ${hours}:${minutes}`;
        return formattedDateTime;
    }
    document.getElementById('loginTime').textContent = formatDateTime();
</script>