<?php
  error_reporting(E_ERROR | E_PARSE | E_NOTICE);

  require_once("../php/connect.php");

  $login = trim($_POST['login']);
  $password = trim($_POST['password']);
  $pass = md5($password);

  $result = $mysql->query("SELECT * FROM `admins` WHERE `login` = '$login' AND `password` = '$pass'");
  $user = $result->fetch_assoc(); 


  if(isset($_POST['submit'])){
      if($login != $user['login'] || $pass != $user['password']){
          $error = "Неправильний логін або пароль!";
        } else {
          setcookie('user', $user['login'], time() + 3600, "/");
          $mysql->close();
          header("Location: content/admin.php");
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
    <title>Авторизація</title>
</head>
<body>
    <div class="nemesis_tm_contact">
        <div class="fields">
        <h2>Авторизація</h2>
            <form action="login.php" method="POST" class="contact_form" id="contact_form" autocomplete="off">
                <div class="returnmessage" data-success="Your message has been received, We will contact you soon."></div>
                    <div class="first">
                        <ul>
                            <h3><?php echo $error;?></h3>
                            <li><input id="login" type="text" placeholder="Login" name="login"> </li>
                            <li><input id="password" type="password" placeholder="Password" name="password"> </li>
                        </ul>
                    </div>
                <input type="hidden" name="act" value="order">
                <button type="submit" name="submit">Авторизація</button>
            </form>
            <h4><a href="register.php">Зареєструвати акаунт</a></h4>
        </div>
    </div>
</body>
</html>