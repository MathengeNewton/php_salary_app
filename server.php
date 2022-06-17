<?php
    $dbhost = "127.0.0.1";

    $dbuser = "user";

    $dbpass = 'password';

    $dbname = "project";

    $mysqli = new mysqli( $dbhost, $dbuser, $dbpass, $dbname );
    
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }

?>