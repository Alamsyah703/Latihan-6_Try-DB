<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    $start_date = $_POST['start_date'];


    if (empty($name) || empty($department) || empty($position) || empty($salary) || empty($start_date)) {
        echo '<script>alert("Please fill in all fields");</script>';
    } else {

        mysqli_select_db($conn, 'employees_db');


        $sql = "INSERT INTO employees (name, department, position, salary, start_date) VALUES ('$name', '$department', '$position', '$salary', '$start_date')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header('Location: index.php?success=0');
        } else {
            echo "Failed to add employee: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>New Employee</title>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container my-1 justify-content-end">
                <a class="btn btn-primary" href="index.php">Home</a>
            </div>
        </nav>
    </header>

    <form method="post">
        <div id="update" class="container my-5">
            <h2>New Employee</h2>
            <hr>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="" placeholder="Enter full name">
            </div>

            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <input type="text" class="form-control" name="department" value="" placeholder="Enter department">
            </div>

            <div class="mb-3">
                <label for="position" class="form-label">Position</label>
                <input type="text" class="form-control" name="position" value="" placeholder="Enter job position">
            </div>

            <div class="mb-3">
                <label for="salary" class="form-label">Salary</label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control" name="salary" value="" placeholder="Enter salary (without Rp symbol)">
                </div>
            </div>

            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" name="start_date" value="" placeholder="Select start date">
            </div>

            <div class="offset-sm-0 ">
                <button class="btn btn-primary" type="submit">Submit</button>
                <button class="btn btn-outline-secondary" type="reset">Cancel</button>

            </div>

            <div>
                <div class="offset-sm-3 col-sm-6">
                </div>
            </div>
        </div>
    </form>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

</html>