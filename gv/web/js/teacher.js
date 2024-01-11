$('#input_avatar').change(function () {
    let fileName = document.getElementById('input_avatar').value.split('\\').pop();
    document.getElementById("filePathDisplay").textContent = fileName;
    document.getElementById("name_avatar").value = fileName;

});


$("#buton_register").click(function () {
    var count = 0;
    let usernameValue = $("#input_name").val();
    let department = $("#input_department option:selected").val();
    let degree = $("#input_degree option:selected").val();
    let avatar = $("#filePathDisplay").text();
    let description = $("#input_description").val();


    // let date = $("#date_input").val();
    if (usernameValue.length == 0) {
        document.getElementById("alert_name").textContent = "Hãy nhập tên giáo viên.";
        document.getElementById("alert_name").style.display = "block";
        count = 1;
    }else{
        document.getElementById("alert_name").style.display = "none";
    }

    if (department == "000") {
        document.getElementById("alert_depart").textContent = "Hãy chọn bộ môn.";
        document.getElementById("alert_depart").style.display = "block";
        count = 1;
    }else{
        document.getElementById("alert_depart").style.display = "none";
    }

    if (degree == "000") {
        document.getElementById("alert_degree").textContent = "Hãy chọn bằng cấp.";
        document.getElementById("alert_degree").style.display = "block";
        count = 1;
    }else{
        document.getElementById("alert_degree").style.display = "none";
    }

    if (avatar.length == 0) {
        document.getElementById("alert_avatar").textContent = "Hãy chọn avatar.";
        document.getElementById("alert_avatar").style.display = "block";
        count = 1;
    }else{
        document.getElementById("alert_avatar").style.display = "none";
    }

    if (description.length == 0) {
        document.getElementById("alert_description").textContent = "Hãy nhập mô tả chi tiết.";
        document.getElementById("alert_description").style.display = "block";
        count = 1;
    }else{
        document.getElementById("alert_description").style.display = "none";
    }


    if (count == 0) {
        // alert("true");
        return true;
    } else {
        // alert("false");
        // document.querySelector('.alert_validate').style.display = "block";

        // document.body.style.height = String(height + 16 * count) + "px";

        return false;
    }
});



