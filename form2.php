<?php
if(filter_has_var(INPUT_POST,'submit')){
    $servername   = "localhost";
    $database = "mytest";
    $username = "root";
    $password = "";
    $con=mysqli_connect($servername,$username,$password, $database);
    // Check connection
   if ($con->connect_error) {
   die("Connection failed: " . $conn->connect_error);
   }
   // GET the form data
   $poster = addslashes(file_get_contents($_FILES['poster']['tmp_name']));
   $location= mysqli_real_escape_string($con,$_POST['location']);
   $date= mysqli_real_escape_string($con,$_POST['date']);
   $description= mysqli_real_escape_string($con,$_POST['description']);
   

   // Create connection
   $sql="INSERT INTO sponsor (poster, location, date, description ) VALUES ('{$poster}', '$location', '$date','$description')";

   if(mysqli_query($con, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}

mysqli_close($con);
}   
?>

