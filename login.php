<?php
session_start();

$error = '';

// When form submitted, check and create user session.
if (isset($_POST['username']) && isset($_POST['password'])) {
    require('db.php'); // Include the database connection

    $usernameOrEmail = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $hashedPassword = md5($password); // Hash the password using md5

    // Check if the user exists in the database with the provided username or email and hashed password
    $query = "SELECT * FROM `users` WHERE (username='$usernameOrEmail' OR email='$usernameOrEmail') AND password='$hashedPassword'";

    $result = mysqli_query($con, $query);
    $rows = mysqli_num_rows($result);

    if ($rows == 1) {
        $_SESSION['username'] = $usernameOrEmail;
        // Redirect to the user dashboard page
        header("Location: landing.php");
        exit();
    } else {
        $error = "Incorrect Username/Email or Password.";
    }
}

include('login.html');
?>
