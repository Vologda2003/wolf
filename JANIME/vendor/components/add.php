<?php
    include "connect.php";
    if(!$_SESSION['admin']){
        header("Location: authorization.php");
    }
    else{
        if(isset($_POST['save'])){
            $path = 'assets/anime/'.trim($_POST['initials']);
            $name = trim($_POST['name_anime']);
            $initials = trim($_POST['initials']);
            $genres = json_encode(explode(', ', trim($_POST['genres'])), JSON_UNESCAPED_UNICODE);
            $num_of_epis = trim($_POST['num_of_epis']);
            $duration = trim($_POST['duration']);
            $year = trim($_POST['year']);
            $director = trim($_POST['director']);
            $studio = trim($_POST['studio']);
            $description = trim($_POST['description']);
            $pictures = null;
            $picture_1 = null;
            $picture_2 = null;
            $picture_3 = null;
            $video = null;
            $screen_splash = null;
            $link_anime = 'vendor/description/page.php?name='.$name;

            if(!is_dir('../../'.$path)){
                mkdir('../../'.$path);
            }

            if(!empty($_FILES['anime_icon'])){
                if(move_uploaded_file($_FILES['anime_icon']['tmp_name'], '../../'.$path."/".basename($_FILES['anime_icon']['name']))){
                    $pictures = $path."/".basename($_FILES['anime_icon']['name']);
                }
                else{
                    $_SESSION['message'] = 'Ошибка при добавлении картинки'.basename($_FILES['anime_icon']['name']);
                }
            }

            if(!empty($_FILES['icon_video'])){
                if(move_uploaded_file($_FILES['icon_video']['tmp_name'], '../../'.$path."/".basename($_FILES['icon_video']['name']))){
                    $screen_splash = $path."/".basename($_FILES['icon_video']['name']);
                }
                else{
                    $_SESSION['message'] = 'Ошибка при добавлении заставки видео'.basename($_FILES['icon_video']['name']);
                }
            }

            if(!empty($_FILES['video'])){
                if(move_uploaded_file($_FILES['video']['tmp_name'], '../../'.$path."/".basename($_FILES['video']['name']))){
                    $video = $path."/".basename($_FILES['video']['name']);
                }
                else{
                    $_SESSION['message'] = 'Ошибка при добавлении видео'.basename($_FILES['video']['name']);
                }
            }

            if(!empty($_FILES['gallery'])){
                for($i = 0; $i < count($_FILES['gallery']['name']); $i++){
                    if(move_uploaded_file($_FILES['gallery']['tmp_name'][$i], '../../'.$path."/".basename($_FILES['gallery']['name'][$i]))){
                        if($i === 0){
                            $picture_1 = $path."/".basename($_FILES['gallery']['name'][$i]);
                        }
                        elseif($i === 1){
                            $picture_2 = $path."/".basename($_FILES['gallery']['name'][$i]);
                        }
                        elseif($i === 2){
                            $picture_3 = $path."/".basename($_FILES['gallery']['name'][$i]);
                        }
                    }
                    else{
                        $_SESSION['message'] = 'Ошибка при добавлении видео'.basename($_FILES['gallery']['name'][$i]);
                    }
                }
            }

            if(mysqli_num_rows(mysqli_query($link, "SELECT * FROM `anime` WHERE `name`='$name' AND `initials`='$initials' AND `pictures`='$pictures' AND `genres`='$genres' 
            AND `num_of_episodes`='$num_of_epis' AND `series_duration`='$duration' AND `year_of_issue`='$year' AND `director`='$director' AND `studio`='$studio' AND `description`='$description' 
            AND `picture_1`='$picture_1' AND `picture_2`='$picture_2' AND `picture_3`='$picture_3' AND `screen_splash`='$screen_splash' AND `video`='$video' AND `link_anime`='$link_anime'")) == 0){
                if(mysqli_query($link, "INSERT INTO `anime`(`name`, `initials`, `pictures`, `genres`, `num_of_episodes`, `series_duration`, `year_of_issue`, `director`, 
                `studio`, `description`, `picture_1`, `picture_2`, `picture_3`, `screen_splash`, `video`, `link_anime`) 
                VALUES ('$name', '$initials', '$pictures', '$genres', '$num_of_epis', '$duration', '$year', '$director', '$studio', '$description', 
                '$picture_1', '$picture_2', '$picture_3', '$screen_splash', '$video', '$link_anime')")){
                    $_SESSION['message'] = 'Аниме добавлено';
                }
                else{
                    $_SESSION['message'] = 'Ошибка при добавлении';
                }
            }
            else{
                $_SESSION['message'] = 'Такое аниме существует';
            }
            header("Location: ../admin/add_anime.php");
        }
    }
?>