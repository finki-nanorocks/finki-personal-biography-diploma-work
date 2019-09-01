$(document).ready(function () {
    $(".delete-subject").on('click', function () {
        let succ = confirm("Дали сте сигурни дека сакате да го избришете предметот?");
        if (succ) {
            $(this).attr('type', 'submit');
        }
    });
});