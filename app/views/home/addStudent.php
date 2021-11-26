<?php
include_once "include/header.php";
if(!isset($_SESSION["userObj"])){
    header("Location: signin");
}
$opText = "ADD";
$btn_submit_name = "add_std_btn";
$student = null;
if(isset($data["student"])){
  $opText = "EDIT";
  $btn_submit_name = "edit_std_btn";
  $student = $data["student"];
}
?>
<div style="margin-bottom: 75px" class="col-md-12 text-dark text-left app-title">
  <h1><i class="ion-ios-contact"></i> <?=$opText?> Student</h1>
</div>
<div style="right: 50px;" class="position-absolute">
  <a href="students" style="text-decoration: none" class="text-light btn-lg">Back To Students <i class="ion-android-arrow-dropright-circle"></i></a>
</div>
<form class="col-md-8 m-auto" method="POST" action="add_or_edit_student">
  <?php if($opText === "EDIT"){ ?>
    <input hidden value="<?=$student?$student->std_id:''?>" name="std_id">
    <?php } ?>
  <div class="form-group row justify-content-between">
    <label for="std_name" class="text-white text-left col-sm-2 col-form-label">Student Name</label>
    <div class="col-sm-10">
      <input required type="text" class="form-control" value="<?=$student?$student->std_name:''?>" name="std_name" id="std_name" placeholder="Enter Student Name">
    </div>
  </div>
  <div class="form-group row">
    <label for="age" class="text-white text-left col-sm-2 col-form-label">Age</label>
    <div class="col-sm-10">
      <input required type="text" class="form-control" value="<?=$student?$student->age:''?>" name="age" id="age" placeholder="Enter Age">
    </div>
  </div>
  <div class="form-group text-white row justify-content-between">
    <label for="age" class="text-left col-sm-2 col-form-label">Gender</label>
    <div class="col-sm-4 form-check form-check-inline">
        <input required class="form-check-input" type="radio" name="gender" id="male" <?=$student?$student->gender==="Male"?'checked':'':''?> value="Male">
        <label class="form-check-label" for="male">Male</label>
    </div>
    <div class="col-sm-5 form-check form-check-inline">
        <input required class="form-check-input" type="radio" name="gender" id="female" <?=$student?$student->gender==="Female"?'checked':'':''?> value="Female">
        <label class="form-check-label" for="female">Female</label>
    </div>
  </div>
  <div class="form-group row">
    <label for="mother_name" class="text-white text-left col-sm-2 col-form-label">Mother Name</label>
    <div class="col-sm-10">
      <input required type="text" class="form-control" value="<?=$student?$student->mother_name:''?>" name="mother_name" id="mother_name" placeholder="Enter Mother Name">
    </div>
  </div>
  <div class="form-group row">
    <label for="std_school" class="text-white text-left col-sm-2 col-form-label">Student School</label>
    <div class="col-sm-10">
      <input required type="text" class="form-control" value="<?=$student?$student->std_school:''?>" name="std_school" id="std_school" placeholder="Enter School">
    </div>
  </div>
  <div class="form-group row">
    <label for="std_state" class="text-white text-left col-sm-2 col-form-label">Country State</label>
    <div class="col-sm-10">
      <input required type="text" class="form-control" value="<?=$student?$student->std_state:''?>" name="std_state" id="std_state" placeholder="Enter State">
    </div>
  </div>
  <div class="form-group row">
    <label for="sitting_num" class="text-white text-left col-sm-2 col-form-label">Sitting Number</label>
    <div class="col-sm-10">
      <input required type="text" class="form-control" value="<?=$student?$student->sitting_num:''?>" name="sitting_num" id="sitting_num" placeholder="Enter Sitting Number">
    </div>
  </div>
  <div class="form-group row">
    <label for="ssn_num" class="text-white text-left col-sm-2 col-form-label">SSN Number</label>
    <div class="col-sm-10">
      <input required type="text" class="form-control" value="<?=$student?$student->ssn_num:''?>" name="ssn_num" id="ssn_num" placeholder="Enter SSN Number">
    </div>
  </div>
  <div class="form-group row justify-content-end">
    <div class="col-sm-10">
      <button required type="submit" name="<?=$btn_submit_name?>" class="btn btn-block btn-primary"><?=$opText?></button>
    </div>
  </div>
</form>
<?php include_once "include/footer.php" ?>