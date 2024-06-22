<?php
include('database.php');

if (!isset($_GET['student_id'])) {
    die('Student ID not provided.');
}

$student_id = $_GET['student_id'];

// Fetch student information
$studentQuery = "SELECT id, CONCAT(first_name, ' ', last_name) AS full_name, course FROM students WHERE id = ?";
$stmt = $conn->prepare($studentQuery);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$studentResult = $stmt->get_result();
$student = $studentResult->fetch_assoc();

if (!$student) {
    die('Student not found.');
}

// Fetch enrolled subjects
$subjectsQuery = "SELECT subjects.subject_code, subjects.subject_description, subjects.subject_units 
                  FROM enrollments 
                  JOIN subjects ON enrollments.subject_id = subjects.id 
                  WHERE enrollments.student_id = ?";
$stmt = $conn->prepare($subjectsQuery);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$subjectsResult = $stmt->get_result();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Assessment Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
    <h1 style="font-family: Arial, Helvetica, sans-serif; font-weight: bold;">Student Assessment Form</h1>
</nav>
<a href="reports.php" class="btn btn-dark mb-3">BACK</a>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Student Name: <?php echo htmlspecialchars($student['full_name']); ?></h3>
            <h5 class="card-subtitle mb-3 text-muted">Course: <?php echo htmlspecialchars($student['course']); ?></h5>
            <h3 class="card-title">Enrolled Subjects:</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Subject Code</th>
                        <th>Subject Description</th>
                        <th>Subject Units</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalUnits = 0;
                    while ($subject = $subjectsResult->fetch_assoc()) {
                        $totalUnits += $subject['subject_units'];
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($subject['subject_code']); ?></td>
                            <td><?php echo htmlspecialchars($subject['subject_description']); ?></td>
                            <td><?php echo htmlspecialchars($subject['subject_units']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <h5 class="card-subtitle mt-3 text-muted">Total Units: <?php echo $totalUnits; ?></h5>
        </div>
    </div>
</div>

</body>
</html>
