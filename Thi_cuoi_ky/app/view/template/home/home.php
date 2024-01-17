<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
    }

    .user-info {
        background-color: #ffffff;
        border: 1px solid #dddddd;
        padding: 10px;
        margin: 20px;
        border-radius: 5px;
    }

    .login-name {
        font-weight: bold;
    }

    #loginTime {
        font-style: italic;
        color: #666666;
    }

    .reset-password-btn {
        margin-top: 10px;
    }

    .home-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px;
    }

    .home-tr {
        background-color: #f9f9f9;
    }

    .home-td {
        border: 1px solid #dddddd;
        padding: 8px;
        text-align: center;
    }

    .search-link {
        text-decoration: none;
        /* color: #007bff; */
        font-weight: bold;
    }

    .add-new-link {
        text-decoration: none;
        /* color: #007bff; */
        font-weight: bold;
    }
    button {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            font-size: 16px; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
        }

        button:hover {
            background-color: #0056b3;
        }
</style>

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
            <td class="home-td"><a href="teacher/index" class="search-link">Tìm kiếm</a></td>
            <td class="home-td"><a href="subject/search_and_delete" class="search-link">Tìm kiếm</a></td>
            <td class="home-td"><a href="schedule/schedule" class="search-link">Tìm kiếm</a></td>
        </tr>
        <tr class="home-tr">
            <td class="home-td">Thêm mới</td>
            <td class="home-td"><a href="teacher/teacher_register" class="add-new-link">Thêm mới</a></td>
            <td class="home-td"><a href="subject/index" class="add-new-link">Thêm mới</a></td>
            <td class="home-td"><a href="schedule/add_schedule" class="add-new-link">Thêm mới</a></td>
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