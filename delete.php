<?php
include "database.php";

$id = $_GET["id"];

mysqli_begin_transaction($conn);

try {
    // Delete from enrollments table first
    $sql = "DELETE FROM `enrollments` WHERE student_id = $id";
    mysqli_query($conn, $sql);

    // Delete from students table
    $sql = "DELETE FROM `students` WHERE id = $id";
    mysqli_query($conn, $sql);

    // Commit transaction
    mysqli_commit($conn);

    header("Location: user.php?msg=Data deleted successfully");
} catch (mysqli_sql_exception $exception) {
    // Rollback transaction if any error occurs
    mysqli_rollback($conn);

    echo "Failed: " . $exception->getMessage();
}
?>
