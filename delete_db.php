<?php 
    session_start();
    include('server.php');
    
    $errors = array();    
    $queries = array();
    parse_str($_SERVER['QUERY_STRING'], $queries);
    $id = $queries['id'];
    $query = "UPDATE employees set status = 'inactive' WHERE id = $id";
    if($mysqli->query($query)){
        header('location: index.php');
    }
    else{        
        $_SESSION['error'] = "Username already exists";
        array_push($errors, "Username already exists");
    }

?>
