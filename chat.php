<?php
    session_start(); 

    $link=mysqli_connect("localhost", "root", "root", "chat");
    
    if(isset($_POST["message"])){
        $today = date("YmdHms");
        $datetime = date("Y-m-d H:m:s");
        $message = $_POST["message"];
        $currentUserId = $_SESSION["user_id"];
        $sql = "INSERT INTO chat.messages (user_id, message_text, message_time) VALUES ($currentUserId, '$message', '$today')";
        $query_messages = mysqli_query($link, $sql);
    }

    $query = mysqli_query($link, "SELECT * FROM messages JOIN users ON messages.user_id = users.user_id");

    function getMessages($query){
        $result = array();

        while ( $row = mysqli_fetch_assoc($query) ) {
            $result[] = $row;
        }

        return $result;
    }

    $messages = getMessages($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/dist/app.js"></script>
    <title>Chat</title>
</head>
<body>

    <div class="chat">

        <div class="chat_header">
            <h1>Chat</h1>

            <div class="chat_settings">
                <a href="/settings.php" class="chat_settings_link">Настройки</a>
            </div>

            <div class="chat_logout flex">
                <a href="/logout.php" target="_self" class="chat_logout_link">Exit</a>
            </div>
        </div>

        <div class="chat_talk">
            <ul id="log">

                <?php foreach($messages as $value):?>
                    <?php 
                        $user_id = $value["user_id"];
                        $message_text = $value["message_text"];
                        $message_time = $value["message_time"];
                        $user_login = $value["user_login"];

                        echo(
                            "<li class='chat_message'>
                                <span class='chat_message_author'><strong>$user_login</strong></span>
                                <span class='chat_message_text'>$message_text</span>
                                <span class='chat_message_time'>$message_time</span>
                            </li>"); 
                    ?>
                <?php endforeach?>
            </ul>
        </div>

        <div class="chat_footer">
            <form method="post" class="chat_forms" action="/chat.php">
                <input type="text" name="message" class="chat_text" id="input_message">
                <input type="submit" value="send" class="chat_btn" name="submit" id="btn_send">
            </form>
        </div>

    </div>
</body>
</html>
