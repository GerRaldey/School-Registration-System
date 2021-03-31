<?php
 include 'dbconnect.php';

if(isset($_GET['details'])){
   $id=$_GET['details'];

   $query="SELECT * FROM students WHERE student_id=?";
   $stmt=$connect->prepare($query);
   $stmt->bind_param("i", $id);
   $stmt->execute();
   $result=$stmt->get_result();
   $row=$result->fetch_assoc();

   $id=$row['student_id'];
   $fname=$row['first_name'];
   $lname=$row['last_name'];
   $course=$row['course'];
   $email=$row['email'];
   $year=$row['year_level'];
   $entry=$row['entry'];

}

?>	