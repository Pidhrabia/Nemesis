<?php
    $name= $_POST['name'];
    $email = $_POST['email'];
    $comments = $_POST['comments'];

    function send_telegram(){
        global $name;
        global $email;
        global $comments;

        $token = "5528299519:AAFLE6T0zXqGyVGcectJIQlrdmkY944J79E";
        $chat_id = "-1001823034961";

        if ($_POST['act'] == 'order') {

            $arr = array(
                "Ім'я: " => $name,
                "Email: " => $email,
                "Повідомлення: " => $comments
            );

            foreach($arr as $key => $value) {
                $txt .= "<b>".$key."</b> ".$value."%0A";
            };

            $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");
        }
    }

    
    send_telegram();
    header("Location: /index.php");
?>