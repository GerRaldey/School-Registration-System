<?php

class actions { 

  
  function registration(){

       session_start();
       include("dbconnect.php");

      if(isset($_POST['add'])){
      $id = $_POST['id'];
      $fname = $_POST['firstname'];
      $lname = $_POST['lastname'];
      $course = $_POST['course'];
      $email = $_POST['email'];
      $year = $_POST['year'];
      $status = $_POST['status'];
      $remark = $_POST['remark'];
      $entry = $_POST['lacking'];

      $check_duplicate = "SELECT * FROM students WHERE student_id= '$id' ";
      if(mysqli_num_rows($check_duplicate) > 0){
        echo '<script type="text/javascript">alert("$id"."student id is already exists in your database. Please try another id again.");window.location=\'../pages/admin_page.php\';</script>';
      }

       $sql = "INSERT INTO students (student_id, first_name, last_name, course, email, year_level, status, requirement, entry) 
               VALUES('$id', '$fname', '$lname', '$course', '$email', '$year', '$status', '$remark', '$entry') ";

       if ($connect->query($sql) === TRUE) {
          header("Location: ../pages/admin_page.php");
          $_SESSION['response']='Added Successfully!';
          $_SESSION['res_type']='success';
      } else {
          echo "Error: " . $sql . "<br>" . $connect->error;
        }
      }

      $connect->close();
    

  }

  function deleteStudent(){
     session_start();
     if(isset($_GET['delete'])){
     $id = $_GET['delete'];

     include('dbconnect.php');
     
     $query="DELETE FROM students WHERE student_id=?";
     $stmt=$connect->prepare($query);
     $stmt->bind_param("i",$id);
     $stmt->execute();

     header('Location: ../pages/admin_page.php');
     $_SESSION['response']="Deleted Successfully!";
     $_SESSION['res_type']="danger";

 }
  }
 
	function deleteSubject() {

     if(isset($_GET['delete'])){
     $id = $_GET['delete'];

     include('dbconnect.php');
     
     $query="DELETE FROM subjects WHERE registration_id=?";
     $stmt=$connect->prepare($query);
     $stmt->bind_param("i",$id);
     $stmt->execute();
     
     header('Location: '.$_SERVER['HTTP_REFERER']);
  }

	}


	function addSubject(){
	 include 'dbconnect.php';

       if(isset($_POST['addSubject'])){  
        $stud_id = $_POST['stud_id'];
        $subject_code = $_POST['code'];
        $title = $_POST['title'];
        $units = $_POST['units'];
        $grade = $_POST['grade'];
        $teacher = $_POST['teacher'];
        $year = $_POST['year'];
        $sem = $_POST['sem'];
        $status = $_POST['status'];
        $remarks = $_POST['remarks'];

        $sql = "INSERT INTO subjects (subject_code, title, units, grade, teacher, year, sem, status, remarks, student_id) 
         VALUES('$subject_code', '$title', '$units', '$grade', '$teacher', '$year', '$sem', '$status', '$remarks', '$stud_id') ";
       	 
       	 if($connect->query($sql) === FALSE) {
       	 	echo "Failed to connect db: ".$connect->error;
       	 }
       	 else{
       	 	header("Location: ../pages/details_page.php?details=$stud_id");
       	 }

       } 
        
	}

  function editSubject(){
      function updateSubject(){
      include 'dbconnect.php';
      $id = $_POST['id'];
      $subCode = $_POST['code'];
      $title = $_POST['title'];
      $units = $_POST['units'];
      $grade = $_POST['grade'];
      $teacher = $_POST['teacher'];
      $year = $_POST['year'];
      $sem = $_POST['sem'];
      $status = $_POST['status'];
      $remarks = $_POST['remarks'];
     // Update selected record
      $sql = "UPDATE subjects SET subject_code='$subCode', title='$title', units='$units', grade='$grade', teacher='$teacher', year='$year', sem='$sem', status='$status', remarks='$remarks' WHERE registration_id='$id' ";
      $updateQuery = mysqli_query($connect, $sql);
      if(!$updateQuery){
        echo "Error: ".$sql.mysli_error($connect);
      }
       echo "Successfully Update!";
       header('Location: '.$_SERVER['HTTP_REFERER']);

    }

    if(isset($_POST['updateSubject'])){
      updateSubject();
     }
           
   }

