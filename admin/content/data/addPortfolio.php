<?php
    require_once('../../../php/connect.php');

    if(isset($_POST['submit'])){
        $time = date('H-i-s');
        $name = $_POST['name'];
        $type = $_POST['type'];      
        $description = $_POST['description']; 
        $client = $_POST['client']; 
        $date = $_POST['date'];

        if(!empty($_FILES['logo'])){
            $file = $_FILES['logo'];
            $fileName = $file['name'];

            $mysql->query("INSERT INTO `portfolio` (`name_photo`,`name`, `type`, `description`, `client`, `date`, `time`) VALUES ('$fileName', '$name', '$type', '$description', '$client', '$date', '$time')");
            if(is_dir('../../../portfolio/'.$time.' '.$name.' '.$client)){
                $pathFile = '../../../portfolio/'.$time.' '.$name.' '.$client.'/'.$fileName;
            }else{
                mkdir('../../../portfolio/'.$time.' '.$name.' '.$client);
                $pathFile = '../../../portfolio/'.$time.' '.$name.' '.$client.'/'.$fileName;
            }
                
            if(!move_uploaded_file($file['tmp_name'], $pathFile)){
                echo 'Помилка завантаження фото логотипа!';
            } 
        }

        if(!empty($_FILES['gallery'])){
            $file = $_FILES['gallery'];
            $fileName = $file['name'];


            $query = $mysql->query("SELECT * FROM `portfolio`");
            while($row = mysqli_fetch_assoc($query)){
                if(is_dir('../../../portfolio/'.$time.' '.$name.' '.$client.'/gallery/')){
                    $pathFile = '../../../portfolio/'.$time.' '.$name.' '.$client.'/gallery/'.$fileName;
                }else{
                    mkdir('../../../portfolio/'.$time.' '.$name.' '.$client.'/gallery/');
                    $pathFile = '../../../portfolio/'.$time.' '.$name.' '.$client.'/gallery/'.$fileName;
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
        <h2><b><i>Портфоліо</i></b></h2>
            <form action="addPortfolio.php" method="post" enctype="multipart/form-data">
                <input class="file" type="file" name="logo" required>
                <input type="text" name="name" placeholder="Назва населеного пункту" required>
                <input type="text" name="type" placeholder="Тип проєкту" required>
                <textarea type="text" name="description" placeholder="Опис" required></textarea>
                <input type="text" name="client" placeholder="Клієнт" required>
                <input type="date" name="date" placeholder="Дата" required>
                <input class="file" type="file" name="gallery" required>
                <button type="submit" name="submit">Додати проєкт</button>
            </form>
        </div>
    </div>
</body>
</html>