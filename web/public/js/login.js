$(document).ready(function (e) {

    $("#email").val(localStorage.getItem("email"));
    $("#password").val(localStorage.getItem("password"));

    $("#login-btn").on("click", function (e) {
        console.log("submit");

        localStorage.setItem("email", $("#email").val());
        localStorage.setItem("password", $("#password").val());

        $("#login-form").submit();
    });
});