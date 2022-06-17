<?php 
    session_start();
    include('server.php');
    
    $errors = array();

    if (isset($_POST['reg_employee'])) {
        // user information
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone =  $_POST['phone'];
        $position =  $_POST['position'];
        $basic =  $_POST['basic_salary'];
        $status = 'active';
        //Allowances
        $leave_allowance =  $_POST['leave_allowance'];
        $medical_allowance  =  $_POST['medical_allowance'];
        $house_allowance  =  $_POST['house_allowance'];
        //Deductions
        $nhif =  $_POST['nhif'];
        $nssf =  $_POST['nssf'];
        $paye =  $_POST['paye'];

        $sql = "INSERT INTO employees (name, email, position, phone,status, basic_salary, leave_allowance, medical_allowance, house_allowance, nhif, nssf, paye) VALUES ('$name', '$email', '$position', '$phone', '$status',$basic, $leave_allowance, $medical_allowance, $house_allowance,$nhif, $nssf, $paye)";
        
        if( $mysqli -> query($sql)){
            $_SESSION['success'] = "Employee added successfully" ;
            header('location: index.php');
        }
        if($mysqli->errno){
            $_SESSION['error'] = "Error adding employee". $mysqli->error;
            header('location: add.php');
        }
        $mysqli->close();        
    }

?>