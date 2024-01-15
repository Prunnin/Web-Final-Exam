<p>Tên login: <?php echo $_SESSION['login_id']; ?> </p>
<p>Thời gian login: <span id="loginTime"></span></p>
<p><a href="password/manager"><button>RESET PASSWORD MANAGER</button></a></p>
<table class="home-table">
    <tr class="home-tr">
        <td class="home-td">Phòng học</td>
        <td class="home-td">Giáo viên</td>
        <td class="home-td">Môn học</td>
        <td class="home-td">Thời khóa biểu</td>
    </tr>
    <tr class="home-tr">
        <td class="home-td">Tìm kiếm</td>
        <td class="home-td"><a href="teacher/index">Tìm kiếm</a></td>
        <td class="home-td"><a href="subject/search_and_delete">Tìm kiếm</a></td>
        <td class="home-td"><a href="schedule/schedule">Tìm kiếm</a></td>
    </tr>
    <tr class="home-tr">
        <td class="home-td">Thêm mới</td>
        <td class="home-td"><a href="teacher/teacher_register">Thêm mới</a></td>
        <td class="home-td"><a href="subject/index">Thêm mới</a></td>
        <td class="home-td"><a href="schedule/add_schedule">Thêm mới</a></td>
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