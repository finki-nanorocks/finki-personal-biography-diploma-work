$(document).ready(function () {

    // global
    var emailChange = 0;

    // loading page
    function onLoadPage() {

        // load resume form with modules
        let toolbarOptions = [
            {size: ["small", false, "large", "huge"]},
            "bold", "italic", "underline", "strike", "link"
        ];

        let quill = new Quill("#editor", {
            modules: {
                toolbar: toolbarOptions
            },
            theme: "snow",
            placeholder: "Внесете податоци за вашето резиме...",
            size: "small",
        });

        // count chars for resume on load
        let text = $("#editor .ql-editor").html();
        if (text.length <= 1500) {
            $("#charNum").text(1500 - text.length);
        }

        // count chars on key up
        $("#editor").on("keyup", function () {
            let text = $("#editor .ql-editor").html();
            if (text.length >= 1500) {
                $("#charNum").text("Го надминавте лимитот од 1500 карактери.");
                //$("#submit-resume").attr("disabled", true);
            } else {
                $("#charNum").text(1500 - text.length);
                //$("#submit-resume").attr("disabled", false);
            }
        });

        // count password
        $("#btn-change-password").attr("disabled", false);
        $("#old-password").on("keyup", function () {
            let password = $("#old-password").val();

            if (password.length > 0) {
                $("#btn-change-password").attr("disabled", false);
            } else {
                $("#btn-change-password").attr("disabled", true);
            }
        });

        // default ajax header
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
            }
        });

        // disable / enable btn email
        emailChange = 0;
        $('#email').attr('disabled', true);

        $("#btn-email-input").on('click', function () {
            if (emailChange) {
                emailChange = 0;
                $('#email').attr('disabled', true);
                $('#btn-email-input i').removeClass("fa-lock-open");
            }
            else {
                emailChange = 1;
                $('#email').attr('disabled', false);
                $('#btn-email-input i').addClass("fa-lock-open");
            }

        });


    }

    // update resume
    function ajaxUpdateResume() {
        let timer = null;

        $("#submit-resume").on("click", function () {

            $("#d-alert-resume-success").addClass("d-none");
            $("#d-alert-resume-fail").addClass("d-none");

            clearTimeout(timer);

            let resume = {
                'userId': $("#userId").val(),
                'text': $("#editor .ql-editor").html(),
            };

            $.ajax({
                url: "/profile/resume",
                type: "POST",
                data: {
                    "userId": resume["userId"],
                    "text": resume["text"],
                },
                dataType: "JSON",
                success: function (data) {

                    $("#d-alert-resume-success .alert-message").html(data["message"]);
                    $("#d-alert-resume-fail .alert-message").html(data["message"]);

                    if (data["status"] !== 200) {
                        $("#d-alert-resume-fail").removeClass("d-none");

                        timer = setTimeout(function () {
                            $("#d-alert-resume-fail").addClass("d-none");
                        }, 5000);
                    }
                    else {
                        $("#d-alert-resume-success").removeClass("d-none");
                        timer = setTimeout(function () {
                            $("#d-alert-resume-success").addClass("d-none");
                        }, 5000);
                    }

                }
            });
        });
    }

    // update personal info
    function ajaxPersonalInfo() {
        $("#submit-info").on("click", function () {

            $("#d-info-msg").addClass("d-none");

            let info = {
                "address": $("#address").val(),
                "fullName": $("#fullName").val(),
                "institution": $("#institution").val(),
                "department": $("#department").val(),
                "repoId": $("#repoId").val(),
                "idAssistant": $("#id-assistants").val(),
                "idCategory": $("#id-category").val(),
                "userId": $("#userId").val(),
            };
            // append if email is changed
            if (emailChange) {
                info = Object.assign({"email": $("#email").val()}, info);
            }

            $("#err-msg-email").text("");
            $("#err-msg-full-name").text("");
            $("#err-msg-address").text("");
            $("#err-msg-institution").text("");
            $("#err-msg-department").text("");
            $("#err-msg-repo-id").text("");
            $("#err-msg-id-assistant").text("");
            $("#err-msg-id-category").text("");
            $("#err-msg-user-id").text("");

            // if email not set return null
            info["email"] = (info["email"] === undefined) ? null : info["email"];

            $.ajax({
                url: "/profile/info",
                type: "POST",
                data: {
                    "email": info["email"],
                    "fullName": info["fullName"],
                    "address": info["address"],
                    "institution": info["institution"],
                    "department": info["department"],
                    "repoId": info["repoId"],
                    "idAssistant": info["idAssistant"],
                    "idCategory": info["idCategory"],
                    "userId": info["userId"],
                },
                dataType: "JSON",
                success: function (data) {

                    if (data.status !== 200) {
                        info["email"] = (data.message["email"] === undefined) ? '' : data.message["email"];
                        info["fullName"] = data.message["fullName"];
                        info["address"] = data.message["address"];
                        info["institution"] = data.message["institution"];
                        info["department"] = data.message["department"];
                        info["repoId"] = data.message["repoId"];
                        info["idAssistant"] = data.message["idAssistant"];
                        info["idCategory"] = data.message["idCategory"];
                        info["userId"] = data.message["userId"];

                        $("#err-msg-email").text(info["email"]);
                        $("#err-msg-full-name").text(info["fullName"]);
                        $("#err-msg-address").text(info["address"]);
                        $("#err-msg-institution").text(info["institution"]);
                        $("#err-msg-department").text(info["department"]);
                        $("#err-msg-repo-id").text(info["repoId"]);
                        $("#err-msg-id-assistant").text(info["idAssistant"]);
                        $("#err-msg-id-category").text(info["idCategory"]);
                        $("#err-msg-user-id").text(info["userId"]);
                    }
                    else {
                        $("#d-info-msg").removeClass("d-none")
                        $("#d-info-msg .alert-message").text(data.message);
                    }
                }
            });
        });
    }

    // update password
    function ajaxUpdPassword() {
        $("#btn-change-password").on("click", function () {

            $("#err-msg-old-password").text("");
            $("#err-msg-new-password").text("");
            $("#d-alert-password-success").addClass("d-none");
            $("#d-alert-password-fail").addClass("d-none");

            let password = {
                "oldPassword": $("#old-password").val(),
                "newPassword": $("#new-password").val(),
                "userId": $("#userId").val(),
            }

            $.ajax({
                url: "/profile/password",
                type: "POST",
                data: {
                    "oldPassword": password["oldPassword"],
                    "newPassword": password["newPassword"],
                    "userId": password["userId"],
                },
                dataType: "JSON",
                success: function (data) {
                    if (data.status !== 200) {
                        password["oldPassword"] = data.message["oldPassword"];
                        password["newPassword"] = data.message["newPassword"];
                        password["userId"] = data.message["userId"];

                        if (password["userId"] !== undefined) {
                            $("#d-alert-password-fail").removeClass("d-none");
                            $("#d-alert-password-fail .alert-message").text(password["userId"]);
                            return;
                        }

                        $("#err-msg-old-password").text(password["oldPassword"]);
                        $("#err-msg-new-password").text(password["newPassword"]);
                    }
                    else {

                        $("#d-alert-password-success").removeClass("d-none");
                        $("#d-alert-password-success .alert-message").text(data.message);
                    }
                }
            });


        });
    }

    onLoadPage();
    ajaxUpdateResume();
    ajaxPersonalInfo();
    ajaxUpdPassword()
});