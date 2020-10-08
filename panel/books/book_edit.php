<!DOCTYPE html>
<?php
session_start();
$con = mysqli_connect('localhost', 'root', '');
if (!$con) {
    die("Unabe to connect <br>" . mysqli_error($con));
}
mysqli_select_db($con, 'task2');

$id = $_REQUEST['id'];
$query = "select * from books where id=$id";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

if (isset($_POST['submit'])) {

    $code = $_POST['code'];
    $name = $_POST['name'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $publisher = $_POST['publisher'];
    $year = $_POST['year'];
    $genre = $_POST['category'];
//    $image = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    $coverType = $_POST['coverType'];
    $numberOfPages = $_POST['numberOfPages'];
    $paperType = $_POST['paperType'];
    $textColor = $_POST['textColor'];
    $description = $_POST['description'];

    $query="update books set name='$name', price='$price', code='$code', genre='$genre',author='$author',publicationDate='$year',publisher='$publisher',coverType='$coverType',numberOfPages='$numberOfPages',paperType='$paperType',textColor='$textColor',description='$description' where id=$id ";

    if (!mysqli_query($con, $query)) {
        die('error updating book: ' . mysqli_error($con));
    } else {
        header("location: book_index.php");
    }
}

?>
<head>
    <title>ویرایش اطلاعات کتاب</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/forms.css">
    <script type="text/javascript" language="javascript" src="../../js/validation_book_forms.js"></script>


</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div style="direction: rtl">
            <ul class="navbar-nav mr-auto" style="direction: rtl">
                <?php if ($_SESSION['login'] == 0) { ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="books.php">Login<span class="sr-only"></span></a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="books.php">Logout<span class="sr-only"></span></a>
                    </li>
                <?php } ?>

                <li class="nav-item active">
                    <a class="nav-link" href="books.php">خانه<span class="sr-only"></span></a>
                </li>

                <?php if ($_SESSION['role'] == "manager") { ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="../members/member_index.php">مدیریت اعضا<span class="sr-only"></span></a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="../personnels/personnel_index.php">مدیریت کارکنان<span
                                    class="sr-only"></span></a>
                    </li>
                <?php } ?>

                <?php if ($_SESSION['role'] == "manager" or $_SESSION['role'] == "personnel") { ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="book_index.php">بانک کتاب ها<span class="sr-only"></span></a>
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
        </div>


    </div>
</nav>


<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-12 ">
            <form action="book_edit.php" method="post" enctype="multipart/form-data" class="m-0 p-0" id="form_book">
                <div class="card">
                    <div class="card-header text-center">
                        مشخصات اثر
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-6">

                                <input name="id" type="hidden" value="<?php echo $row['id'];?>" />

                                <div class="form-group">
                                    <label for="code">کد کتاب:</label>
                                    <input type="number" name="code" id="code" class="form-control" value="<?php echo $row['code']?>">
                                    <p id="code_error_message" style="color: red"></p>
                                </div>

                                <div class="form-group">
                                    <label for="name">نام کتاب:</label>
                                    <input type="text" name="name" id="name" class="form-control" value="<?php echo $row['name']?>">
                                    <p id="name_error_message" style="color: red"></p>

                                </div>

                                <div class="form-group">
                                    <label for="author">نام نویسنده:</label>
                                    <input type="text" name="author" id="author" class="form-control" value="<?php echo $row['author']?>">
                                    <p id="author_error_message" style="color: red"></p>
                                </div>

                                <div class="form-group">
                                    <label for="price">قیمت:</label>
                                    <input type="number" name="price" id="price" class="form-control" value="<?php echo $row['price']?>">
                                    <p id="price_error_message" style="color: red"></p>
                                </div>

                            </div>

                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label for="publisher">ناشر:</label>
                                    <input type="text" name="publisher" id="publisher" class="form-control" value="<?php echo $row['publisher']?>">
                                    <p id="publisher_error_message" style="color: red"></p>

                                </div>

                                <div class="form-group">
                                    <label for="year">سال چاپ:</label>
                                    <input type="number" name="year" id="year" class="form-control" value="<?php echo $row['publicationDate']?>">
                                    <p id="year_error_message" style="color: red"></p>
                                </div>

                                <label for="category">ژانر:</label>
                                <select class="form-control" id="category" name="category">
                                    <option <?php if($row['genre']=="رمان"){ echo "selected";}?>>
                                        رمان
                                    </option>
                                    <option <?php if($row['genre']=="علمی تخیلی"){ echo "selected";}?>>
                                        علمی تخیلی
                                    </option>
                                    <option <?php if($row['genre']=="ترسناک"){ echo "selected";}?>>
                                        ترسناک
                                    </option>
                                    <option  <?php if($row['genre']=="زندگی نامه"){ echo "selected";}?>>
                                        زندگی نامه
                                    </option>
                                    <option <?php if($row['genre']=="انگیزشی"){ echo "selected";}?>>
                                        انگیزشی
                                    </option>
                                </select>

                                <div class="mt-5">
                                    <label for="image" class="custom-file-upload">انتخاب عکس</label>
                                    <input type="file" class="form-control file-upload" name="image" id="image">
                                    <p id="image_error_message" style="color: red"></p>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="card">

                    <div class="card-header text-center">
                        مشخصات فیزیکی
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="coverType">نوع جلد:</label>
                                    <input type="text" name="coverType" id="coverType" class="form-control" value="<?php echo $row['coverType']?>">
                                    <p id="coverType_error_message" style="color: red"></p>
                                </div>

                                <div class="form-group">
                                    <label for="numberOfPages">تعداد صفحات:</label>
                                    <input type="number" name="numberOfPages" id="numberOfPages" class="form-control" value="<?php echo $row['numberOfPages']?>">
                                    <p id="numberOfPages_error_message" style="color: red"></p>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="paperType">نوع کاغذ صفحات:</label>
                                    <input type="text" name="paperType" id="paperType" class="form-control" value="<?php echo $row['paperType']?>">
                                    <p id="paperType_error_message" style="color: red"></p>
                                </div>

                                <div class="form-group">
                                    <label for="textColor">رنگ متن:</label>
                                    <input type="text" name="textColor" id="textColor" class="form-control" value="<?php echo $row['textColor']?>">
                                    <p id="textColor_error_message" style="color: red"></p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="card">

                    <div class="card-header text-center">
                        خلاصه کتاب
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-12">
                                <textarea class="form-control" rows="6" name="description" autocomplete="off"
                                          placeholder="خلاصه ای از کتاب را وارد کنید..."><?php echo $row['description']?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="w-25 p-2 bg-success btn" name="submit">ویرایش</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>


</body>
</html>