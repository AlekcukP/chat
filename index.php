<?php
    session_start();

    include_once('config.php');
    
    include_once($root.'/includes/link.php');

    switch($_GET['page']){
        case 'chat': 

            if(isset($_SESSION['user_id']) ){
                include($root.'/includes/chat.php');
            } else {
                include($root.'/includes/login.php');
            }
        break;

        case 'login': 
            include($root.'/includes/login.php');
        break;

        case 'settings':
            include($root.'/includes/settings.php');
        break;

        case 'logout':
            include($root.'/includes/logout.php');
        break;

        case 'register':
            include($root.'/includes/register.php');
        break;
    }

    if($_SERVER['REQUEST_URI'] === '/'){
        header('Location: index.php?page=login');
    }
?>
