<?php
    require_once('../../../php/connect.php');

        $id = $_GET['id'];   
        $portfolio = $mysql->query("SELECT * FROM `portfolio` WHERE `id` = '$id'");
        $row = mysqli_fetch_assoc($portfolio);

        if(isset($_POST['submit'])){
            $id = $_POST['id'];
            $description = $_POST['description'];

            if(!empty($description)){
                $mysql->query("UPDATE `portfolio` SET `description` = '$description' WHERE `id` = '$id'");
            }

            if(!empty($_FILES['gallery'])){
                $file = $_FILES['gallery'];
                $fileName = $file['name'];
    
    
                $query = $mysql->query("SELECT * FROM `portfolio` WHERE `id` = '$id'");
                while($row = mysqli_fetch_assoc($query)){
                    if(is_dir('../../../portfolio/'.$row['time'].' '.$row['name'].' '.$row['client'].'/gallery/')){
                        $pathFile = '../../../portfolio/'.$row['time'].' '.$row['name'].' '.$row['client'].'/gallery/'.$fileName;
                    }else{
                        mkdir('../../../portfolio/'.$row['time'].' '.$row['name'].' '.$row['client'].'/gallery/');
                        $pathFile = '../../../portfolio/'.$row['time'].' '.$row['name'].' '.$row['client'].'/gallery/'.$fileName;
                    }
                    
                    if(!move_uploaded_file($file['tmp_name'], $pathFile)){
                        echo '';
                    }
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
    <title>Портфоліо</title>
</head>
<body>
    <div class="portfolio">
        <div class="portfolio__content">
        <h2><b><i>Редагувати портфоліо</i></b></h2>
            <form action="editPortfolio.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=$row['id']?>">
                <input type="text" name="name" placeholder="Назва населеного пункту" value="<?=$row['name']?>" readonly>
                <input type="text" name="type" placeholder="Тип проєкту" value="<?=$row['type']?>" readonly>
                <textarea type="text" name="description" placeholder="Опис"><?=$row['description']?></textarea>
                <input type="text" name="client" placeholder="Клієнт" value="<?=$row['client']?>" readonly>
                <input type="date" name="date" placeholder="Дата" value="<?=$row['date']?>" readonly>
                <input class="file" type="file" name="gallery">
                <button type="submit" name="submit">Оновити проєкт</button>
            </form>
        </div>
    </div>
</body>
</html>