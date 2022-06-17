<?php

    $queries = array();
    parse_str($_SERVER['QUERY_STRING'], $queries);
    $id = $queries['id'];
    $query = "SELECT * FROM employees WHERE id = $id";
    $result =$mysqli->query($query);

    if ($result -> num_rows > 0) {
        $record = $result->fetch_all(MYSQLI_ASSOC);
        header("location: view_record.php");
    } else {
        array_push($errors, "Wrong Username or Password");
        $_SESSION['error'] = "Wrong Username or Password!";
        header("location: view_record.php");
    }

?>