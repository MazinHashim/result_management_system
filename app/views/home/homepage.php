<?php include_once "include/header.php" ?>
<?php
// $fem_s_percent = round($data["fem_s_percent"],2);
// $fem_f_percent = round($data["fem_f_percent"],2);
// $male_s_percent = round($data["male_s_percent"],2);
// $male_f_percent = round($data["male_f_percent"],2);
?>
    <?php if(isset($_SESSION["infoMessage"])) {?>
    <div style="left: 34%; top:10px" class="position-absolute">
        <p class="alert alert-success alert-primary"><i class="ion-checkmark-circled"></i> <?= $_SESSION["infoMessage"] ?></p>
    </div>
    <?php $_SESSION["infoMessage"]=null;
    } if(isset($_SESSION["errorMessage"])) { ?>
      <div style="left: 34%; top:10px" class="position-absolute">
          <p class="alert alert-success alert-danger"><i class="ion-close-circled"></i> <?= $_SESSION["errorMessage"] ?></p>
      </div>
    <?php $_SESSION["errorMessage"]=null;
    } ?>
    <a href="check_all_res" class="btn btn-primary verf_res"><i class="ion-checkmark-circled"></i> Verify Result</a>
                <div class="text-left col-md-4">
                    <h1 class="text-white text-center">
                        <img src="\Result_Management_SYS/mvc/public/img/logo.png" alt="Ministry Logo" width=300 height=250>
                    </h1>
                </div>
                <div class="reports col-md-8 row justify-content-between">
                    <form style="width: 100%" action="change_date" method="POST">
                        <div class="input-group my-3">
                            <input required type="date" class="form-control " name="conf_date" placeholder="Conference Date">
                            <input required type="time" class="form-control " name="conf_time" placeholder="Conference Time">
                            <div class="input-group-append">
                                <input class="btn btn btn-primary" name="chg_conf_date" type="submit" id="chg_conf_date" value="Change Conference Date" />
                            </div>
                        </div>
                    </form>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Percentage Of Success</h5>
                                <p style="font-size: 20px" class="card-text">
                                    <i class="ion-ios-person text-dark text-left">  Male : <?=$male_s_percent??50?>%</i>
                                </p>
                                <p style="font-size: 20px" class="card-text">
                                    <i class="ion-ios-person text-dark text-left">  Female : <?=$fem_s_percent??50?>%</i>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Percentage Of Fails</h5>
                                <p style="font-size: 20px" class="card-text">
                                    <i class="ion-ios-person text-dark text-left">  Male : <?=$male_f_percent??50?>%</i>
                                </p>
                                <p style="font-size: 20px" class="card-text">
                                    <i class="ion-ios-person text-dark text-left">  Female : <?=$fem_f_percent??50?>%</i>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-left col-md-4">
                    <h1 class="text-white">Welcome <?=$_SESSION["userObj"]["username"]?> To 
                        <span style="color: rgba(255, 255, 255, 0.5);">Student</span>
                        Result
                        <span class="text-primary">Management System</span>
                    </h1>
                </div>
                <div class="reports col-md-8 row justify-content-between">
                    <div class="col-sm-4">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Number Of Student</h5>
                            <p style="font-size: 20px" class="card-text">
                                <i class="ion-ios-person text-dark text-left">  Male : 50%</i>
                            </p>
                            <p style="font-size: 20px" class="card-text">
                                <i class="ion-ios-person text-dark text-left">  Female : 50%</i>
                            </p>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Perfect Three Students</h5>
                            <p style="font-size: 12px" class="card-text text-left">
                                <i class="text-success">1/ Mazin Hashim Ahmed: 97.5%</i>
                            </p>
                            <p style="font-size: 12px" class="card-text text-left">
                                <i class="text-dark">2/ Ameen Tahah Ahmed: 97.4%</i>
                            </p>
                            <p style="font-size: 12px" class="card-text text-left">
                                <i class="text-dark">3/ Manal Algofary Ibrahim: 97.0%</i>
                            </p>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="bottom-bar row w-100 m-auto justify-content-between">
                    <div class="col-sm-3">
                        <a href="\Result_Management_SYS/mvc/public/home/subjects" class="btn btn-lg btn-primary btn-block"><i class="ion-ios-book"></i> Manage Subjects</a>
                    </div>
                    <div class="col-sm-3">
                        <a href="\Result_Management_SYS/mvc/public/home/students" class="btn btn-lg btn-primary btn-block"><i class="ion-ios-contact"></i> Manage Students</a>
                    </div>
                    <div class="col-sm-3">
                        <a href="\Result_Management_SYS/mvc/public/home/results" class="btn btn-lg btn-primary btn-block"><i class="ion-ios-list"></i> Manage Student Degrees</a>
                    </div>
                </div>
<?php include_once "include/footer.php" ?>