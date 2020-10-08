<!DOCTYPE html>
<?php
session_start();
$con = mysqli_connect('localhost', 'root', '');
if (!$con) {
    die("Unabe to connect <br>" . mysqli_error($con));
}
mysqli_select_db($con, 'task2');

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $nationalID = $_POST['nationalID'];
    $phone = $_POST['phone'];

    $username = $_POST['username'];
    $password1 = $_POST['password'];
    $password2 = $_POST['confirm'];

    $image = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    $address = $_POST['address'];
    $role = "personnel";
    if ($password1 == $password2) {
        $query = "insert into users(first_name,last_name,national_id,gender,phone_number,username,password,address,image,role) values('$fname','$lname','$nationalID','$gender','$phone','$username','$password1','$address','$image','$role')";

        if (!mysqli_query($con, $query)) {
            die('error creating account: ' . mysqli_error($con));
        } else {
            header("location: personnel_index.php");
        }
    }
}

?>
<head>
    <title>ثبت عضو</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/forms.css">
    <script type="text/javascript" language="javascript" src="../../js/validation.js"></script>


</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <div class="navbar-header">
        <a class="navbar-brand" href="#">سامانه کتابخانه</a>
    </div>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="../../home.php">خانه<span class="sr-only"></span></a>
            </li>

            <?php if ($_SESSION['role'] == "manager") { ?>
                <li class="nav-item">
                    <a class="nav-link" href="../members/member_index.php">مدیریت اعضا<span class="sr-only"></span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="personnel_index.php">مدیریت کارکنان<span
                            class="sr-only"></span></a>
                </li>
            <?php } ?>

            <?php if ($_SESSION['role'] == "manager" or $_SESSION['role'] == "personnel") { ?>
                <li class="nav-item">
                    <a class="nav-link" href="../books/book_index.php">بانک کتاب ها<span class="sr-only"></span></a>
                </li>
            <?php } ?>

            <div style="float:left;">
                <?php if ($_SESSION['login'] == 1) { ?>
                    <li class="nav-item" style="float: left;">
                        <a class="nav-link" href="../../login.php">خروج<span class="sr-only"></span></a>
                    </li>
                <?php } ?>
            </div>

        </ul>


        <!--        <div style="float: left">-->
        <!--            <ul class="nav navbar-nav">-->
        <!--                --><?php //if ($_SESSION['login'] == 0) { ?>
        <!--                    <li class="nav-item" style="float: left">-->
        <!--                        <a class="nav-link" href="books.php">Login<span class="sr-only"></span></a>-->
        <!--                    </li>-->
        <!--                --><?php //} else { ?>
        <!--                    <li class="nav-item" style="float: left">-->
        <!--                        <a class="nav-link" href="login.php">Logout<span class="sr-only"></span></a>-->
        <!--                    </li>-->
        <!--                --><?php //} ?>
        <!--            </ul>-->
        <!--        </div>-->

    </div>
</nav>


<div class="container my-5">
    <form action="personnel_create.php" method="post" enctype="multipart/form-data">

        <div class="card">

            <div class="card-header">
                <p>ثبت کتابدار جدید</p>
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-lg-6">

                        <div class="form-group">
                            <label for="fname">نام:</label>
                            <input type="text" name="fname" id="fname" class="form-control" placeholder="طراوت">
                            <p id="fname_error_message" style="color: red"></p>
                        </div>

                        <div class="form-group">
                            <label for="lname">نام خانوادگی:</label>
                            <input type="text" name="lname" id="lname" class="form-control" placeholder="پارت">
                            <p id="lname_error_message" style="color: red"></p>
                        </div>

                        <div class="form-group">
                            <label for="nationalID">کد ملی:</label>
                            <input type="number" name="nationalID" id="nationalID" class="form-control" placeholder="0123456789">
                            <p id="nationalID_error_message" style="color: red"></p>
                        </div>

                        <div class="form-group">
                            <label for="phone">شماره تماس:</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="09xx-xxx-xxxx">
                            <p id="phone_error_message" style="color: red"></p>
                        </div>

                        <fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-2 pt-0">جنسیت:</legend>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="female">
                                            زن
                                        </label>
                                        <input class="form-check-input" type="radio" name="gender" id="female"
                                               value="female" checked>

                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="male">
                                            مرد
                                        </label>
                                        <input class="form-check-input" type="radio" name="gender" id="male"
                                               value="male">

                                    </div>
                                </div>
                            </div>
                        </fieldset>

                    </div>

                    <div class="col-lg-6">

                        <div class="form-group">
                            <label for="username">نام کاربری:</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="نام کاربری">
                            <p id="username_error_message" style="color: red"></p>
                        </div>

                        <div class="form-group">
                            <label for="password">رمز عبور:</label>
                            <input type="password" name="password" id="password" class="form-control">
                            <p id="password_error_message" style="color: red"></p>
                        </div>

                        <div class="form-group">
                            <label for="confirm">تایید رمز عبور:</label>
                            <input type="password" name="confirm" id="confirm" class="form-control">
                            <p id="confirm_error_message" style="color: red"></p>
                        </div>

                        <div class="mt-5">
                            <label for="image" class="custom-file-upload">انتخاب عکس</label>
                            <input type="file" class="form-control file-upload" name="image" id="image">
                            <p id="image_error_message" style="color: red"></p>
                        </div>

                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <textarea class="form-control" rows="6" name="address" autocomplete="off"
                                  placeholder="آدرس را وارد کنید."></textarea>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="w-25 p-2 bg-success btn" name="submit">ثبت</button>
            </div>
        </div>
    </form>

</div>



</body>
</html>