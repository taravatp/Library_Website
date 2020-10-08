<html>
<?php

session_start();
$port=3306;
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet"
          href=
          "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body {
            direction: rtl;
            text-align: right;
            font-family: IRANSans;
        }

        h5 {
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 8px;
        }

        @font-face {
            font-family: IRANSans;
            src: url(fonts/iran-sans-500.woff);
        }

        .item {
            text-align: center;
        }

        .item img {
            box-shadow: 2px 2px 2px 2px #aaaaaa;
            border-radius: 50%;
        }

        .caption {
            padding: 10px;
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
                <a class="nav-link" href="home.php">خانه<span class="sr-only"></span></a>
            </li>

            <?php if ($_SESSION['role'] == "manager" and $_SESSION['login']==1){?>
                <li class="nav-item">
                    <a class="nav-link" href="panel/members/member_index.php">مدیریت اعضا<span
                                class="sr-only"></span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="panel/personnels/personnel_index.php">مدیریت کارکنان<span
                                class="sr-only"></span></a>
                </li>
            <?php } ?>

            <?php if (($_SESSION['role'] == "manager" or $_SESSION['role'] == "personnel") and $_SESSION['login']==1) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="panel/books/book_index.php">بانک کتاب ها<span class="sr-only"></span></a>
                </li>
            <?php } ?>

            <div style="float:left;">
                <?php if ($_SESSION['login'] == 1) { ?>
                    <li class="nav-item" style="float: left;">
                        <a class="nav-link" href="login.php">خروج<span class="sr-only"></span></a>
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

<div class="container">

    <div class="row mt-5">

        <div class="col-lg-8" style="direction: rtl">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">خلاصه کتاب</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">مشخصات اثر</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2">مشخصات فیزیکی</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane container active" id="home">
                    <p class="my-4">
                        <?php echo $row['description'] ?>
                    </p>
                </div>
                <div class="tab-pane container fade" id="menu1">
                    <table class="table table-stripd">
                        <thead>
                        <th></th>
                        <th></th>
                        </thead>
                        <tbody>
                        <tr>
                            <td>کد کالا :</td>
                            <td><?php echo $row['code'] ?></td>
                        </tr>

                        <tr>
                            <td>ژانر :</td>
                            <td><?php echo $row['genre'] ?></td>
                        </tr>

                        <tr>
                            <td>نوسینده :</td>
                            <td><?php echo $row['author'] ?></td>
                        </tr>

                        <tr>
                            <td>ناشر :</td>
                            <td><?php echo $row['publisher'] ?></td>
                        </tr>

                        <tr>
                            <td>تاریخ چاپ :</td>
                            <td><?php echo $row['publicationDate'] ?></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <div class="tab-pane container fade" id="menu2">
                    <table class="table table-stripd">
                        <thead>
                        <th></th>
                        <th></th>
                        </thead>
                        <tbody>
                        <tr>
                            <td>نوع جلد :</td>
                            <td><?php echo $row['coverType'] ?></td>
                        </tr>

                        <tr>
                            <td>تعداد صفحات :</td>
                            <td><?php echo $row['numberOfPages'] ?></td>
                        </tr>

                        <tr>
                            <td>نوع کاغذ صفحات :</td>
                            <td><?php echo $row['paperType'] ?></td>
                        </tr>

                        <tr>
                            <td>رنگ متن :</td>
                            <td><?php echo $row['textColor'] ?></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="col-lg-4 p=0 item">
            <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" style="width:100%; height:350px;" />'; ?>
            <div class="caption">
                <P><?php echo $row['name'] ?></P>
                <P><?php echo $row['price'] ?> تومان</P>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h5>کتاب های مشابه</h5>
<!--            <div class="row">-->
<!--                --><?php
//                while ($rows = mysqli_fetch_array($similar)) {
//                    ?>
<!--                    <div class="col-lg-3 my-2">-->
<!--                        <div class="card">-->
<!---->
<!--                            <a href="book.php?id=--><?php //echo $rows['id']; ?><!--" target="_blank">-->
<!--                                <div class="card-body">-->
<!--                                    --><?php //echo '<img src="data:image/jpeg;base64,' . base64_encode($rows['image']) . '" style="width:100%; height:220px" class="image" />'; ?>
<!--                                    <div class="middle">-->
<!--                                        <div class="text">مشاهده</div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </a>-->
<!---->
<!--                            <div class="card-footer p-0">-->
<!--                                <div class="caption">-->
<!--                                    <p>--><?php //echo $rows['name'] ?><!--</p>-->
<!--                                    <p>--><?php //echo $rows['price'] . " تومان " ?><!--</p>-->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!--                        </div>-->
<!--                    </div>-->
<!--                --><?php //} ?>
<!--            </div>-->
        </div>
    </div>


</div>


</body>
</html>