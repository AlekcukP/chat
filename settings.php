<?php 
    session_start();
    $link = mysqli_connect("localhost", "root", "root", "chat");
    $userId = $_SESSION['user_id'];

    if(isset($_POST["submit"])){
        if(strlen($_POST["login"])>1 || strlen($_POST["password"])>1){
            mysqli_query($link, "UPDATE users SET user_login = '".mysqli_real_escape_string($link, $_POST['login'])."' WHERE user_id = $userID");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/dist/app.js"></script>
    <title>Settings</title>
</head>
<body>
    <div class="settings_block">
        <section class="form_section">  
            <form method="POST" class="formwrapper">
                <div class="block_login formbox">
                    <label for="login">Enter new login:</label>
                    <input name="login" type="text" required>
                </div>
        
                <div class="formbox">
                    <label for="password">Enter new password:</label>
                    <input name="password" type="password" required>
                </div>
        
                <div class="flex">
                    <input name="submit" type="submit" value="Save">
                </div>
            </form>
    </div>
    <div class="back_block">
        <a href="/chat.php" class="back_link">Back to chat</a>
    </div>
</section>
</body>
</html>
