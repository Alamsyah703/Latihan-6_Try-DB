<?php

require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_GET['id'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    $start_date = $_POST['start_date'];

    $sql = "UPDATE employees SET name='$name', department='$department', position='$position', salary='$salary', start_date='$start_date' WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('Location: index.php?success=1');
        exit();
    } else {
        echo "Failed to update data: " . mysqli_error($conn);
    }
} else {
    $id = $_GET['id'];
    mysqli_select_db($conn, 'employees_db');
    $sql = "SELECT * FROM employees WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $employee = mysqli_fetch_assoc($result);

    if (!$employee) {
        echo "Employee not found";
        exit;
    }
}
