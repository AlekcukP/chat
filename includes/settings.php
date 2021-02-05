<?php 
    session_start();

    $userId = $_SESSION['user_id'];

    if(isset($_POST['submit'])){
        if(strlen($_POST['login'])>1 || strlen($_POST['password'])>1){
            mysqli_query($link, "UPDATE users SET user_login = '".mysqli_real_escape_string($link, $_POST['login'])."' WHERE user_id = $userID");
        }
    }

    include_once($root.'/views/settings.phtml');
?>
