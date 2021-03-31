<?php 
 include '../Includes/admin_head.php';
 include '../functions/registration.php';

// We need to use sessions, so you should always start sessions using the below code.
// If the user is not logged in redirect to the login page...

if (!isset($_SESSION['loggedin'])) {
  header('Location: ../index.php');
  exit();
}

?>


<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">

  <a class="navbar-brand" href="#">
    <img src="../Assets/img/informatics-logo.jpg" width="38" height="40" class="d-inline-block align-top rounded-circle" alt="School logo">
    Informatics School
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <button class="btn btn-outline-primary">
        <a class="nav-link text-light" href="../functions/logout.php"><b>Log out</b></a>
        </button>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"></a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link disabled" href="#"></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" method="POST">
      <input class="form-control mr-sm-2" type="search" name="input" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-primary my-2 my-sm-0 btn-search" type="submit" name="search">Search</button>
    </form>
  </div>
</nav>

<div class="container">
<br>
 <div class="row justify-content-center mt-30">
 <div class="col-md-10 mt-30">
   <h3 class="text-center">Student Registration</h3>
   <hr>
    <?php if(isset($_SESSION['response'])){ ?>
      <div class="alert alert-<?=$_SESSION['res_type']; ?> alert-dismissible fade show text-center">
       <button type="button" class="close" data-dismiss="alert">&times;</button>
      <b><?= $_SESSION['response']; ?></b>
     </div>
     <?php } unset($_SESSION['response']); ?>
 </div>
</div>

     
   <div class="row justify-content-center">
     <h3 class="text-center text-info">Current Record</h3>
   </div>  

  <!-- <div class="row justify-content-center" > -->
    <div class="tableFixhead">
      <table class="table table-hover">
          <thead class="bg-dark text-light">
            <tr>
              <th>#</th>
              <th>ID no.</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Course</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
      <tbody>
        <?php
        include('../functions/dbconnect.php');
        if(isset($_POST['search'])){
           $value=$_POST['input'];
           $sql="SELECT * FROM `students` WHERE CONCAT (`student_id`, `first_name`, `last_name`, `course`, `status`) LIKE '%".$value."%' ";
           $result=$connect->query($sql);

        }
        else{
           $sql = "SELECT student_id, first_name, last_name, course, status FROM students";
           $result = $connect-> query($sql);
         }

         ?>
       
      <?php while($row = $result->fetch_assoc()){ ?>
          <tr>
            <td></td>
            <td><?= $row['student_id']; ?></td>
            <td><?= $row['first_name']; ?></td>     
            <td><?= $row['last_name']; ?></td>
            <td><?= $row['course']; ?></td>
            <td><?= $row['status']; ?></td>
            <td>
            
              <a href="details_page.php?details=<?= $row['student_id']; ?>" class="badge badge-primary p-2">Details</a> |
              <a href="../functions/delete.php?delete=<?=$row['student_id'] ;?>" class="badge badge-danger p-2" onclick="return confirm('Do you want to delete this item?');">Delete</a> |
              <a class="badge badge-success p-2" href="admin_page.php?edit=<?=$row['student_id'];?>">Edit</a> 
            </td>
          </tr>
       <?php } ?>
    </tbody>
   </table>
  </div>
<!-- </div> -->

<br>
<div class="row justify-content-center">
   <?php if(isset($_GET['edit'])){ ?>
  <button class="btn btn-lg btn-success" data-toggle="modal" data-target="#myModal" id="btn-modal">Click to edit</button>
  <?php } else{ ?>
    <button class="btn btn-lg btn-primary" data-toggle="modal" data-target="#myModal" id="btn-modal">Add New</button>
  <?php } ?>
</div>
 
 <!-- Modal  registration form-->
 <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Registration Form</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

        <form action="../functions/registration.php" method="POST" enctype="multipart/form-data">
               <div class="form-group">
              <label for="student_id">Student ID:</label>
              <input type="text"  class="form-control" placeholder="Assign ID" name="id" value="<?=$id;?>" required>
            </div>
            <div class="form-group">
              <label for="email">First Name:</label>
              <input type="text" class="form-control" placeholder="First name" name="firstname" value="<?=$fname;?>" required>
            </div>
            <div class="form-group">
              <label for="email">Last name:</label>
              <input type="text" class="form-control" placeholder="Last Name" name="lastname" value="<?=$lname;?>" required>
            </div>
            <div class="form-group">
              <label for="course">Course:</label>
              <input type="text" class="form-control" placeholder="Enter course" name="course" value="<?=$course;?>" required>
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" placeholder="Email" name="email" value="<?=$email;?>" required>
            </div>
            <div class="form-group">
              <label for="year">Year Level:</label>
     <select type="text" class="form-control" placeholder="Year Level" name="year" value="<?=$year;?>" required>
        <option>1st</option>
        <option>2nd</option>
        <option>3rd</option>
        <option>4th</option>
      </select> 
  </div>
  <div class="form-group">
    <label for="status">Status:</label>
    <input type="text" class="form-control" placeholder="Enter status" name="status" value="<?=$status;?>" required>
  </div>
  <div class="form-group">
    <label for="remark">Remarks:</label>
    <input type="text" class="form-control" placeholder="" name="remark" value="<?=$remark;?>" required>
  </div>
  <div class="form-group">
    <label for="lacking">Entry Requirements:</label>
    <input type="text" class="form-control" placeholder="ex. Form-137,TOR" name="lacking" value="<?=$entry;?>" required>
  </div>

  <div class="form-group">
    <?php if($update==true){ ?>
      <input type="submit" class="btn btn-success btn-block" name="update" value="Update Record">
     <?php } else{ ?> 
    <input type="submit" class="btn btn-primary btn-block" name="add" value="Add Student">
  <?php } ?>
  </div>
     </form>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
     </div>
    </div>


</div> <!-- container -->

<?php include("../Includes/admin_footer.php"); ?>
