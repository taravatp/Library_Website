<?php
$con=mysqli_connect('localhost','root','','MySQL');

if(!$con)
{
    die("Unabe to connect <br>".mysqli_error($con));
}


$query="CREATE DATABASE task2";
if(mysqli_query($con,$query))
{
    echo "data base created <br>";
}
else{
    echo"error creating database: ".mysqli_error($con)."<br>";
}

mysqli_select_db($con,"task2");

$query="CREATE TABLE users(
id int not null AUTO_INCREMENT,
PRIMARY KEY (id),

image LONGBLOB,
first_name varchar(50) ,
last_name varchar(50),
national_id int,
gender varchar (50),
phone_number varchar (50),
address varchar (200),
role varchar (50),
username varchar(50) not null unique,
password varchar(50) not null
)";

if(mysqli_query($con,$query)){
    echo "table created:) <br>";
}
else{
    echo"error creating table: ".mysqli_error($con)."<br>";

};

$query="insert into users(image,first_name,last_name,national_id,gender,phone_number,role,username,password) values('images/user.png','taravat','part','9523343','female','09361165120','manager','admin','123456')";
if(!mysqli_query($con,$query))
{
    die('error creating user: '.mysqli_error($con));
}
else{
    echo "admin created!";
}

$query="CREATE TABLE books(
id int not null AUTO_INCREMENT,
PRIMARY KEY (id),

image LONGBLOB DEFAULT '',
name varchar(50) not null,
price   int not null,

code int,
genre varchar(50),
author varchar(50),
publicationDate int,
publisher varchar(50),

coverType varchar(50),
numberOfPages int,
paperType varchar(50),
textColor varchar(50),

description varchar(3000),
posetdBy varchar(50)

)";

if(mysqli_query($con,$query)){
    echo "table created:)";
}
else{
    echo"error creating table: ".mysqli_error($con)."<br>";

};

?>