<?php
include_once "include/header.php";
if(!isset($_SESSION["userObj"])){
    header("Location: signin");
}
$studentsList = $data["students"];
?>

<div class="col-md-12 position-relative">
  <div style="right: 12.5%;" class="position-absolute bottom-bar">
      <a href="add_or_edit_student" class="btn btn-primary"><i class="ion-android-add-circle"></i> Add Student</a>
  </div>
  <div style="left: -20px;" class="position-absolute">
    <a href="homepage" style="text-decoration: none" class="text-light btn-lg"><i class="ion-android-arrow-dropleft-circle"></i> Back To Home</a>
  </div>
  <?php if(isset($_SESSION["infoMessage"])) {?>
    <div style="left: 12.5%;" class="position-absolute">
        <p class="alert alert-success alert-primary"><i class="ion-checkmark-circled"></i> <?= $_SESSION["infoMessage"] ?></p>
    </div>
    <?php $_SESSION["infoMessage"]=null;
    } if(isset($_SESSION["errorMessage"])) { ?>
      <div style="left: 12.5%;" class="position-absolute">
          <p class="alert alert-success alert-danger"><i class="ion-close-circled"></i> <?= $_SESSION["errorMessage"] ?></p>
      </div>
    <?php $_SESSION["errorMessage"]=null;
    } ?>
</div>
<table class="table table-hover mx-auto w-75 bg-white rounded mt-5">
  <thead>
    <tr>
      <th scope="col">Student ID</th>
      <th scope="col">Student Name</th>
      <th scope="col">Age</th>
      <th scope="col">gender</th>
      <th scope="col">Mother Name</th>
      <th scope="col">School</th>
      <th scope="col">Country State</th>
      <th scope="col">Sitting #</th>
      <th scope="col">SSN #</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($studentsList as $student) {
      $sname = explode(" ", $student->std_name);
      $mname = explode(" ", $student->mother_name);
      ?>
    <tr>
      <th scope="row"><?=$student->std_id?></th>
      <td><?="{$sname[0]} {$sname[1]}"?></td>
      <td><?=$student->age?></td>
      <td><?=$student->gender?></td>
      <td><?="{$mname[0]} {$mname[1]}"?></td>
      <td><?=$student->std_school?></td>
      <td><?=$student->std_state?></td>
      <td><?=$student->sitting_num?></td>
      <td><?=$student->ssn_num?></td>
      <td><a href="edit_student?std_id=<?=$student->std_id?>" class="btn btn-primary btn-sm"><i class="ion-edit"></i></a></td>
      <td><a href="delete_student?std_id=<?=$student->std_id?>" class="btn btn-danger btn-sm"><i class="ion-android-delete"></i></a></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<?php include_once "include/footer.php" ?>