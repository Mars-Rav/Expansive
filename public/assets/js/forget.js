$(document).on("click", "#forget", function (e) {
    e.preventDefault();

    let login_form = document.getElementById("forgot-form");
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

            document.getElementById('msg').innerText = '';
            document.getElementById('email').classList.remove("is-invalid");
            document.getElementById('email-msg').innerText = '';

            let msgs = JSON.parse(response);
            // let msgs = response;

            if (msgs === 1) {

                document.getElementById('success-msg').innerText = 'The email was sent successfully.';

            }
            else if (msgs === 0) {
                document.getElementById('msg').innerText = 'An issue occured while trying to send the email.';
            } else {

                if (typeof msgs['email'] !== 'undefined') {
                    document.getElementById('email-msg').innerText = msgs['email'];
                    document.getElementById('email').classList.add("is-invalid");
                }

            }

        }

    });
});