<?php
$insert = false;
$delete = false;
$update = false; // New flag for successful edit

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "note";

// Create a connection 
$mysqli = mysqli_connect($servername, $username, $password, $database);

// Die if connection is unsuccessful
if (!$mysqli) {
    die("Connection unsuccessful: " . mysqli_connect_error());
}

if (isset($_GET['delete'])) {
    $sno = $_GET['delete'];
    $sql = "DELETE FROM notes WHERE `Sno.` = $sno";
    $result = mysqli_query($mysqli, $sql);
    if ($result) {
        $delete = true;
        // Redirect to the same page to clean URL
        header("Location: /inotes/index.php?delete=true");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['snoEdit'])) {
        // Update the record
        $sno = $_POST["snoEdit"];
        $title = $_POST["titleEdit"];
        $description = $_POST["descriptionEdit"];
        $sql = "UPDATE notes SET title = '$title', description = '$description' WHERE `Sno.` = $sno";
        $result = mysqli_query($mysqli, $sql);
        if ($result) {
            $update = true; // Set flag for successful edit
            // Redirect to the same page to clean URL
            header("Location: /inotes/index.php?update=true");
            exit();
        }
    } else {
        // Insert a new record
        $title = $_POST["title"];
        $description = $_POST["description"];
        $sql = "INSERT INTO notes (title, Description) VALUES ('$title', '$description')";
        $result = mysqli_query($mysqli, $sql);
        if ($result) {
            $insert = true;
            // Redirect to the same page to prevent form resubmission
            header("Location: /inotes/index.php?insert=true");
            exit();
        } else {
            echo "Error: " . mysqli_error($mysqli);
        }
    }
}

// Check for query parameters and set flags
if (isset($_GET['insert']) && $_GET['insert'] == 'true') {
    $insert = true;
}

if (isset($_GET['delete']) && $_GET['delete'] == 'true') {
    $delete = true;
}

if (isset($_GET['update']) && $_GET['update'] == 'true') {
    $update = true;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iNotes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
</head>
<body>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel">Edit this note</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="/inotes/index.php" method="post">
        <input type="hidden" name="snoEdit" id="snoEdit">
        <div class="mb-3">
          <label for="titleEdit" class="form-label">Note title</label>
          <input type="text" class="form-control" id="titleEdit" name="titleEdit" placeholder="Enter title">
        </div>
        <div class="mb-3">
          <label for="descriptionEdit" class="form-label">Note Description</label>
          <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Note</button>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">iNotes</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div> 
</nav>

<?php
if ($insert) {
    echo "
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Success!</strong> Your note has been inserted successfully.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
}

if ($delete) {
    echo "
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Success!</strong> Your note has been deleted successfully.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
}

if ($update) {
    echo "
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Success!</strong> Your note has been updated successfully.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
}
?>

<div class="container my-4">
  <h2>Add a Note</h2>
  <form action="/inotes/index.php" method="post">
    <div class="mb-3">
      <label for="title" class="form-label">Note title</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
    </div>
    <div class="mb-3">
      <label for="desc" class="form-label" id="desc">Note Description</label>
      <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Add Note</button>
  </form>
</div>

<div class="container my-4">
  <table class="table" id="myTable">
    <thead>
      <tr>
        <th scope="col">Sno.</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT * FROM notes";
      $result = mysqli_query($mysqli, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
          <th scope='row'>" . $row["Sno."] . "</th>
          <td>" . $row["title"] . "</td>
          <td>" . $row["Description"] . "</td>
          <td>
            <button class='edit btn btn-sm btn-primary' id='" . $row["Sno."] . "'>Edit</button>
            <a href='/inotes/index.php?delete=" . $row["Sno."] . "'><button class='delete btn btn-sm btn-danger'>Delete</button></a>
          </td>
        </tr>";
      }
      ?>
    </tbody>
  </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.datatables.net/2.1.3/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function () {
    $('#myTable').DataTable();

    // Edit button click handler
    $('.edit').click(function () {
        var id = $(this).attr('id');
        $.ajax({
            url: '/inotes/getNote.php',
            method: 'POST',
            data: { id: id },
            success: function (response) {
                var note = JSON.parse(response);
                $('#snoEdit').val(note.sno);
                $('#titleEdit').val(note.title);
                $('#descriptionEdit').val(note.description);
                $('#editModal').modal('show');
            }
        });
    });
});
</script>

</body>
</html>
