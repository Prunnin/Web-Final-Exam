<div class="container">
        <form id="resetForm" method="POST" action="password/validate">
            <label for="account" class="username">Người dùng </label>
            <input type="textbox" id="reset_account" name="account" class="entering" required><br><br>
            <button type="button" class="button-container" id="request_btn_reset"> Gửi yêu cầu reset password </button>
        </form>
        <div id="messageContainer">
            <div>
                <?php
                if (!empty($data['error_message'])){
                    echo "<p style='color: red;'>".$data['error_message']."</p>";
                }
                ?>
            </div>
        </div>
    </div>