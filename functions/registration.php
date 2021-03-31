<?php 
include 'dbconnect.php';
include 'actions.php';
$class = new actions();
$class->registration(); 



        $update = false;
        $id="";
        $fname="";
        $lname="";
        $course="";
        $email="";
        $year = "";
        $status = "";
        $remark = "";
        $entry = "";
        


      if(isset($_GET['edit'])){
        $id=$_GET['edit'];
        
        $query="SELECT * FROM students WHERE student_id=?";
        $stmt=$connect->prepare($query);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result=$stmt->get_result();
        $row=$result->fetch_assoc();

        $id=$row['student_id'];
        $fname=$row['first_name'];
        $lname=$row['last_name'];
        $course=$row['course'];
        $email = $row['email'];
        $year = $row['year_level'];
        $status = $row['status'];
        $remark = $row['requirement'];
        $entry = $row['lacking'];
        $update=true;

      }

      if(isset($_POST['update'])){
        $id=$_POST['id'];
        $fname=$_POST['firstname'];
        $lname=$_POST['lastname'];
        $course=$_POST['course'];
        $email=$_POST['email'];
        $year=$_POST['year'];
        $status=$_POST['status'];
        $remark = $_POST['remark'];
        $entry = $_POST['lacking'];

        $query="UPDATE students SET first_name=?, last_name=?, course=?, email=?, year_level=?, status=?, requirement=?, entry=? WHERE student_id=?";
        $stmt=$connect->prepare($query);
        $stmt->bind_param("ssssssssi",$fname,$lname,$course,$email,$year,$status,$remark,$entry, $id);
        $stmt->execute();

        $_SESSION['response']="Updated Successfully!";
        $_SESSION['res_type']="primary";
        header('location: ../pages/admin_page.php');
       }

    $connect->close()


?>