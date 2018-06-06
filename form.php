<?php
if(filter_has_var(INPUT_POST,'submit')){
    $servername   = "localhost";
    $database = "mytest";
    $username = "root";
    $password = "";
    $con=mysqli_connect($servername,$username,$password, $database);
    mysql_set_charset('utf8');
    // Check connection
   if ($con->connect_error) {
   die("Connection failed: " . $conn->connect_error);
   }
   // GET the form data
   $name= mysqli_real_escape_string($con,$_POST['name']);
   $birth_date= mysqli_real_escape_string($con,$_POST['birth_date']);
   $sex= mysqli_real_escape_string($con,$_POST['sex']);
   $id_num= mysqli_real_escape_string($con,$_POST['id_num']);
   $phone= mysqli_real_escape_string($con,$_POST['phone']);
   $blood_type=$_REQUEST['blood_type'];

   // Create connection
   $sql="INSERT INTO subscriber (name, birth_date, sex, id_num, phone, blood_type ) VALUES ('$name', '$birth_date', '$sex','$id_num','$phone','$blood_type')";

   if(mysqli_query($con, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}

mysqli_close($con);
}   
?>

