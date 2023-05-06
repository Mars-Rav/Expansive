<h1 class="w-50 ml-0 mr-0 mx-auto mt-5 text-center">Log In</h1>

<form class="w-50 ml-0 mr-0 mx-auto mt-5" id="login-form">
    <input type="hidden" name="title" value="login">

    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="email" id="email" class="form-control" name="email" />
        <label class="form-label" for="email">Email address</label>
        <p id="email-msg" class="text-danger"></p>
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
        <input type="password" id="password" class="form-control" name="password" />
        <label class="form-label" for="password">Password</label>
        <p id="password-msg" class="text-danger"></p>
    </div>

    <!-- 2 column grid layout for inline styling -->
    <div class="row mb-4">
        <div class="col">
            <!-- Simple link -->
            <a href="forget">Forgot password?</a>
        </div>
    </div>

    <!-- Submit button -->
    <button class="btn btn-primary btn-block mb-4 w-100" name="login" id="login">Log in</button>
    <p id="msg" class="text-danger"></p>
</form>

<script src=".\public\assets\js\login.js"></script>