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
    <h1>Home Page</h1>
    <h2>Welcome, <?php echo $user->username ?></h2>
    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto culpa nostrum quidem est omnis facere laboriosam nulla magnam reprehenderit vel quod beatae asperiores nobis, fugiat dolores enim vero. Rerum, ut. Eaque ut aperiam pariatur. Vel a nihil, cumque voluptatum consequuntur repellendus. Ea, magni minima!</p>
</div>


<script>
    $(document).on("click", "#logout", function (e) {
    e.preventDefault();

    let logout_form = document.getElementById("logout-form");
    let form_data = new FormData(logout_form);

    $.ajax({
        url: "src/Controllers/AuthController.php",
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response) {

            let state = JSON.parse(response);

            if(state === 1){

                window.location = 'login';

            }

        }

    });
});
</script>