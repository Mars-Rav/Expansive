<?php

if (isset($_GET['i']) && ($_GET['i'] === $_COOKIE['exp'])) {
} else {
    header('location: login');
}

?>

<h1 class="w-50 ml-0 mr-0 mx-auto mt-5 text-center">Reset</h1>

<form class="w-50 ml-0 mr-0 mx-auto mt-5" id="reset-form">
    <input type="hidden" name="title" value="reset-form">

    <div class="form-outline mb-4">
        <input type="password" id="password" class="form-control" name="password" />
        <label class="form-label" for="password">Password</label>
        <p id="password-msg" class="text-danger"></p>
    </div>

    <div class="form-outline mb-4">
        <input type="password" id="confirm-password" class="form-control" name="confirm-password" />
        <label class="form-label" for="confirm-password">Confirm Password</label>
        <p id="confirm-password-msg" class="text-danger"></p>
    </div>

    <button class="btn btn-danger btn-block mb-4 w-100" name="reset" id="reset">Reset</button>
    <p id="msg" class="text-danger"></p>
</form>

<script>
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

                if (typeof msgs['new_password'] !== 'undefined') {
                    document.getElementById('password-msg').innerText = msgs['new_password'][0];
                    document.getElementById('password').classList.add("is-invalid");
                }

                if (typeof msgs['confirm_password'] !== 'undefined') {
                    document.getElementById('confirm-password-msg').innerText = msgs['confirm_password'][0];
                    document.getElementById('confirm-password').classList.add("is-invalid");
                }

            }

        }

    });
});
</script>