<?php 
   include '../functions/details.php';
   include '../Includes/details_head.php';
   include '../functions/editsub.php';
 ?>


 <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#">Student Information</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="container-fluid collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item text-light">
        <a class="btn btn-primary" href="admin_page.php">Back to main page</a>
      </li>
    </ul>
  </div>
 
</nav>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6 mt-3 bg-dark p-4 rounded">
			<h2 class="bg-light p-2 rounded text-center text-dark">Student ID: <?=$id?></h2>

			<h4 class="text-light"><b>Name:</b> <?=$fname?> <?=$lname?></h4>
			<h4 class="text-light"><b>Course:</b> <?=$course?></h4>
			<h4 class="text-light"><b>Email:</b> <?=$email?></h4>
      <br>
      <h4 class="text-light"><b>Year Level:</b> <?=$year?></h4>
      <h4 class="text-light"><b>Entry Requirement/s:</b> <?=$entry?></h4>
		</div>
	</div>
  <br>
    <h4 class="text-center">Course Subjects</h4>
  <div class="row justify-content-center">
    <table class="table table-hover">
    <thead class="bg-dark text-light">
      <tr>
        <td>Registration ID</td>
        <td>Subject code</td>
        <td>Description</td>
        <td>Units</td>
        <td>Grade</td>
        <td>Teacher</td>
        <td>Year</td>
        <td>Sem</td>
        <td>Status</td>
        <td>Remarks</td>
        <td></td>
      </tr>
    </thead>  
    <tbody>

      <?php 
         include '../functions/dbconnect.php';

         $sql = "SELECT registration_id, subject_code, title, units, grade, teacher, year, sem, status, remarks FROM subjects WHERE student_id = $id ";
         $result = $connect->query($sql);
       ?>
       <?php while($row = $result->fetch_assoc()){ ?>
       <tr> 
           <td><?= $row['registration_id']; ?></td>
           <td><?= $row['subject_code']; ?></td>
           <td><?= $row['title'];?></td>
           <td><?= $row['units'];?></td>
           <td><?= $row['grade'];?></td>
           <td><?= $row['teacher'];?></td>
           <td><?= $row['year'];?></td>
           <td><?= $row['sem'];?></td>
           <td><?= $row['status']; ?></td>
           <td><?= $row['remarks']; ?></td>
           <td>
             <a href="../functions/delete_sub.php?delete=<?= $row['registration_id'];?>" onclick="return confirm('Do you want to delete this item?');"><i class="fa fa-remove" style="color: red;">Delete</i></a>
           </td>
       </tr>
     <?php } ?>
     </tbody>
    </table>
  </div>
  
  <br>
     
    <div class="row justify-content-center mb-3"> 
    <button class="btn btn-info btn-border-5" data-toggle="modal" data-target="#myModal">Add Subject</button>

    <button class="btn btn-success btn-border-5 ml-2" id="update-btn" data-toggle="modal" data-target="#myModalUpdate">Update Subject</button>

    <a href="../functions/printpdf.php?print=<?=$id;?>" target="_blank" class="btn btn-danger btn-border-5 ml-2"><i class="fa fa-file-pdf-o">PDF</i></a>
    </div>

    

  <!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h4 class="modal-title text-light text-center">Add Subject</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="../functions/addSubject.php" method="POST">
           <div class="form-group">
              <label for="stud_id">Student ID:</label>
              <input type="number" lang="en" class="form-control" placeholder="Assign ID" name="stud_id" value="<?=$id?>" required>
            </div>

            <div class="form-group">
              <label for="code">Subject Code:</label>
              <input type="text" class="form-control" placeholder="Assign ID" name="code" required>
            </div>
            <div class="form-group">
              <label for="title">Description:</label>
              <input type="text" class="form-control" placeholder="Description" name="title" required>
            </div>
            <div class="form-group">
              <label for="units">No of Units:</label>
              <input type="text" class="form-control" placeholder="units" name="units" required>
            </div>
            <div class="form-group">
              <label for="grade">Grade:</label>
              <input type="number" step="0.01" class="form-control" placeholder="Grade" name="grade">
            </div>
            <div class="form-group">
              <label for="teacher">Teacher:</label>
              <input type="text" class="form-control" placeholder="Instructor" name="teacher" required>
            </div>
            <div class="form-group">
              <label for="Year-sem">Year:</label>
              <input type="text" class="form-control" placeholder="Year" name="year" required>
            </div>
            <div class="form-group">
              <label for="sem">Semester:</label>
              <input type="text" class="form-control" placeholder="sem" name="sem" required>
            </div>
            <div class="form-group">
              <label for="status">Status:</label>
                <select type="text" class="form-control" placeholder="ex. on-going or taken" name="status" required>
                    <option>On-going</option>
                    <option>Taken</option>
                </select>
            </div>
            <div class="form-group">
              <label for="remarks">Remarks:</label>
                <input type="text" class="form-control" placeholder="remarks" name="remarks" >
                    
            </div>
                
                <input type="submit" class="btn btn-info btn-block" name="addSubject" value="Add Subject">
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- Update Modal -->
<div class="modal fade" id="myModalUpdate">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-info">
        <h4 class="modal-title text-light text-center">Update Subject</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="../functions/editsub.php" method="POST">
            
            <div class="form-group">
              <label for="stud_id">Registration ID:</label>
              <input type="number" lang="en" class="form-control" placeholder="registration ID" name="id" required>
            </div>
            <div class="form-group">
              <label for="code">Subject Code:</label>
              <input type="text" class="form-control" placeholder="Subject Code" name="code" required>
            </div>
            <div class="form-group">
              <label for="title">Description:</label>
              <input type="text" class="form-control" placeholder="Description" name="title" required>
            </div>
            <div class="form-group">
              <label for="units">No of Units:</label>
              <input type="text" class="form-control" placeholder="Description" name="units" required>
            </div>
            <div class="form-group">
              <label for="grade">Grade:</label>
              <input type="number" step="0.25" class="form-control" placeholder="Grade" name="grade">
            </div>
            <div class="form-group">
              <label for="teacher">Teacher:</label>
              <input type="text" class="form-control" placeholder="Instructor" name="teacher" required>
            </div>
            <div class="form-group">
              <label for="Year-sem">Year:</label>
              <input type="text" class="form-control" placeholder="Year" name="year" required>
            </div>
             <div class="form-group">
              <label for="sem">Semester:</label>
              <input type="text" class="form-control" placeholder="Semester" name="sem" required>
            </div>
            <div class="form-group">
              <label for="status">Status:</label>
                <select type="text" class="form-control" placeholder="ex. on-going or taken" name="status" required>
                    <option>On-going</option>
                    <option>Taken</option>
                </select>
            </div>
            <div class="form-group">
              <label for="remarks">Remarks:</label>
                <input type="text" class="form-control" placeholder="remarks" name="remarks" >
                   
            </div>
                
                <input type="submit" class="btn btn-success btn-block" name="updateSubject" value="Update Subject">
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


</div>


<?php 
include '../Includes/details_footer.php';
 ?>