    function print(){
         
          include 'fpdf17/fpdf.php';
          include 'dbconnect.php';

          if(isset($_GET['print'])){
          $id = $_GET['print'];

          $pdf = new FPDF('P', 'mm', 'A4');

          $pdf->AddPage();
          //                                            x,   y width, height
          $pdf->Image('../Assets/img/school-logo.jpg', 140, -14, 60, 60);

          $sql = "SELECT * FROM students WHERE student_id = '$id' ";
          $conn = mysqli_query($connect, $sql);

          while($data=mysqli_fetch_array($conn)){
          //set font to arial bold, 14pt
          $pdf->SetFont('Arial', 'B', 12);
          //Cell(width, height, text, border, endline, [align])
          $pdf->Cell(18, 5,'Course:',0,0);
          $pdf->SetFont('Arial', '', 12);
          $pdf->Cell(50, 5,$data['course'],0,1);

          $pdf->SetFont('Arial', 'B', 12);
          $pdf->Cell(33, 5, 'Student Name:',0,0);
          $pdf->SetFont('Arial', '', 12);
          $pdf->Cell(15, 5, $data['last_name'].',',0,0);
          $pdf->Cell(15, 5, ' '.$data['first_name'],0,1);


          $pdf->SetFont('Arial', 'B', 12);
          $pdf->Cell(15, 5, 'ID No.:',0,0);
          $pdf->SetFont('Arial', '', 12);
          $pdf->Cell(5, 5, $id, 0, 1);


          $pdf->SetFont('Arial', 'B', 12);
          $pdf->Cell(30, 5, 'Evaluated By: ',0,0);
          $pdf->SetFont('Arial', '', 12);
          $pdf->Cell(10, 5, 'Ailyn N. Abordo',0,1);

          $pdf->SetFont('Arial', 'B', 12);
          $pdf->Cell(43, 5, 'Entry Requirements:',0,0);
          $pdf->SetFont('Arial', '', 12);
          $pdf->Cell(95, 5, $data['entry'],0,0);
          $pdf->SetFont('Arial', 'B', 12);
          $pdf->Cell(59, 5, 'EVALUATION FORM',0,1);
          }

          $pdf->Cell(10, 5, '', 0, 1);

          $pdf->SetFont('Arial', 'B', 12);
          $pdf->Cell(20, 7, 'Year', 1, 0);
          $pdf->Cell(15, 7, 'Sem', 1, 0);
          $pdf->Cell(30, 7, 'Course Code', 1, 0);
          $pdf->Cell(50, 7, 'Course Description', 1, 0);
          $pdf->Cell(15, 7, 'Units', 1, 0);
          $pdf->Cell(15, 7, 'Grade', 1, 0);
          $pdf->Cell(18, 7, 'Status', 1, 0);
          $pdf->Cell(25, 7, 'Remarks', 1, 1);

          $sub_query = "SELECT * FROM subjects WHERE student_id = '$id' ";
          $query = mysqli_query($connect, $sub_query);
          while ($subject=mysqli_fetch_array($query)) {
             $pdf->SetFont('Arial', '', 11);
             $pdf->Cell(20, 6, $subject['year'], 1, 0);
             $pdf->Cell(15, 6, $subject['sem'], 1, 0);
             $pdf->Cell(30, 6, $subject['subject_code'], 1, 0);
             $pdf->Cell(50, 6, $subject['title'], 1, 0);
             $pdf->Cell(15, 6, $subject['units'], 1, 0);
             $pdf->Cell(15, 6, $subject['grade'], 1, 0);
             $pdf->Cell(18, 6, $subject['status'], 1, 0);
             $pdf->Cell(25, 6, $subject['remarks'], 1, 1);
          }

          $pdf->Output();

          }

                   

      }

}

?>