<?php
    error_reporting();

    #підключення до бази даних
    require_once("../../php/connect.php");

    $login = $_COOKIE['user'];

    #запит на вибірку інформації певного коритсувача
    $result = $mysql->query("SELECT * FROM `admins` WHERE `login` = '$login'");
    $user = $result->fetch_assoc(); 

    #перевірка чи існує COOKIE
    if($_COOKIE['user'] == ''){
        $mysql->close();
        header("Location: ../login.php");
    }

    #Редагування іфнормації адміністратора
    if(isset($_POST['add__info'])){
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $age = $_POST['age'];
        $phone = $_POST['phone'];

        glob(unlink('../../profile\\'.$login.'\logo/'));

        if(!empty($_FILES['file'])){
            $file = $_FILES['file'];
            $fileName = $file['name'];
            $pathFile = '../../profile/'.$login.'\logo\\'.$fileName;
            header("Location: admin.php");
    
            if(!move_uploaded_file($file['tmp_name'], $pathFile)){
                echo 'Помилка завантаження фала!';
            }
        }
        if(!empty($name)){
            $mysql->query("UPDATE `admins` SET `name` = '$name' WHERE `login` = '$login'");
            header("Location: admin.php");
        }
        if(!empty($surname)){
            $mysql->query("UPDATE `admins` SET `surname` = '$surname' WHERE `login` = '$login'");
             header("Location: admin.php");
        }
        if(!empty($age)){
            $mysql->query("UPDATE `admins` SET `age` = '$age' WHERE `login` = '$login'");
            header("Location: admin.php");
        }
        if(!empty($phone)){
            $mysql->query("UPDATE `admins` SET `phone` = '$phone' WHERE `login` = '$login'");
            header("Location: admin.php");
        }
    }

    #Вивід фотографії адміністратора
    function show_logo(){
        global $login;
        $featureDir = '../../profile/'.$login.'/logo/';
        $scan = scandir($featureDir);
        for($i=0; $i<count($scan); $i++){
            if($scan[$i] != '.' && $scan[$i] != '..'){
                echo '<img src="'.$featureDir.$scan[$i].'"alt="image" />';
            }
        }
    }

    #Вивід портфоліо
    function show_portfolio(){
        global $mysql;

        $portfolio = $mysql->query("SELECT * FROM `portfolio`");

        while($row = mysqli_fetch_assoc($portfolio)){
            echo'
                <div class="portfolio__items">
                    <img src="../../portfolio/'.$row['time'].' '.$row['name'].' '.$row['client'].'/'.$row['name_photo'].'" alt="">
                    <div class="portfolio__info">
                        <label>
                            <h3>'.$row['name'].'</h3>
                        </label>
                        <label>
                            <span>'.$row['client'].'</span>
                        </label>
                        <label>
                            <span>'.$row['date'].'</span>
                        </label>
                    </div>
                    <label>
                        <a class="edit_portfolio" href="data/editPortfolio.php?id='.$row['id'].'">Редагувати</a>
                        <a class="delete_portfolio" href="data/deletePortfolio.php?id='.$row['id'].'">Видалити</a>
                    </label>
                </div>
            ';
        }
    }

    function show_blog(){
        global $mysql;

        $portfolio = $mysql->query("SELECT * FROM `blog`");

        while($row = mysqli_fetch_assoc($portfolio)){
            echo'
                <div class="blog__items">
                    <img src="../../blog/'.$row['time'].' '.$row['date'].' '.$row['who'].'/'.$row['name_photo'].'" alt="">
                    <div class="blog__info">
                        <label>
                            <h3>'.$row['name'].'</h3>
                        </label>
                        <label>
                            <span>By '.$row['who'].'</span>
                        </label>
                        <label>
                            <span>'.$row['date'].'</span>
                        </label>
                    </div>
                    <label>
                        <a class="edit_portfolio" href="data/editBlog.php?id='.$row['id'].'">Редагувати</a>
                        <a class="delete_portfolio" href="data/deleteBlog.php?id='.$row['id'].'">Видалити</a>
                    </label>
                </div>
            ';
        }
    }

    
?>