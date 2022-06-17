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

    include('index_db.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
    <div class=" mx-auto p-4" style="width: 80%;">
        <div class="d-flex justify-content-end">
            <a href="add.php" class="btn btn-primary">Add</a>
        </div>
    </div>
    <div class=" mx-auto p-4" style="width: 80%;">
        <table class="table ">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Position</th>
                    <th class="text-center" scope="col">Action</th>
                </tr>
            </thead>
                    <tbody>
                        <?php foreach($data as $key => $employee) : ?>
                            <tr>
                                <th scope="row"><?php echo $key+1 ?></th>
                                <td><?php echo $employee['name']; ?></td>
                                <td><?php echo $employee['email']; ?></td>
                                <td><?php echo $employee['phone']; ?></td>
                                <td><?php echo $employee['position']; ?></td>
                                <td class="text-center">
                                    <a href="view_record.php?id=<?php echo $employee['id']; ?>" class="text-primary m-2">view</a>
                                    <span  class="text-danger m-2" data-bs-toggle="modal" data-bs-target="#deleteModal">delete</span>                                    
                                </td>
                            </tr>
                            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete <?php echo $employee['name']; ?>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <a href="delete_db.php?id=<?php echo $employee['id']; ?>">
                                            <button type="button" class="btn btn-danger">
                                                    DELETE
                                            </button>
                                        </a>
                                    </div>
                                    </div>
                                </div>
                                </div>
                        <?php endforeach ?>
                    </table>
                </div>
    </body>
</html>