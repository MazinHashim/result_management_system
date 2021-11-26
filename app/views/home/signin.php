<?php

include_once "include/header.php";
if(isset($_SESSION["userObj"])){
    header("Location: homepage");
}
?>

            <div style="margin-bottom: 100px" class="col-md-12">
                <h1 class="text-white m-auto">Sign In To 
                    <span style="color: rgba(255, 255, 255, 0.5);">Student</span>
                    Result
                    <span class="text-primary">Platform</span>
                </h1>
            </div>
            <?php if(isset($data["ErrMsg"])){ ?>
            <div class="col-md-6 offset-3">
                <div class="alert alert-danger" role="alert">
                <?=$data["ErrMsg"]?>
                </div>
            </div>
            <?php } ?>
            <div class="col-md-12">
            <?= isset($_COOKIE["cookMessage"]) ? "<p class=\"text-left text-white m-auto col-md-5\">Last Sign In From This Device Was :<br /><mark class=\"w-75 rounded text-primary\">{$_COOKIE['cookMessage']}</mark></p>" : ""; ?>
                <form method="POST" action="\Result_Management_SYS/mvc/public/home/homepage" class="offset-3 col-md-5 m-auto">
                    <div class="form-group">
                        <input required type="text" class="my-5 form-control" name="username" id="username" aria-describedby="username" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <input required type="password" class="my-5 form-control" name="password" id="password" placeholder="Enter Password">
                    </div>
                    
                    <button type="submit" name="sign-submit" class="my-4 btn btn-primary btn-lg btn-block"><i class="ion-log-in"></i> Sign In</button>
                </form>
            </div>
<?php include_once "include/footer.php" ?>