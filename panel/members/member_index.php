<!DOCTYPE html>
<?php
session_start();

$con = mysqli_connect('localhost', 'root', '');
if (!$con) {
    die("Unabe to connect <br>" . mysqli_error($con));
}

$i = 0;
mysqli_select_db($con, 'task2');
$result = mysqli_query($con, "select * from users where role='member'");

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    mysqli_query($con, "delete from users where id='$id'");
    header("location: member_index.php");
}
?>
<head>
    <title>اعضای کتاب خانه</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/index.css">


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
                    <a class="nav-link" href="member_index.php">مدیریت اعضا<span class="sr-only"></span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../personnels/personnel_index.php">مدیریت کارکنان<span
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


<div class="container">
    <div class="insert">
        <a href="member_create.php">
            <button type="button" class="btn btn-success btn-lg">عضو جدید</button>
        </a>
    </div>
    <div class="card">

        <div class="card-header">
            <p>مدیریت اعضا</p>
        </div>

        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">نام</th>
                    <th scope="col">نام خانوادگی</th>
                    <th scope="col">شماره تلفن</th>
                    <th scope="col">گزینه ها</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($rows = mysqli_fetch_array($result)) {
                    $i = $i + 1; ?>
                    <tr>
                        <th scope="row"><?php echo $i ?></th>
                        <td><?php echo $rows['first_name'] ?></td>
                        <td><?php echo $rows['last_name'] ?></td>
                        <td><?php echo $rows['phone_number'] ?></td>
                        <td colspan="5">
                            <a href="member_view.php?id=<?php echo $rows['id']; ?>">
                                <button class="btn btn-success btn-xs"><i class="fa fa-eye"></i></button>
                            </a>
                            <a href="member_edit.php?id=<?php echo $rows['id']; ?>">
                                <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                            </a>
                            <form method="post" action="member_index.php" class="delete-from">
                                <input type="hidden" name="id" value="<?php echo $rows['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-xs" name="delete"><i
                                            class="fa fa-trash-o "></i></button>
                            </form>

                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>


</div>
</body>
</html>