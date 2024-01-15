    
    <div class="container">
        <form id="login_form" method="POST" action="login/login">
            <label for="account" class="username">Người dùng </label>
            <input type="textbox" id="account" name="account" class="entering" required><br><br>
            <span id="accountError" class="error-message"></span><br>
            
            <label for="password" class="password">Password </label>
            <input type="password" id="password" name="password" class="entering" required><br><br>
            <span id="passwordError" class="error-message"></span><br>

            <div class="forgot-password">
                <a href="password/index">Quên password</a>
            </div>
            
            <button class="button-container" id="btn_btn_login" type="button"> Đăng nhập </button>

        </form>
    </div>
