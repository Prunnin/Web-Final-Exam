
    function validateForm() {
        var name = document.getElementsByName("name")[0].value;
        var avatar = document.getElementsByName("avatar")[0].value;
        var description = document.getElementsByName("description")[0].value;
        var schoolYear = document.getElementsByName("school_year")[0].value;

        var notification = document.getElementById("notification");
        notification.innerHTML = "";

        // Check if the subject name is entered
        if (name.trim() === "") {
            notification.innerHTML = "Hãy nhập môn học";
            return false;
        }

        // Check if the subject name is below 100 characters
        if (name.length > 100) {
            notification.innerHTML = "Không nhập quá 100 từ";
            return false;
        }

        // Check if the avatar is chosen
        if (avatar.trim() === "") {
            notification.innerHTML = "Hãy chọn avatar";
            return false;
        }

        // Check if the description is entered
        if (description.trim() === "") {
            notification.innerHTML = "Hãy mô tả chi tiết";
            return false;
        }

        // Check if the description is below 1000 characters
        if (description.length > 1000) {
            notification.innerHTML = "Không nhập quá 1000 từ";
            return false;
        }

        // Check if the school year is selected
        if (schoolYear === "") {
            notification.innerHTML = "Hãy chọn khóa học";
            return false;
        }

        return true;
    }

