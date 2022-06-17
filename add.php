<?php 
    session_start();

    if (!isset($_SESSION['user'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['user']);
        header('location: login.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - add employee</title>
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
    <div class="row mx-auto p-4" style="width: 80%;">
        <form action="add_db.php" method="post" class="px-4">
            <?php include('errors.php'); ?>
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
            <div class="col-12">
                <label for="inputAddress" class="form-label text-muted">Personal Information</label>
            </div>
            <div class="row my-3">
                <div class="col">
                    <input type="text" name="name" required class="form-control" placeholder="Name" aria-label="Name">
                </div>
                <div class="col">
                    <input type="email" name="email" required class="form-control" placeholder="email" aria-label="Email">
                </div>            
            </div>
            <div class="row  my-3">
                <div class="col">
                    <input type="text" name="phone" required class="form-control" placeholder="Phone Number" aria-label="Phone Number">
                </div>
                <div class="col">
                    <input type="text" name="position" required class="form-control" placeholder="Position" aria-label="Position">
                </div>
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label text-muted">Salary Information</label>
            </div>
            <div class="row my-3">
                <div class="col">
                    <label for="inputAddress" class="form-label">Basic Salary</label>
                    <input type="number" name="basic_salary" required class="form-control"  aria-label="Gross">
                </div>                          
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label text-muted">Allowances</label>
            </div>
            <div class="row my-3">
                <div class="col">
                    <label for="inputAddress" class="form-label">Medical Allowance</label>
                    <input type="number" name="medical_allowance" required class="form-control"  aria-label="Monthly">
                </div>
                <div class="col">
                    <label for="inputAddress" class="form-label">Leave Allowance</label>
                    <input type="number" name="leave_allowance" required class="form-control" aria-label="Gross">
                </div>   
                <div class="col">
                    <label for="inputAddress" class="form-label">House Allowance</label>
                    <input type="number" name="house_allowance" required class="form-control" aria-label="Gross">
                </div>            
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label text-muted">Deductions</label>
            </div>
            <div class="row my-3">
                <div class="col">
                    <label for="inputAddress" class="form-label">NSSF </label>
                    <input type="number" name="nssf" required class="form-control" aria-label="Monthly">
                </div>
                <div class="col">
                    <label for="inputAddress" class="form-label">NHIF</label>
                    <input type="number" name="nhif" required class="form-control" aria-label="Leave Allowance">
                </div>   
                <div class="col">
                    <label for="inputAddress" class="form-label">PAYE</label>
                    <input type="number" name="paye" required class="form-control" placeholder="" aria-label="Gross">
                </div>            
            </div>
            <div class="col-12">
                <button type="submit"  name="reg_employee" id="reg_employee"  class="btn btn-primary">Create Record</button>
            </div>
        </form>
    </div>
</body>
</html>