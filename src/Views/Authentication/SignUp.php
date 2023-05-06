
<h1 class="w-50 ml-0 mr-0 mx-auto mt-5 text-center">Sign Up</h1>

<form class="w-50 ml-0 mr-0 mx-auto mt-5" id="signup-form">
    <!-- Full Name input -->
    <div class="form-outline mb-4">
        <input type="text" id="username" class="form-control username" name="username" placeholder="Username" />
        <p id="username-msg" class="text-danger"></p>
        <label class="form-label" for="username">Username</label>
    </div>

    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="text" id="email" name="email" class="form-control email" placeholder="Email Address" />
        <p id="email-msg" class="text-danger"></p>
        <label class="form-label" for="email">Email address</label>
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
        <input type="password" id="password" name="password" class="form-control password" placeholder="Password" />
        <p id="password-msg" class="text-danger"></p>
        <label class="form-label" for="password">Minimum length is 8 characters.</label>
    </div>

    <!-- Confirm Password input -->
    <div class="form-outline mb-4">
        <input type="password" id="confirm-password" class="form-control confirm-password" name="confirm-password" placeholder="Confirm Password" />
        <p id="confirm-password-msg" class="text-danger"></p>
        <label class="form-label" for="confirm-password">Confirm your password.</label>
    </div>

    <input type="hidden" name="title" value="signup">

    <!-- Submit button -->
    <button class="btn btn-primary btn-block mb-4 w-100" name="signup" id="signup" value="signup">Sign Up</button>
    <p id="msg" class="text-danger"></p>
</form>

<script src=".\public\assets\js\signup.js"></script>