<?php
use App\Controllers\Database;

$db = new Database;
session_start();
if (isset($_SESSION['user-id'])) {

    $id = $_SESSION['user-id'];
    $fetch_stmt = $db->conn->prepare("SELECT * FROM users WHERE id = :id");
    $fetch_stmt->bindParam('id', $id);
    $fetch_stmt->execute();

    $user = $fetch_stmt->fetch(PDO::FETCH_OBJ);
} else {
    header('location: login');
}

?>

<div class="m-5">
    <h1>Account</h1>

    <form class="w-50 ml-0 mr-0 mx-auto mt-5" id="">

    <div class="form-outline mb-4">
        <img src="<?php echo $user->pfp ?>" alt="Profile picture">
        <input type="file" id="pfp" class="form-control pfp" name="pfp"" />
        <p id="pfp-msg" class="text-danger"></p>
        <label class="form-label" for="pfp">PFP</label>
    </div>

    <div class="form-outline mb-4">
        <input type="text" id="username" class="form-control username" name="username" placeholder="Username" value="<?php echo $user->username ?>" />
        <p id="username-msg" class="text-danger"></p>
        <label class="form-label" for="username">Username</label>
    </div>

    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="text" id="email" name="email" class="form-control email" placeholder="Email Address" value="<?php echo $user->email ?>" />
        <p id="email-msg" class="text-danger"></p>
        <label class="form-label" for="email">Email address</label>
    </div>

    <!-- Job input -->
    <div class="form-outline mb-4">
        <input type="text" id="job" name="job" class="form-control job" placeholder="Job" value="<?php echo $user->job ?>" />
        <p id="job-msg" class="text-danger"></p>
        <label class="form-label" for="job">Job</label>
    </div>

    <!-- Salary input -->
    <div class="form-outline mb-4">
        <input type="text" id="salary" name="salary" class="form-control salary" placeholder="Salary" value="<?php echo $user->salary ?>" />
        <p id="salary-msg" class="text-danger"></p>
        <label class="form-label" for="salary">Salary</label>
    </div>

    <!-- Savings input -->
    <div class="form-outline mb-4">
        <input type="text" id="savings" name="savings" class="form-control savings" placeholder="Savings" value="<?php echo $user->savings ?>" />
        <p id="savings-msg" class="text-danger"></p>
        <label class="form-label" for="savings">Savings</label>
    </div>

    <!-- Spendings input -->
    <div class="form-outline mb-4">
        <input type="text" id="Spendings" name="Spendings" class="form-control Spendings" placeholder="Spendings" value="<?php echo $user->spendings ?>" />
        <p id="Spendings-msg" class="text-danger"></p>
        <label class="form-label" for="Spendings">Spendings</label>
    </div>

    <!-- ---------------------------------------------------------------------------------------------------------------- -->

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
</div>

