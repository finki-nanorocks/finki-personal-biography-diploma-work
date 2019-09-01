$(document).ready(function () {
    $(".delete-category").on('click', function () {
        let succ = confirm("Дали сте сигурни дека сакате да ја избришете категоријата?");
        if (succ) {
            $(this).attr('type', 'submit');
        }
    });
});