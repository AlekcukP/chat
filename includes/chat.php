<?php
    session_start(); 
    
    if(isset($_POST['message'])){
        $today = date('YmdHms');
        $datetime = date('Y-m-d H:m:s');
        $message = $_POST['message'];
        $currentUserId = $_SESSION['user_id'];
        $sql = "INSERT INTO chat.messages (user_id, message_text, message_time) VALUES ($currentUserId, '$message', '$today')";
        $queryMessages = mysqli_query($link, $sql);
    }
    
    $query = mysqli_query($link, "SELECT messages.user_id, messages.id, message_text, message_time, users.user_login FROM messages JOIN users ON messages.user_id = users.user_id");

    function getMessages($query){
        $result = array();

        while ( $row = mysqli_fetch_assoc($query) ) {
            $result[] = $row;
        }

        return $result;
    }

    $messages = getMessages($query);

    include_once('./views/chat.phtml');
?>
