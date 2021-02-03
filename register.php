<?php
session_start();
$link=mysqli_connect("localhost", "root", "root", "chat");

if(isset($_POST['submit'])){
    $err = [];

    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login'])){
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    }

    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30){
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }


    $query = mysqli_query($link, "SELECT user_id FROM users WHERE user_login = '".mysqli_real_escape_string($link, $_POST['login'])."'");
    if(mysqli_num_rows($query) > 0){
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }

    if(count($err) == 0){

        $login = $_POST['login'];

        $password = trim($_POST['password']);

        mysqli_query($link,"INSERT INTO users SET user_login='".$login."', user_password='".$password."'");
        header("Location: login.php"); exit();
    }
    else{
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach($err as $error){
            print $error."<br>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/dist/app.js"></script>
    <title>Register</title>
</head>
<body>
    <section class="form_section">  
    
        <form method="POST" class="formwrapper">
            <div class="block_login formbox">
                <label for="login">Login</label>
                <input name="login" type="text" required id='reg_login'>
            </div>
    
            <div class="block_register_pass formbox">
                <label for="password">Password</label>
                <input name="password" type="password" required id="reg_password">
            </div>
    
            <div class="block_register_action flex">
                <input name="submit" type="submit" value="Register me">
            </div>
        </form>
    
    </section>
</body>
</html>
