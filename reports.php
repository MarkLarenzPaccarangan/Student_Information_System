<?php
include('database.php');

// Fetch students who have enrollments
$studentQuery = "SELECT DISTINCT students.id, CONCAT(students.first_name, ' ', students.last_name) AS full_name 
                 FROM students 
                 JOIN enrollments ON students.id = enrollments.student_id";
$studentResult = mysqli_query($conn, $studentQuery);

if (!$studentResult) {
    die('Query failed: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Select Student for Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
    <h1 style="font-family: Arial, Helvetica, sans-serif; font-weight: bold;">Select Student for Report</h1>
</nav>
<a href="index.php" class="btn btn-dark mb-3">BACK</a>
    <div class="container">
        <form method="GET" action="report.php">
            <div class="mb-3">
                <label for="studentSelect" class="form-label"><h3>Select Student</h3></label>
                <select class="form-select" id="studentSelect" name="student_id">
                    <?php while ($student = mysqli_fetch_assoc($studentResult)) { ?>
                        <option value="<?php echo $student['id']; ?>"><?php echo htmlspecialchars($student['full_name']); ?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Generate Assessment Form</button>
        </form>
    </div>
</body>
</html>
