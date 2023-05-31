<?php
    setcookie('user', $user['login'], time() - 3600, "/");
    header("Location: /admin/login.php");
?>