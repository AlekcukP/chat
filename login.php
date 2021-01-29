<?

$link=mysqli_connect("localhost", "root", "root", "chat");

if(isset($_POST['submit'])){

    $query = mysqli_query($link,"SELECT user_id, user_password FROM users WHERE user_login='".mysqli_real_escape_string($link,$_POST['login'])."' LIMIT 1");
    $data = mysqli_fetch_assoc($query);

    if($data['user_password'] === $_POST['password'])
    {

        // Ставим куки
        // setcookie("id", $data['user_id'], time()+60*60*24*30, "/");
        // setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true); // httponly !!!

        // Переадресовываем браузер на страницу проверки нашего скрипта
        // header("Location: check.php"); exit();
        header("Location: dist/index.html"); exit();
    }
    else
    {
        print "Вы ввели неправильный логин/пароль";
    }
}
?>

<section class="section_log">
    
    <form method="POST">
        <div class="block_login">
            <label for="login">Login</label>
            <input name="login" type="text" required id='login'>
        </div>
        <div class="block_pass">
            <label for="password">Password</label>
            <input name="password" type="password" required id="password">
        </div>
<div class="block_action">
    <input name="submit" type="submit" value="Войти">
    <div class="block_reg"><a href="#">Register</a></div>
</div>
    </form>
    
</section>


