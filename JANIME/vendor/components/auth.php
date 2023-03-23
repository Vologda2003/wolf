<?php
include "connect.php";
if(isset($_POST['submit_auth'])){
    $login = trim($_POST['login']);
    $password = md5(trim($_POST['password']));
    $admin  = mysqli_query($link, "SELECT * FROM `admin` WHERE `login`= '$login' AND `password`= '$password'");
    if(mysqli_num_rows($admin) > 0){
        $_SESSION['admin'] = $login;
        header("Location: ../../admin.php");
    }
    else{
        $_SESSION['message'] = 'Неверно введен логин или пароль';
        header("Location: ../admin/authorization.php");
    }
}