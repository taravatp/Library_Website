<!DOCTYPE html>
<html>
<head>
</head>

<body>

<?php
session_start();

$q = intval($_GET['q']);

$con = mysqli_connect('localhost', 'root', '');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
mysqli_select_db($con, "task2");

if ($q == 1) {
    $sql = "SELECT * FROM books order by price";

} elseif ($q == 2) {
    $sql = "SELECT * FROM books order by price desc";

} else {
    $sql = "select * from books";
}

$result = mysqli_query($con, $sql);
?>

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

</body>
</html>