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
?>
<head>

    <title><?php echo $row['name'] ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/forms.css">

    <style>
        h5 {
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 8px;
        }
        img {
            box-shadow: 0 0 15px 0 rgba(0, 0, 0, .5)
        }
        .back_btn {
            float: left;
            border-radius: 5px;
        }
    </style>

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
                    <a class="nav-link" href="../personnels/personnel_index.php">مدیریت  کارکنان<span
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
    <div class="row my-3">
        <div class="col-lg-12">
            <h5><?php echo $row['name'] ?></h5>
            <div class="row mt-3">
                <div class="col-lg-8">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>خلاصه</th>
                            <td><?php echo $row['description'] ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4">
                    <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" style="width:100%; height:350px; border-radius:50%" />'; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-lg-6">
            <h5> مشخصات اثر </h5>
            <table class="table">
                <tbody>
                <tr>
                    <th>کد کالا</th>
                    <td><?php echo $row['code'] ?></td>
                </tr>
                <tr>
                    <th>نویسنده</th>
                    <td><?php echo $row['author'] ?></td>
                </tr>
                <tr>
                    <th>قیمت</th>
                    <td><?php echo $row['price'] ?></td>
                </tr>
                <tr>
                    <th>ژانر</th>
                    <td><?php echo $row['genre'] ?></td>
                </tr>
                <tr>
                    <th>ناشر</th>
                    <td><?php echo $row['publisher'] ?></td>
                </tr>
                <tr>
                    <th>تاریخ چاپ</th>
                    <td><?php echo $row['publicationDate'] ?></td>
                </tr>
                </tbody>
            </table>

        </div>
        <div class="col-lg-6">
            <h5> مشخصات فیزیکی </h5>
            <table class="table">
                <tbody>
                <tr>
                    <th>نوع جلد</th>
                    <td><?php echo $row['coverType'] ?></td>
                </tr>
                <tr>
                    <th>تعداد صفحات</th>
                    <td><?php echo $row['numberOfPages'] ?></td>
                </tr>
                <tr>
                    <th>نوع کاغذ صفحات</th>
                    <td><?php echo $row['paperType'] ?></td>
                </tr>
                <tr>
                    <th>رنگ متن </th>
                    <td><?php echo $row['textColor'] ?></td>
                </tr>
                </tbody>
            </table>

        </div>

        <div class="back_btn">
            <a href="book_index.php">
                <button class="btn btn-lg btn-warning">بازگشت</button>
            </a>
        </div>

    </div>

</div>


</body>
</html>