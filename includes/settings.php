<?php 
    session_start();

    $userId = $_SESSION['user_id'];

    // if(isset($_POST['submit'])){
    //     if(strlen($_POST['login'])>1 || strlen($_POST['password'])>1){
    //         mysqli_query($link, "UPDATE users SET user_login = '".mysqli_real_escape_string($link, $_POST['login'])."' WHERE user_id = $userID");
    //     }
    // }
    
    if(isset($_POST['avatar'])){
        var_dump($_FILES);
        $f_err = 0;
        $types     = array(
            '.jpg',
            '.JPG',
            '.jpeg',
            '.gif',
            '.bmp',
            '.png'
        );
        $path      = "$root.'/avatar'";
        $fname     = $_FILES['avatar']['name'];
        $ext       = substr($fname, strpos($fname, '.'), strlen($fname) - 1);

        if (!in_array($ext, $types)) {
            $f_err++;
        }

        if ($f_err == 0) {
            $source_src = $path . $fname;

            move_uploaded_file($_FILES['avatar']['name'], $source_src);
        }
    }
    include_once($root.'/views/settings.phtml');
?>
