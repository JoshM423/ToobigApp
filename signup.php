<?php
    require('db.php');
    
    // Initialize variables for error and success messages
    $error = $success = "";

    // Initialize variables for form field values
    $first_name = $last_name = $username = $email = "";

    // When form submitted, insert values into the database.
    if (isset($_POST['submit'])) {
        $first_name = mysqli_real_escape_string($con, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($con, $_POST['last_name']);
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

        // Check if the password and confirm password match
        if ($password != $confirm_password) {
            $error = "Passwords do not match.";
        } elseif (!preg_match("/^[a-zA-Z\s]+$/", $first_name) || !preg_match("/^[a-zA-Z\s]+$/", $last_name)) {
            $error = "First name and last name should contain letters only.";
        } elseif (!preg_match("/^[a-zA-Z0-9]+$/", $username)) {
            $error = "Username should contain alphanumeric characters only.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format.";
        } else {
            // Check if username or email already exists in the database
            $query = "SELECT * FROM `users` WHERE username = '$username' OR email = '$email'";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                $error = "Username or email is already in use.";
            } else {
                $create_datetime = date("Y-m-d H:i:s");
                $query = "INSERT into `users` (first_name, last_name, username, password, email, create_datetime)
                          VALUES ('$first_name', '$last_name', '$username', '" . md5($password) . "', '$email', '$create_datetime')";
                $result = mysqli_query($con, $query);
                if ($result) {
                    $success = "You are registered successfully.";
                    // Clear form fields
                    $first_name = "";
                    $last_name = "";
                    $username = "";
                    $email = "";
                    $password = "";
                    $confirm_password = "";
                } else {
                    $error = "Required fields are missing.";
                }
                
            }
        }
    }

    include('signup.html');
?>
