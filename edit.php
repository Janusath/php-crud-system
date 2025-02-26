<?php
require("./database.php");
// $id = $_GET["id"];

// if (isset($_POST["submit"])) {
//   $first_name = $_POST['first_name'];
//   $last_name = $_POST['last_name'];
//   $email = $_POST['email'];
//   $gender = $_POST['gender'];

//   $sql = "UPDATE crud SET first_name='$first_name',last_name='$last_name',email='$email',gender='$gender' WHERE id = $id";

//   $result = mysqli_query($conn, $sql);

//   if ($result) {
//     header("Location: show.php?msg=Data updated successfully");
//   } else {
//     echo "Failed: " . mysqli_error($conn);
//   }
// }

?>

<!-- mysqli_real_escape_string method -->

<?php
// require("./database.php");
// $id = $_GET["id"];  // Get the user ID

// if (isset($_POST["submit"])) {
//     // Sanitize POST data using mysqli_real_escape_string
//     $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
//     $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
//     $email = mysqli_real_escape_string($conn, $_POST['email']);
//     $gender = mysqli_real_escape_string($conn, $_POST['gender']);

//     // SQL query to update the record
//     $sql = "UPDATE crud SET first_name='$first_name',last_name='$last_name',email='$email',gender='$gender' WHERE id = $id";

//     $result = mysqli_query($conn, $sql);

//     if ($result) {
//         header("Location: show.php?msg=Data updated successfully");
//     } else {
//         echo "Failed: " . mysqli_error($conn);
//     }
// }

?>


<!-- prepared statment -->

<?php
require("./database.php");
$id = $_GET["id"];  // Get the user ID


if (isset($_POST["submit"])) {
    // Prepare the SQL query to update the record
    $stmt = $conn->prepare("UPDATE crud SET first_name = ?, last_name = ?, email = ?, gender = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['gender'], $id);

    // Execute the prepared statement
    $result = $stmt->execute();

    if ($result) {
        header("Location: show.php?msg=Data updated successfully");
    } else {
        echo "Failed: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>PHP CRUD Application</title>
</head>

<body>
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
    PHP Complete CRUD Application
  </nav>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit User Information</h3>
      <p class="text-muted">Click update after changing any information</p>
    </div>

    <!-- normal method -->
    <?php
    // $sql = "SELECT * FROM crud WHERE id = $id";
    // $result = mysqli_query($conn, $sql);
    // $row = mysqli_fetch_assoc($result);
    ?>

    <!-- mysqli_real_escape_string method -->
    <?php
    // $id = mysqli_real_escape_string($conn, $id);
    // $sql = "SELECT * FROM crud WHERE id = $id";
    // $result = mysqli_query($conn, $sql);
    // $row = mysqli_fetch_assoc($result);
    ?>

    <!--  Prepared statement to fetch the record -->
    <?php 

        $sql = "SELECT * FROM crud WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);  // "i" means integer
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">First Name:</label>
            <input type="text" class="form-control" name="first_name" value="<?php echo $row['first_name'] ?>">
          </div>

          <div class="col">
            <label class="form-label">Last Name:</label>
            <input type="text" class="form-control" name="last_name" value="<?php echo $row['last_name'] ?>">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Email:</label>
          <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>">
        </div>

        <div class="form-group mb-3">
          <label>Gender:</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="gender" id="male" value="male" <?php echo ($row["gender"] == 'male') ? "checked" : ""; ?>>
          <label for="male" class="form-input-label">Male</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="gender" id="female" value="female" <?php echo ($row["gender"] == 'female') ? "checked" : ""; ?>>
          <label for="female" class="form-input-label">Female</label>
        </div>

        <div>
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          <a href="index.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>