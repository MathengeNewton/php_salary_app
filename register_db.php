<?php 
    session_start();
    include('server.php');
    
    $errors = array();

    if (isset($_POST['reg_user'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password_1 =  $_POST['password_1'];
        $password_2 =  $_POST['password_2'];
        
        if (empty($username)) {
            array_push($errors, "Username is required");
            $_SESSION['error'] = "Username is required";
        }
        if (empty($email)) {
            array_push($errors, "Email is required");
            $_SESSION['error'] = "Email is required";
        }
        if (empty($password_1)) {
            array_push($errors, "Password is required");
            $_SESSION['error'] = "Password is required";
        }
        if ($password_1 != $password_2) {
            array_push($errors, "The two passwords do not match");
            $_SESSION['error'] = "The two passwords do not match";
        }

        $user_check_query = "SELECT * FROM user WHERE user = '$username' OR email = '$email' LIMIT 1";
        $result  = $mysqli->query($user_check_query);

        if ($result->num_rows > 0) { // if user exists
            $_SESSION['error'] = "Username already exists";
            array_push($errors, "Username already exists");
        }

        if (count($errors) == 0) {
            $password = md5($password_1);

            $sql = "INSERT INTO user (user, email, password) VALUES ('$username', '$email', '$password')";
            $mysqli->query($sql);

            $_SESSION['user'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        } else {
            header("location: register.php");
        }
    }

?>
