<?php
    session_start();

    if(isset($_POST['submit'])){
        $err = [];

        if(!preg_match('/^[a-zA-Z0-9]+$/',$_POST['login'])){
            $err[] = 'Login can consist only letters of the English alphabet and numbers';
        }

        if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30){
            $err[] = 'Login must be at least 3 symbols and no more than 30';
        }


        $query = mysqli_query($link, "SELECT user_id FROM users WHERE user_login = '".mysqli_real_escape_string($link, $_POST['login'])."'");
        if(mysqli_num_rows($query) > 0){
            $err[] = 'User with this login has already exists';
        }

        if(count($err) == 0){

            $login = $_POST['login'];

            $password = trim($_POST['password']);

            mysqli_query($link,"INSERT INTO users SET user_login='".$login."', user_password='".$password."'");
            header('Location: login.php'); exit();
        }
        else{
            print '<b>During registration has been found next errors:</b><br>';
            foreach($err as $error){
                print $error.'<br>';
            }
        }
    }

    require_once($root.'/views/register.phtml');
?>
