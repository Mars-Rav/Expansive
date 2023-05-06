$(document).on("click", "#signup", function (e) {
    e.preventDefault();

    let signup_form = document.getElementById("signup-form");
    let form_data = new FormData(signup_form);

    $.ajax({
        url: "src/Controllers/AuthController.php",
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response) {

            document.getElementById('username').classList.remove("is-invalid");
            document.getElementById('email').classList.remove("is-invalid");
            document.getElementById('password').classList.remove("is-invalid");
            document.getElementById('confirm-password').classList.remove("is-invalid");

            document.getElementById('username-msg').innerText = '';
            document.getElementById('email-msg').innerText = '';
            document.getElementById('password-msg').innerText = '';
            document.getElementById('confirm-password-msg').innerText = '';

            // document.getElementById('msg').innerText = response;

            let msgs = JSON.parse(response);
            // let msgs = response;

            if (msgs === 1) {

                window.location = 'login';

            } else {

                if (typeof msgs['username'] !== 'undefined') {
                    document.getElementById('username-msg').innerText = msgs['username'][0];
                    document.getElementById('username').classList.add("is-invalid");
                }

                if (typeof msgs['email'] !== 'undefined') {
                    document.getElementById('email-msg').innerText = msgs['email'][0];
                    document.getElementById('email').classList.add("is-invalid");
                }

                if (typeof msgs['password'] !== 'undefined') {
                    document.getElementById('password-msg').innerText = msgs['password'][0];
                    document.getElementById('password').classList.add("is-invalid");
                }

                if (typeof msgs['confirm-password'] !== 'undefined') {
                    document.getElementById('confirm-password-msg').innerText = msgs['confirm-password'][0];
                    document.getElementById('confirm-password').classList.add("is-invalid");
                }
            }

        }

    });
});