<?php
include_once "include/header.php";
if(!isset($_SESSION["userObj"])){
    header("Location: signin");
}
$subjectList = $data["subjects"];
?>

<div class="col-md-12 position-relative">
  <div style="right: 12.5%;" class="position-absolute bottom-bar">
      <a href="add_or_edit_subject" class="btn btn-primary"><i class="ion-android-add-circle"></i> Add Subject</a>
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
      <th scope="col">Subject ID</th>
      <th scope="col">Subject Name</th>
      <th scope="col">Full Mark</th>
      <th scope="col">Examination Date</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($subjectList as $subject) { ?>
    <tr>
      <th scope="row"><?=$subject->sub_id?></th>
      <td><?=$subject->sub_name?></td>
      <td><?=$subject->full_deg?></td>
      <td><?=$subject->exDate?></td>
      <td><a href="edit_subject?sub_id=<?=$subject->sub_id?>" class="btn btn-primary btn-sm"><i class="ion-edit"></i></a></td>
      <td><a href="delete_subject?sub_id=<?=$subject->sub_id?>" class="btn btn-danger btn-sm"><i class="ion-android-delete"></i></a></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<?php include_once "include/footer.php" ?>