function validateForm() {
    var schoolYear = document.getElementsByName("school_year")[0].value;
    var subjectId = document.getElementsByName("subject_id")[0].value;
    var teacherId = document.getElementsByName("teacher_id")[0].value;
    var weekDay = document.getElementsByName("week_day")[0].value;
    var lessons = document.querySelectorAll('input[name="lesson[]"]:checked');
    var notes = document.getElementsByName("notes")[0].value;

    var notification = document.getElementById("notification");
    notification.innerHTML = "";

    // Check if the school year is selected
    if (schoolYear === "") {
        notification.innerHTML = "Please select school year";
        return false;
    }

    // Check if the subject is selected
    if (subjectId === "") {
        notification.innerHTML = "Please select subject";
        return false;
    }

    // Check if the teacher is selected
    if (teacherId === "") {
        notification.innerHTML = "Please choose teacher";
        return false;
    }

    // Check if the week day is selected
    if (weekDay === "") {
        notification.innerHTML = "Please choose week day";
        return false;
    }

    // Check if at least one lesson is selected
    if (lessons.length === 0) {
        notification.innerHTML = "Please pick at least one lesson";
        return false;
    }

    // Check if the notes are entered
    if (notes.trim() === "") {
        notification.innerHTML = "Please write notes";
        return false;
    }

    return true;
}