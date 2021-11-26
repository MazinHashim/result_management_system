<?php
include_once "include/header.php";
if(!isset($_SESSION["userObj"])){
    header("Location: signin");
}
$studentList = $data["students"];
$subjectList = $data["subjects"];
$opText = "ADD";
$btn_submit_name = "add_deg_btn";
$subject = null;
if(isset($data["degree"])){
  $opText = "EDIT";
  $btn_submit_name = "edit_deg_btn";
  $degree = $data["degree"];
}
?>
<div style="margin-bottom: 75px" class="col-md-12 text-dark text-left app-title">
  <h1><i class="ion-ios-book"></i> <?=$opText?> Degree</h1>
</div>
<div style="right: 50px;" class="position-absolute">
  <a href="results" style="text-decoration: none" class="text-light btn-lg">Back To Degrees <i class="ion-android-arrow-dropright-circle"></i></a>
</div>
<form class="col-md-8 m-auto" method="POST" action="add_or_edit_degree">
  <?php if($opText === "EDIT"){ ?>
    <input required hidden value="<?=$degree?$degree->exam_id:''?>" name="exam_id">
  <?php } ?>
  <div class="form-group row justify-content-between">
    <div class="col">
      <select required name="std_id" class="form-control">
        <option value="0" disabled selected>Select Student</option>
        <?php foreach($studentList as $student){
          // if(isset($degree)){
            if($student->std_name === $degree->std_name){?>
              <option value="<?=$student->std_id?>" selected><?=$degree->std_name?></option>
            <?php } else { ?>
              <option value="<?=$student->std_id?>"><?=$student->std_name?></option>
            <?php }
          // }?>          
        <?php } ?>
      </select>
      <!-- الداتا لست ما بتنفع -->
    </div>
    <div class="col">
    <select required name="sub_id" class="form-control">
        <option value="0" disabled selected>Select Subject</option>
        <?php foreach($subjectList as $subject){
          // if(isset($degree)){
            if($subject->sub_name === $degree->sub_name){?>
            <!-- There Is Some Problem Here -->
              <option value="<?=$subject->sub_id?>" selected><?=$degree->sub_name?></option>
            <?php } else { ?>
              <option value="<?=$subject->sub_id?>"><?=$subject->sub_name?></option>
            <?php }
          // }?>
        <?php } ?>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <div class="col">
      <input required max="100" type="number" name="exam_deg" value="<?=$degree?$degree->exam_degree:''?>" class="form-control" placeholder="Enter Degree">
    </div>
  </div>
  <div class="form-group row justify-content-end">
    <div class="col-sm-12">
      <button type="submit" name="<?=$btn_submit_name?>" class="btn btn-block btn-primary"><?=$opText?></button>
    </div>
  </div>
</form>
<?php include_once "include/footer.php" ?>