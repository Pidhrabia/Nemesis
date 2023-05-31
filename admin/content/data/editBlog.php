<?php
    require_once('../../../php/connect.php');

        $id = $_GET['id'];   
        $portfolio = $mysql->query("SELECT * FROM `blog` WHERE `id` = '$id'");
        $row = mysqli_fetch_assoc($portfolio);

        if(isset($_POST['submit'])){
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];

            if(!empty($name)){
                $mysql->query("UPDATE `blog` SET `name` = '$name' WHERE `id` = '$id'");
            }

            if(!empty($description)){
                $mysql->query("UPDATE `blog` SET `description` = '$description' WHERE `id` = '$id'");
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
        <h2><b><i>Редагувати блог</i></b></h2>
            <form action="editBlog.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=$row['id']?>">
                <input type="text" name="name" placeholder="Назва населеного пункту" value="<?=$row['name']?>">
                <textarea type="text" name="description" placeholder="Опис"><?=$row['description']?></textarea>
                <input type="date" name="date" placeholder="Дата" value="<?=$row['date']?>" readonly>
                <button type="submit" name="submit">Оновити блог</button>
            </form>
        </div>
    </div>
</body>
</html>