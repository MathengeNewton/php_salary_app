<?php 
    session_start();
    include('server.php'); 

    if (!isset($_SESSION['user'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['user']);
        header('location: login.php');
    }

    $queries = array();

    parse_str($_SERVER['QUERY_STRING'], $queries);

    $id = $queries['id'];

    $query = "SELECT * FROM employees WHERE id = $id";

    $result =$mysqli->query($query);

    if ($result -> num_rows > 0) {
        $record = $result->fetch_assoc();
        $benefits = $record['leave_allowance'] + $record['medical_allowance'] + $record['house_allowance'];
        $gross_pay = $record['basic_salary'] + $benefits;
        $deductions = $record['nhif'] + $record['nssf'] + $record['paye'];
        $net_pay = $gross_pay - $deductions;
    } else {
        array_push($errors, "Record not retreived successifully");
        $_SESSION['error'] = "Record not retreived successifully";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard-Pay slip</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="">
        <nav class="navbar navbar-expand-lg bg-light d-flex justify-content-between mx-4 py-4">
            <div class="" >
                <a class="navbar-brand" href="/project3/">Dashboard</a>
            </div>
            <div class=" d-flex justify-content-between" >
                <?php if (isset($_SESSION['user'])) : ?>
                        <div class="mx-2">
                            <p><strong><?php echo $_SESSION['user']; ?></strong></p>
                        </div>
                        <div class="">
                            <p><a href="index.php?logout='1'" style="color: red;">Logout</a></p>
                        </div>
                <?php endif ?>
            </div>
        </nav>
    </div>
    <?php if (isset($_SESSION['error'])) : ?>
            <div class="error">
                <h3>
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
    <div class=" mx-auto p-4" style="width: 80%;">
        <!-- <div class="d-flex justify-content-end">
            <a href="#" class="btn btn-primary">Download Pay Slip</a>
        </div> -->
    </div>         
        <div class=" d-flex mx-auto p-4" style="width: 80%;">
            <div class="card  m-4" style="width: 60%;">
                <h5 class="m-4">Deductions</h5>
                <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between">
                        <div>NHIF:</div>
                        <div><?php echo $record['nhif'] ?></div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <div>NSSF:</div>
                        <div><?php echo $record['nssf'] ?></div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <div>PAYE:</div>
                        <div><?php echo $record['paye'] ?></div>
                    </li>
                </ul>
                <div class="card-footer d-flex justify-content-between">
                    <div>Total Deductions:</div>
                    <div>Ksh. <?php echo $deductions ?></div>
                </div>
            </div>
            <div class="card m-4" style="width: 60%;">
                <h5 class="m-4">Allowances and Benefits</h5>
                <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between">
                        <div>Leave Allowance:</div>
                        <div><?php echo $record['leave_allowance'] ?></div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <div>Medical Benefits:</div>
                        <div><?php echo $record['medical_allowance'] ?></div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <div>House Allowance</div>
                        <div><?php echo $record['house_allowance'] ?></div>
                    </li>
                </ul>
                <div class="card-footer d-flex justify-content-between">
                    <div>Total Allowances:</div>
                    <div>Ksh. <?php echo $benefits ?></div>
                </div>
            </div>
        </div>
        <div class=" mx-auto p-4" style="width: 80%;">
            <div class="card  m-4" style="width: 60%;">
                <h5 class="m-4">Income Breakdown</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between">
                        <div>Basic Salary:</div>
                        <div><?php echo $record['basic_salary'] ?></div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <div>Gross Salary:</div>
                        <div><?php echo $gross_pay ?></div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <div>Net Salary:</div>
                        <div>Ksh. <?php echo $net_pay ?></div>
                    </li>
                </ul>                
            </div>
        </div>
    </body>
</html>