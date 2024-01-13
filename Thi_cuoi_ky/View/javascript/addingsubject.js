function validateForm() {
    var name = document.getElementsByName("name")[0].value;
    var avatar = document.getElementsByName("avatar")[0].value;
    var description = document.getElementsByName("description")[0].value;
    var schoolYear = document.getElementsByName("school_year")[0].value;

    // Check if the subject name is entered
    if (name.trim() === "") {
        displayNotification("Hãy nhập môn học");
        return false;
    }

    // Check if the subject name is below 1000 characters
    if (name.length > 100) {
        displayNotification("Không nhập quá 100 từ");
        return false;
    }

    // Check if the avatar is chosen
    if (avatar.trim() === "") {
        displayNotification("Hãy chọn avatar");
        return false;
    }

    // Check if the description is entered
    if (description.trim() === "") {
        displayNotification("Hãy nhập thông tin chi tiết");
        return false;
    }

    // Check if the description is below 1000 characters
    if (description.length > 1000) {
        displayNotification("Không nhập quá 1000 từ");
        return false;
    }

    // Check if the school year is selected
    if (schoolYear === "") {
        displayNotification("Hãy chọn khóa học");
        return false;
    }

    return true;
}

function displayNotification(message) {
    var notification = document.getElementById("notification");
    notification.innerHTML = message;
    notification.style.display = "block";
}
