<html>
<?php
session_start();

$con = mysqli_connect('localhost', 'root', '');
if (!$con) {
    die("Unabe to connect <br>" . mysqli_error($con));
}
mysqli_select_db($con, 'task2');
$result = mysqli_query($con, "select * from books");

if (isset($_POST['search'])) {
    $name = $_POST['name'];
    $result = mysqli_query($con, "select * from books where (author='$name' OR name='$name')");

}

?>

<head>

    <meta charset="utf-8">
    <title>خانه</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet"
          href=
          "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/home.css">

    <script>
        function filter(id) {
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                    document.getElementById("con").innerHTML=this.responseText;
                }
            }
            xmlhttp.open("GET","ajax.php?q="+id,true);
            xmlhttp.send();
        }
    </script>


</head>
<body onload="check()">

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



    </div>
</nav>
<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-lg-3">

            <div class="box">
                <form method="get">
                    <div class="form-group mb-3">
                        <select class="form-control" onchange="filter(this.value)">
                            <option value="">چینش</option>
                            <option value="1">قیمت-صعودی</option>
                            <option value="2">قیمت-نزولی</option>
                        </select>
                    </div>
                </form>
            </div>

            <div class="box">
                <form method="post" action="home.php">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="submit" name="search"><i
                                        class="fa fa-search"></i></button>
                        </div>
                        <input type="text" class="form-control" placeholder="جست و جو کتاب" name="name">
                    </div>
                </form>
            </div>

            <div class="box">
                <h5 style=" border-bottom: 1px solid #dee2e6; padding-bottom: 8px;">گروه بندی</h5>
            </div>
        </div>


        <div class="col-lg-9">
            <!--            <div class="row">-->
            <div class="row" id="con">
                <?php
                while ($rows = mysqli_fetch_array($result)) {

                    ?>
                    <div class="col-lg-4 my-2">
                        <div class="card">

                            <a href="book.php?id=<?php echo $rows['id']; ?>" target="_blank">
                                <div class="card-body">
                                    <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($rows['image']) . '" style="width:100%; height:220px" class="image" />'; ?>
                                    <div class="middle">
                                        <div class="text">مشاهده</div>
                                    </div>
                                </div>
                            </a>

                            <div class="card-footer p-0">
                                <div class="caption">
                                    <p><?php echo $rows['name'] ?></p>
                                    <p><?php echo $rows['price'] . " تومان " ?></p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <!--            </div>-->
        </div>


    </div>
</div>


</body>


</html>