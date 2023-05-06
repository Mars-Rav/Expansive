<h1 class="w-50 ml-0 mr-0 mx-auto mt-5 text-center">Reset Password</h1>

<!-- action="controllers/forget-test.php" -->
<form class="w-50 ml-0 mr-0 mx-auto mt-5" id="forgot-form" method="POST">

    <p>If your email exists you will receive a password reset link as an email.</p>

    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="email" id="email" class="form-control" name="email" placeholder="Email Address" />
        <label class="form-label" for="email">Email address</label>
        <p id="email-msg" class="text-danger"></p>
    </div>

    <input type="hidden" name="title" value="email-forgot-form">
    <!-- Submit button -->
    <button class="btn btn-primary btn-block mb-4 w-100" name="search-email" value="search-email" id="forget">Search For Email</button>
    <p id="msg" class="text-danger"></p>
    <p id="success-msg" class="text-success"></p>
</form>

<script src=".\public\assets\js\forget.js"></script>