<?php
require 'connection.php';
$sql = "SELECT * FROM employees";
$connection = new mysqli('localhost', 'root', '', 'employees_db');
$result = $connection->query($sql);

if (isset($_GET['success']) && $_GET['success'] == 0) {
  echo '<div  class="alert alert-success alert-dismissible fade show position-fixed bottom-0 end-0" role="alert" style="margin: 20px;">
  <strong>Data added successfully! </strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

if (isset($_GET['success']) && $_GET['success'] == 1) {
  echo '<div  class="alert alert-info alert-dismissible fade show position-fixed bottom-0 end-0" role="alert" style="margin: 20px;">
  <strong>Data updated successfully! </strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}



if (isset($_GET['success']) && $_GET['success'] == 2) {
  echo '<div class="alert alert-danger alert-dismissible fade show position-fixed bottom-0 end-0" role="alert" style="margin: 20px;">
  <strong>The Data has been deleted !</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>Manajemen Data Karyawan</title>
</head>

<body id="index">


  <div id="index" class="container my-5">
    <h3>Employee Data Management</h3>
    <hr>
    <a class="btn btn-primary" href="create.php" role="button">Add Employee</a>
    <br>

    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Department</th>
          <th scope="col">Position</th>
          <th scope="col">Salary</th>
          <th scope="col">Start Date</th>
          <th scope="col">Created_At</th>
          <th scope="col">Updated_At</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>

        <?php foreach ($result as $row) { ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['department']; ?></td>
            <td><?php echo $row['position']; ?></td>
            <td><?php echo $row['salary']; ?></td>
            <td><?php echo $row['start_date']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td><?php echo $row['updated_at']; ?></td>
            <td>
              <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $row['id']; ?>">
                Update
              </button>
            </td>
            <td>
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row['id']; ?>">
                Delete
              </button>
            </td>
          </tr>

        <?php } ?>

      </tbody>
    </table>
    <!-- Awal Modal Update -->
    <?php foreach ($result as $row) { ?>
      <div class="modal fade" id="updateModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="updateModalLabel">Update Employee</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="update.php?id=<?php echo $row['id']; ?>">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>">
                </div>

                <div class="mb-3">
                  <label for="department">Department</label>
                  <input type="text" class="form-control" name="department" value="<?php echo $row['department']; ?>">
                </div>

                <div class="mb-3">
                  <label for="position" class="form-label">Position</label>
                  <input type="text" class="form-control" name="position" value="<?php echo $row['position']; ?>">
                </div>

                <div class="mb-3">
                  <label for="salary" class="form-label">Salary</label>
                  <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control" name="salary" value="<?php echo $row['salary']; ?>">
                  </div>
                </div>

                <div class="mb-3">
                  <label for="start_date" class="form-label">Start Date</label>
                  <input type="date" class="form-control" name="start_date" value="<?php echo $row['start_date']; ?>">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button class="btn btn-primary" type="submit">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    <!-- Akhir Modal Update -->


    <!-- Awal Modal Delete -->
    <?php foreach ($result as $row) { ?>
      <div class="modal fade" id="deleteModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Delete Employee</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Are you sure you want to delete this employee?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>" role="button">Delete</a>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    <!-- Akhir Modal Delete -->

</body>
<script>
  src = "main.js"
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

</html>