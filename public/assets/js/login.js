$(document).on("click", "#login", function (e) {
    e.preventDefault();

    let login_form = document.getElementById("login-form");
    let form_data = new FormData(login_form);

    $.ajax({
        url: "src/Controllers/AuthController.php",
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response) {

            document.getElementById('email').classList.remove("is-invalid");
            document.getElementById('password').classList.remove("is-invalid");

            document.getElementById('email-msg').innerText = '';
            document.getElementById('password-msg').innerText = '';

            document.getElementById('msg').innerText = '';

            let msgs = JSON.parse(response);

            if (msgs === 1) {

                window.location = 'home';

            } else {

                if (typeof msgs['invalid'] !== 'undefined') {
                    document.getElementById('msg').innerText = msgs['invalid'];
                }

                if (typeof msgs['email'] !== 'undefined') {
                    document.getElementById('email-msg').innerText = msgs['email'];
                    document.getElementById('email').classList.add("is-invalid");
                }

                if (typeof msgs['password'] !== 'undefined') {
                    document.getElementById('password-msg').innerText = msgs['password'];
                    document.getElementById('password').classList.add("is-invalid");
                }

            }

        }

    });
});