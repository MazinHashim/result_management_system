<?php
include_once "include/header.php";
if(!isset($_SESSION["userObj"])){
    header("Location: signin");
}
$opText = "ADD";
$btn_submit_name = "add_sub_btn";
$subject = null;
if(isset($data["subject"])){
  $opText = "EDIT";
  $btn_submit_name = "edit_sub_btn";
  $subject = $data["subject"];
}
?>
<div style="margin-bottom: 75px" class="col-md-12 text-dark text-left app-title">
  <h1><i class="ion-ios-book"></i> <?=$opText?> Subject</h1>
</div>
<div style="right: 50px;" class="position-absolute">
  <a href="subjects" style="text-decoration: none" class="text-light btn-lg">Back To Subjects <i class="ion-android-arrow-dropright-circle"></i></a>
</div>
<form class="col-md-8 m-auto" method="POST" action="add_or_edit_subject">
  <?php if($opText === "EDIT"){ ?>
    <input hidden value="<?=$subject?$subject->sub_id:''?>" name="sub_id">
  <?php } ?>
  <div class="form-group row justify-content-between">
    <label for="sub_name" class="text-white text-left col-sm-3 col-form-label">Subject Name</label>
    <div class="col-sm-9">
      <input required type="text" class="form-control" value="<?=$subject?$subject->sub_name:''?>" name="sub_name" id="sub_name" placeholder="Enter Subject Name">
    </div>
  </div>
  <div class="form-group row">
    <label for="full_mark" class="text-white text-left col-sm-3 col-form-label">Full Mark</label>
    <div class="col-sm-9">
      <input required type="text" class="form-control" value="<?=$subject?$subject->full_deg:''?>" name="full_mark" id="full_mark" placeholder="Enter Full Mark">
    </div>
  </div>
  <div class="form-group row">
    <label for="exam_date" class="text-white text-left col-sm-3 col-form-label">Examination Date</label>
    <div class="col-sm-9">
      <input required type="text" class="form-control" value="<?=$subject?$subject->exDate:''?>" name="exam_date" id="exam_date" placeholder="Enter Examination Date">
    </div>
  </div>
  <div class="form-group row justify-content-end">
    <div class="col-sm-9">
      <button type="submit" name="<?=$btn_submit_name?>" class="btn btn-block btn-primary"><?=$opText?></button>
    </div>
  </div>
</form>
<?php include_once "include/footer.php" ?>