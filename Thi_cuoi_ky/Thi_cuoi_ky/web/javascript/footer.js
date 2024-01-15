
$("#request_btn_reset").on("click", function(){
    $("#resetForm").submit()
})

$("#btn_btn_login").on('click', function(e){
    e.preventDefault();
    var account = $("#account").val();
    var password = $("#password").val();
    flag = true
    if (account.length == 0){
        $("#accountError").html("<p style='color: red;'>Hãy nhập login id</p>");
        flag = false
    } else if (account.length < 4) {
        $("#accountError").html("<p style='color: red;'>Hãy nhập 4 ký tự</p>");
        flag = false
    }

    if (password.length == 0){
        $("#passwordError").html("<p style='color: red;'>Hãy nhập password</p>");
        flag = false
    } else if (password.length < 6){
        $("#passwordError").html("<p style='color: red;'>Hãy nhập 6 ký tự</p>");
        flag = false
    }

    if (flag){
        $.ajax({
            url: "login/check_login",
            type: "POST",
            dataType: "JSON",
            data: {account: account, password: password},
            success: function(response){
                if (response.status === 0){
                    $("#passwordError").html("<p tyle='color: red;'>" + response.response + "</p>")
                } else {
                    window.location.href = "home/index"
                }
            }
        })
    }
    // $("#login_form").submit();
});

