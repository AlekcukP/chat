<?
$link=mysqli_connect("localhost", "root", "root", "chat");

if(isset($_POST["submit"])){

    $query = mysqli_query($link, "SELECT * FROM messages");

    function getMessages($query){
        $result;

        while ( $row = mysqli_fetch_assoc($query) ) {
            $result[] = $row;
        }

        return $result;
    }

    $messages = getMessages($query);
}

if(isset($_POST["message"])){
    $today = date("YmdHms");
    $message = $_POST["message"];
    $sql = "INSERT INTO chat.messages (user_id, message_text, message_time) VALUES ('1', '$message', '$today')";
    $query = mysqli_query($link, $sql);
    $error = mysqli_error($link);
    var_dump($error);

}

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
        <div class="chat_header"><h1>Chat</h1></div>
        <div class="chat_talk">
            <ul id="log">
                <?foreach($messages as $value):?>
                    <?$user_id = $value["user_id"];
                    $message_text = $value["message_text"];
                    $message_time = $value["message_time"];

                    echo("<li class='chat_message'>
                        <span class='chat_message_author'><strong>$user_id</strong></span>
                        <span class='chat_message_text'>$message_text</span>
                        <span class='chat_message_time'>$message_time</span>
                    </li>") ?>
                <?endforeach?>
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
