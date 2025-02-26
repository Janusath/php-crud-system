
<!-- normal method -->
<?php
// require("./database.php");
// $id = $_GET["id"];  // Get the user ID from the URL
// $sql = "DELETE FROM crud WHERE id = $id";
// $result = mysqli_query($conn, $sql);

// if ($result) {
//   header("Location: show.php?msg=Data deleted successfully");
// } else {
//   echo "Failed: " . mysqli_error($conn);
// }
?>


<!-- mysqli_real_escape_string -->
<?php
// require("./database.php");
// $id = $_GET["id"];
// $id = mysqli_real_escape_string($conn, $id);
// $sql = "DELETE FROM crud WHERE id = $id";
// $result = mysqli_query($conn, $sql);

// if ($result) {
//   header("Location: show.php?msg=Data deleted successfully");
// } else {
//   echo "Failed: " . mysqli_error($conn);
// }
?>


<!-- prepared statment -->

<?php
require("./database.php");
$id = $_GET["id"];
$sql = "DELETE FROM crud WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);  // "i" indicates an integer type
if (mysqli_stmt_execute($stmt)) {
  header("Location: show.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}
?>
