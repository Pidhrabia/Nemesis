<?php
    require_once('../../../php/connect.php');

    if(isset($_POST['submit'])){
        $name = $_POST['name'];     
        $description = $_POST['description'];  
        $date = $_POST['date'];
        $time = date('H-i-s');
        $who = 'Admin';

        if(!empty($_FILES['logo'])){
            $file = $_FILES['logo'];
            $fileName = $file['name'];

            $mysql->query("INSERT INTO `blog` (`name_photo`,`name`, `description`, `date`, `time`, `who`) VALUES ('$fileName', '$name', '$description', '$date', '$time', '$who')");
            if(is_dir('../../../blog/'.$time.' '.$date.' '.$who)){
                $pathFile = '../../../blog/'.$time.' '.$date.' '.$who.'/'.$fileName;
            }else{
                mkdir('../../../blog/'.$time.' '.$date.' '.$who);
                $pathFile = '../../../blog/'.$time.' '.$date.' '.$who.'/'.$fileName;
            }
                
            if(!move_uploaded_file($file['tmp_name'], $pathFile)){
                echo 'Помилка завантаження фото логотипа!';
            } 
        }
        header("Location: ../admin.php");
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Блог</title>
</head>
<body>
    <div class="blog">
        <div class="blog__content">
        <h2><b><i>Додати блог</i></b></h2>
            <form action="addBlog.php" method="post" enctype="multipart/form-data">
                <input class="file" type="file" name="logo" required>
                <input type="text" name="name" placeholder="Назва блогу" required>
                <textarea type="text" name="description" placeholder="Текст блогу..." required></textarea>
                <input type="date" name="date" placeholder="Дата" required>
                <button type="submit" name="submit">Додати блог</button>
            </form>
        </div>
    </div>
</body>
</html>