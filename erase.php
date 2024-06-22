<?php
include "database.php";
$id = $_GET["id"];
$sql = "DELETE FROM `subjects` WHERE id = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: subjects.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}