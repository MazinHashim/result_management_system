<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\Result_Management_SYS/mvc/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="\Result_Management_SYS/mvc/public/css/ionicons.css">
    <link rel="stylesheet" href="\Result_Management_SYS/mvc/public/css/style.css">
    <title>Result Management System</title>
</head>
<body>
    <div class="bg-img">
        <div class="container-fluid p-5 text-capitalize text-center">
            <div class="row">
                <?php if(isset($_SESSION["userObj"])){?>
                    <a href="\Result_Management_SYS/mvc/public/home/signout" class="btn btn-primary sign-out"><i class="ion-log-out"></i></a>
                <?php } ?>