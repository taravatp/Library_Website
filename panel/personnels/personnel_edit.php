<!DOCTYPE html>
<?php
session_start();
$con = mysqli_connect('localhost', 'root', '');
if (!$con) {
    die("Unabe to connect <br>" . mysqli_error($con));
}
mysqli_select_db($con, 'task2');

$id = $_REQUEST['id'];
$query = "select * from users where id=$id";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

if (isset($_POST['edit_pass'])) {

    $correct_password = "select password from users where id=$id";
    $password = $_POST['current_pass'];
    $new_password = $_POST['new_pass'];
    $confirm_password = $_POST['confirm'];


    if ($new_password == $confirm_password and $correct_password = $password) {
        $query = "update users set password='$new_password' where id=$id ";
        if (mysqli_query($con, $query)) {
            header('location: personnel_index.php');
        } else {
            echo mysqli_error($con);
        }
    }

}

if (isset($_POST['edit_info'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $nationalID = $_POST['nationalID'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];

//    $image = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    //image meghdare gahbili ra hefz nemikonad:/

    $address = $_POST['address'];
    if ($_POST['role'] == "مدیر") {
        $role = "manager";
    } elseif ($_POST['role'] == "کارمند") {
        $role = "personnel";
    } else {
        $role = "member";
    }

    $query = "update users set first_name='$fname', last_name='$lname', gender='$gender', national_id='$nationalID',phone_number='$phone',username='$username',role='$role' where id=$id ";
    if (mysqli_query($con, $query)) {
        header('location: personnel_index.php');
    } else {
        echo mysqli_error($con);
    }

}

?>
<head>
    <title>ویرایش اطلاعات</title>

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
    <div class="row">
        <div class="col-lg-8">
            <form action="personnel_edit.php" method="post" enctype="multipart/form-data" id="form_edit">

                <div class="card">

                    <div class="card-header">
                        <p>ویرایش اطلاعات</p>
                    </div>

                    <div class="card-body">

                        <input name="id" type="hidden" value="<?php echo $row['id']; ?>"/>

                        <div class="form-group">
                            <label for="fname">نام:</label>
                            <input type="text" name="fname" id="fname" class="form-control"
                                   value="<?php echo $row['first_name']; ?>">
                            <p id="fname_error_message" style="color: red"></p>

                        </div>

                        <div class="form-group">
                            <label for="lname">نام خانوادگی:</label>
                            <input type="text" name="lname" id="lname" class="form-control"
                                   value="<?php echo $row['last_name']; ?>">
                            <p id="lname_error_message" style="color: red"></p>
                        </div>


                        <div class="form-group">
                            <label for="nationalID">کد ملی:</label>
                            <input type="number" name="nationalID"  id="nationalID" class="form-control"
                                   value="<?php echo $row['national_id']; ?>">
                            <p id="nationalID_error_message" style="color: red"></p>

                        </div>

                        <div class="form-group">
                            <label for="phone">شماره تماس:</label>
                            <input type="text" name="phone" id="phone" class="form-control"
                                   value="<?php echo $row['phone_number']; ?>">
                            <p id="phone_error_message" style="color: red"></p>

                        </div>

                        <div class="row selects">
                            <div class="col-lg-6">
                                <label for="gender">جنسیت:</label>
                                <select class="form-control" id="gender" value="<?php echo $row['gender']; ?>"
                                        name="gender">
                                    <option <?php if ($row['role'] == "female") {
                                        echo "selected";
                                    } ?>>
                                        زن
                                    </option>
                                    <option <?php if ($row['role'] == "male") {
                                        echo "selected";
                                    } ?>>
                                        مرد
                                    </option>
                                </select>
                            </div>

                            <div class="col-lg-6">
                                <label for="role">نقش:</label>
                                <select class="form-control" id="role" value="<?php echo $row['role']; ?>" name="role">
                                    <option <?php if ($row['role'] == "manager") {
                                        echo "selected";
                                    } ?>>
                                        مدیر
                                    </option>
                                    <option <?php if ($row['role'] == "personnel") {
                                        echo "selected";
                                    } ?>>
                                        کارمند
                                    </option>
                                    <option <?php if ($row['role'] == "member") {
                                        echo "selected";
                                    } ?>>
                                        کاربر
                                    </option>
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="username">نام کاربری:</label>
                            <input type="text" name="username" id="username" class="form-control"
                                   value="<?php echo $row['username']; ?>">
                            <p id="username_error_message" style="color: red"></p>
                        </div>

                        <div class="mt-2">
                            <label for="image" class="custom-file-upload">انتخاب عکس</label>
                            <input type="file" class="form-control file-upload" name="image" id="image"">
                            <p id="image_error_message" style="color: red"></p>
                        </div>

                        <textarea class="form-control" rows="6" name="address"
                                  autocomplete="off"><?php echo $row['address'] ?></textarea>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="w-25 p-2 bg-success btn" name="edit_info">
                            ویرایش
                        </button>
                    </div>
                </div>
            </form>


        </div>

        <div class="col-lg-4">
            <form action="personnel_edit.php" method="post" enctype="multipart/form-data" id="form_change_password">
                <div class="card">

                    <div class="card-header">
                        <p>ویرایش رمز عبور</p>
                    </div>

                    <div class="card-body">
                        <input name="id" type="hidden" value="<?php echo $row['id']; ?>"/>
                        <div class="form-group">
                            <label for="current_pass">رمز عبور:</label>
                            <input type="password" name="current_pass"  id="current_password" class="form-control">
                            <p id="current_password_error_message" style="color: red"></p>

                        </div>
                        <div class="form-group">
                            <label for="new_password">رمز عبور جدید:</label>
                            <input type="password" name="new_pass" id="new_password" class="form-control">
                            <p id="new_password_error_message" style="color: red"></p>
                        </div>

                        <div class="form-group">
                            <label for="confirm_new_password">تایید رمز عبور جدید:</label>
                            <input type="password" name="confirm" id="confirm_new_password" class="form-control">
                            <p id="confirm_new_password_error_message" style="color: red"></p>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="w-25 p-2 bg-success btn" name="edit_pass">
                            ویرایش
                        </button>
                    </div>

                </div>
            </form>
        </div>


    </div>


</div>

<script>
    $("#current_password_error_message").hide();
    $("#new_password_error_message").hide();
    $("#confirm_new_password_error_message").hide();

    var error_current__password=false;
    var error_new_password=false;
    var error_confirm_new_password=false;

    $("#current_password").focusout(function() {

        check_current_password();

    });

    $("#new_password").focusout(function() {

        check_new_password();

    });

    $("#confirm_new_password").focusout(function () {
        check_confirm_new_password();
    });

    function check_current_password() {
        var right=<?php echo $row['password']?>;
        var current = $("#current_password").val();
        if( right != current)
        {
            $("#current_password_error_message").html("پسورد وارد شده نادرست است.");
            $("#current_password_error_message").show();
            error_current__password = true;
        }
        else {
            $("#current_password_error_message").hide();
        }
    }

    function check_new_password() {
        var password_length = $("#new_password").val().length;

        if(password_length < 8) {
            $("#new_password_error_message").html("پسورد باید حداقل 8 کاراکتر باشد.");
            $("#new_password_error_message").show();
            error_new_password = true;
        } else {
            $("#new_password_error_message").hide();
        }
    }

    function check_confirm_new_password(){
        var password = $("#new_password").val();
        var confirm = $("#confirm_new_password").val();
        if(password !=  confirm) {
            $("#confirm_new_password_error_message").html("پسورد وارد شده مطابقت ندارد.");
            $("#confirm_new_password_error_message").show();
            error_confirm_new_password = true;
        } else {
            $("#confirm_new_password_error_message").hide();
        }
    }

    $("#form_change_password").submit(function () {

        error_current__password=false;
        error_new_password=false;
        error_confirm_new_password=false;

        check_current_password();
        check_new_password();
        check_confirm_new_password();

        if(error_current__password == false && error_new_password == false && error_confirm_new_password == false ){
            return true;
        }
        else {
            return false;
        }

    });

</script>

</body>
</html>