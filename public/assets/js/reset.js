$(document).on("click", "#reset", function (e) {
    e.preventDefault();

    let reset_form = document.getElementById("reset-form");
    let form_data = new FormData(reset_form);

    $.ajax({
        url: "src/Controllers/AuthController.php",
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response) {

            document.getElementById('password').classList.remove("is-invalid");
            document.getElementById('confirm-password').classList.remove("is-invalid");

            document.getElementById('password-msg').innerText = '';
            document.getElementById('confirm-password-msg').innerText = '';

            let msgs = JSON.parse(response);

            if (msgs === 1) {

                window.location = 'login';

            } else {

                document.getElementById('msg').innerText = msgs;

            }

        }

    });
});