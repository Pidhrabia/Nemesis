<?php
    require_once('../../../php/connect.php');
    $id = $_GET['id'];
    $deleteFolder = $mysql->query("SELECT * FROM `blog` WHERE `id` = '$id'");
    $row = mysqli_fetch_assoc($deleteFolder);

    function removeDir($dir){
        global $row; 
        $files = array_diff(scandir($dir), ['..'], ['.']);

        foreach($files as $file){
            $path = $dir.'/'.$file;

            if(is_dir($path)){
                removeDir($path);
            }else{
                unlink($path);
            }
        }

        rmdir($dir);
    }

    removeDir('../../../blog/'.$row['time'].' '.$row['date'].' '.$row['who']);
    $mysql->query("DELETE FROM `blog` WHERE `id` = '$id'");

    header("Location: ../admin.php");
?>