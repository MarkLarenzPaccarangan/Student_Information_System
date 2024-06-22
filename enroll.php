<?php
include('database.php'); 

// Fetch students from the database
$studentQuery = "SELECT id, CONCAT(first_name, ' ', last_name) AS full_name FROM students";
$studentResult = mysqli_query($conn, $studentQuery);

if (!$studentResult) {
    die('Query failed: ' . mysqli_error($conn));
}

// Fetch courses from the database
$courseQuery = "SELECT id, course_code, course_description FROM courses";
$courseResult = mysqli_query($conn, $courseQuery);

if (!$courseResult) {
    die('Query failed: ' . mysqli_error($conn));
}

// Fetch subjects from the database
$subjectQuery = "SELECT * FROM subjects";
$subjectsResult = mysqli_query($conn, $subjectQuery);

if (!$subjectsResult) {
    die('Query failed: ' . mysqli_error($conn));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $selectedSubjects = $_POST['subjects'];

    foreach ($selectedSubjects as $subject_id) {
        // Check for duplicate enrollment
        $checkQuery = "SELECT * FROM enrollments WHERE student_id = '$student_id' AND subject_id = '$subject_id'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) == 0) {
            $enrollQuery = "INSERT INTO enrollments (student_id, subject_id) VALUES ('$student_id', '$subject_id')";
            mysqli_query($conn, $enrollQuery);
        }
    }

    // Redirect to index.php after successful enrollment
    echo "<script>alert('You are successfully Enrolled!'); window.location.href = 'index.php';</script>";
    exit; // Terminate further execution after redirection
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enroll Subjects</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <script>
        function validateForm() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
            if (checkboxes.length === 0) {
                alert("Please select at least one subject.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
    <h1 style="font-family: Arial, Helvetica, sans-serif; font-weight: bold;">Enrollment Page</h1>
</nav>

    <div class="container">
        <form method="POST" action="enroll.php" onsubmit="return validateForm();">
            <div class="mb-3">
                <label for="studentSelect" class="form-label"><h3>Select Student</h3></label>
                <select class="form-select" id="studentSelect" name="student_id">
                    <?php while ($student = mysqli_fetch_assoc($studentResult)) { ?>
                        <option value="<?php echo $student['id']; ?>"><?php echo htmlspecialchars($student['full_name']); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="courseSelect" class="form-label"><h3>Select Course</h3></label>
                <select class="form-select" id="courseSelect" name="course_id">
                    <?php while ($course = mysqli_fetch_assoc($courseResult)) { ?>
                        <option value="<?php echo $course['id']; ?>"><?php echo htmlspecialchars($course['course_code'] . ' - ' . $course['course_description']); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <h3>Select Subjects</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Subject Code</th>
                            <th>Subject Description</th>
                            <th>Subject Unit</th>
                            <th>Select</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($subject = mysqli_fetch_assoc($subjectsResult)) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($subject['subject_code']); ?></td>
                                <td><?php echo htmlspecialchars($subject['subject_description']); ?></td>
                                <td><?php echo htmlspecialchars($subject['subject_units']); ?></td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="subjects[]" value="<?php echo $subject['id']; ?>">
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary">Enroll</button>
            <a href="index.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
