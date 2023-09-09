<?php
if (isset($_GET['id'])) {

    $employee_id = intval($_GET['id']);


    $conn = mysqli_connect('localhost', 'root', '', 'employees_db');

   
    if (!$conn) {
        die('Gagal koneksi: ' . mysqli_connect_error());
    }

    $query = "DELETE FROM employees WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $employee_id);

    if (mysqli_stmt_execute($stmt)) {
      
        header('Location: index.php?success=2'); 
    } else {
        echo 'Gagal menghapus data: ' . mysqli_error($conn);
    }

  
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo 'Parameter "id" tidak ditemukan dalam URL.';
}
?>