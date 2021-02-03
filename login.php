<?php
session_start();
$link = mysqli_connect("localhost", "root", "root", "chat");

if(isset($_POST['submit'])){

    $userResult = mysqli_query($link,"SELECT user_id, user_password FROM users WHERE user_login='".mysqli_real_escape_string($link,$_POST['login'])."' LIMIT 1");
    $userData = mysqli_fetch_assoc($userResult);



    if($userData['user_password'] === $_POST['password']){
                
        $_SESSION['user_id'] = $userData['user_id'];
        $_SESSION['user_login'] = $userData['user_login'];
        
        setcookie("CookieMy", $userData['user_login'], time()+60*60*24*10);           
    
        header("Location: chat.php"); 
        
        exit();
    }

    else{
        print "Вы ввели неправильный логин/пароль";
    }
}

if (isset($_SESSION['user_id'])){
    header("Location: chat.php"); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/dist/app.js"></script>
    <title>Login</title>
</head>
<body>

    <section class="form_section flex">   

        <form method="POST" class='formwrapper'>
            <div class="block_login formbox">
                <label for="login">Login</label>
                <input name="login" type="text" required id='login'>
            </div>

            <div class="block_pass formbox">
                <label for="password">Password</label>
                <input name="password" type="password" required id="password">
            </div>

            <div class="block_action formbox">
                <input name="submit" type="submit" value="Войти">
                <div class="block_reg"><a href="register.php">Register</a></div>
            </div>
        </form>
    </section>
    
</body>
</html>
