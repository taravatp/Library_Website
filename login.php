<html>

<?php
session_start();
$_SESSION['login']=0;
$_SESSION['role']=0;

$con=mysqli_connect('localhost','root','');
if(!$con)
{
    die('could not connect'.mysqli_error());
}
$flag=false;
mysqli_select_db($con,"task2");

if($_SERVER['REQUEST_METHOD']=="POST"){
    $username=$_POST['username'];
    $password=$_POST['password'];

    $username=stripcslashes($username);
    $password=stripcslashes($password);

    $username=mysqli_real_escape_string($con,$username);
    $password=mysqli_real_escape_string($con,$password);

    $result=mysqli_query($con,"select * from users where username='$username' and password='$password'")
    or die('dont have an account?');

    $row=mysqli_fetch_array($result);

    if($row['username']==$username and $row['password']==$password){

        $_SESSION['id']=$row['id'];
        $_SESSION['username']=$row['username'];
        $_SESSION['role']=$row['role'];
        $_SESSION['login']=1;


        header("location: home.php");
    }
    else{
        $flag=true;
    }
}
?>

<head>
    <title>log in</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/forms.css">

    <style>
        body{
            background-image: url(images/back6.jpg);
            background-repeat: no-repeat;
            background-size: cover;
        }
        .card{
            box-shadow:  0 10px 10px -2px rgba(0, 0, 0, .3);
        }
    </style>

</head>

<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="card col-lg-6 p-0">

            <div class="card-header text-center">
                ورود
            </div>
            <form action="login.php" method="post" enctype="multipart/form-data" class="m-0">
                <div class="card-body">
                    <div class="form-group">
                        <label for="username">نام کاربری:</label>
                        <input type="text" name="username" class="form-control" autocomplete="off" placeholder="admin">
                    </div>

                    <div class="form-group">
                        <label for="password">رمز عبور:</label>
                        <input type='password'  name="password" class="form-control" autocomplete="off" placeholder="123456">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="w-100 p-2 bg-info btn" name="submit">ورود</button>
<!--                    <input type="submit" class="w-100 p-2 mb-1 bg-success btn" value="ورود">-->
                    <div class="text-center">
                        <p style="color:red; font-weight: bold"><?php if ($flag==true) echo "wrong user name or password."; $flag=false;?></p>
                        <p class="m-0">عضو کتابخانه نیستید؟</p>
<!--                        <a href="signup.php">sign up</a>-->
                        <a href="home.php">به عنوان مهمان وارد شوید.</a>
                    </div>

                </div>
            </form>


        </div>
    </div>
</div>

</body>
</html>
