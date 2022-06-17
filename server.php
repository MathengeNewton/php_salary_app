<?php
    $dbhost = "127.0.0.1";

    $dbuser = "newton";

    $dbpass = 'XtZk9:"%W%=_$5SZ';

    $dbname = "project";

    $mysqli = new mysqli( $dbhost, $dbuser, $dbpass, $dbname );
    
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }

?>