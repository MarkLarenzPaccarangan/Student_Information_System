<?php
include "database.php";

if (isset($_POST["submit"])) {
   $subject_code = $_POST['subject_code'];
   $subject_description = $_POST['subject_description'];
   $subject_units = $_POST['subject_units'];
 
   $sql = "INSERT INTO `subjects`(`id`, `subject_code`,`subject_units`, `subject_description`) VALUES (NULL, '$subject_code',' $subject_units','$subject_description')";

   $result = mysqli_query($conn, $sql);

   if ($result) {
      header("Location: subjects.php?msg=New record created successfully");
   } else {
      echo "Failed: " . mysqli_error($conn);
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

   <title>ADD SUBJECT</title>
</head>

<body>
   <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
      ADD SUBJECT
   </nav>

   <div class="container">
      <div class="text-center mb-4">
         <h3>Add New subject</h3>
         <p class="text-muted">Complete the form below to add a new subject</p>
      </div>

      <div class="container d-flex justify-content-center">
         <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
               <label class="form-label">Subject Code:</label>
               <input type="text" class="form-control" name="subject_code" placeholder="GEC 1" required>
            </div>
            
            <div class="row mb-3">
               <label class="form-label">Subject Description:</label>
               <input type="text" class="form-control" name="subject_description" placeholder="Understanding the self" required>
            </div>
            <div class="row mb-3">
               <label class="form-label">Subject Units:</label>
               <input type="text" class="form-control" name="subject_units" placeholder="3" required>
            </div>
            <div>
               <button type="submit" class="btn btn-success" name="submit">Save</button>
               <a href="index.php" class="btn btn-danger">Cancel</a>
            </div>
         </form>
      </div>
   </div>

   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
