<?php 
    session_start();
    include('server.php');
    
    $errors = array();    

    $query = "SELECT * FROM employees WHERE status = 'active'";
    $result  = $mysqli->query($query);
    $data = $result->fetch_all(MYSQLI_ASSOC);

?>
