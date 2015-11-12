$(function() {
    if (window.student === null) {
        return;
    }

    $("#name").html(window.student.firstName);
});
