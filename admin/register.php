<?php
    error_reporting(E_ERROR | E_PARSE | E_NOTICE);

    require_once('../php/connect.php');

    $login = trim($_POST['login']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    $result = $mysql->query("SELECT * FROM `admins` WHERE `login` = '$login' OR `email` = '$email'");
    $user = $result->fetch_assoc(); 

    if($login != ''){
        if(mb_strlen($login) < 4){
            $login_error = "Логін повинен містити не менше 4 символів";
        }else{
            if($user['login'] == $login){
                $login_error = "Користувач з таким логіном вже існує";
            }else{
                if($user['email'] == $email){
                    $email_error = "Користувач з таким email вже існує";
                }else{
                    if(mb_strlen($password) < 8){
                        $password_error = "Пароль повинен містити не менше 8 символів";
                    }elseif(mb_strlen($password) > 32){
                        $password_error = "пароль повинен містити менше 32 символів";
                    }else{
                        if($confirm_password != $password){
                            $confirm_error = "Паролі не співпадають";
                        }else{
                            if(isset($_POST['submit'])){
                                $password = md5($password);
                                $mysql->query("INSERT INTO `admins` (`login`, `email`, `password`) VALUES ('$login', '$email', '$password')");
                                $mysql->close();
                                mkdir("../profile/".$login, 0777);
                                mkdir("../profile/".$login."\logo/", 0777);
                                header('Location: login.php');
                            }
                        }
                    }
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Реєстрація</title>
</head>
<body>
    <div class="nemesis_tm_contact">
        <div class="fields">
            <h2>Реєстрація</h2>
            <form action="register.php" method="POST" class="contact_form" id="contact_form" autocomplete="off">
                <ul>
                    <li> <h3><?php echo $login_error;?></h3><input id="login" type="text" placeholder="Login" name="login" value="<?php echo $login;?>"> </li>
                    <li> <h3><?php echo $email_error;?></h3><input id="email" type="text" placeholder="Email" name="email" value="<?php echo $email;?>"> </li>
                    <li> <h3><?php echo $password_error;?></h3><input id="password" type="password" placeholder="Password" name="password"> </li>
                    <li> <h3><?php echo $confirm_error;?></h3><input id="password" type="password" placeholder="Confirm Password" name="confirm_password"> </li>
                </ul>
                <input type="hidden" name="act" value="order">
                <button type="submit" name="submit">Реєстрація</button>
            </form>
            <h4><a href="login.php">Увійти в акаунт</a></h4>
        </div>
    </div>
</body>
</html>