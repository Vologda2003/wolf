<?php
    include "../components/connect.php";
    if(!$_SESSION['admin']){
        header("location: ../admin/authorization.php");
    }
    else{
        if(isset($_POST['delete'])){
            function deleteAnime($delanime){
                $files = array_diff(scandir($delanime), array('.', '..'));
                foreach($files as $file){
                    if(is_dir($delanime.'/'.$file)){
                        deleteAnime($delanime.'/'.$file);
                    }
                    else{
                        unlink($delanime.'/'.$file);
                    }
                }
                rmdir($delanime);
            }
            $initials = $_POST['initials'];
            $path = '../../assets/anime/'.$initials;
            deleteAnime($path);
            mysqli_query($link, "DELETE FROM `anime` WHERE `initials`= '$initials'");
            header("location: ../../admin.php");
        }

        if(isset($_POST['saveUpdate'])){
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

            $path_anime_icon = $_POST['path_anime_icon'];
            $path_gallery = explode(', ', $_POST['path_gallery']);
            $path_icon_video = $_POST['path_icon_video'];
            $path_video = $_POST['path_video'];

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

            if(!empty($_FILES['anime_icon']['name'])){
                if(move_uploaded_file($_FILES['anime_icon']['tmp_name'], '../../'.$path."/".basename($_FILES['anime_icon']['name']))){
                    $pictures = $path."/".basename($_FILES['anime_icon']['name']);
                }
                else{
                    $_SESSION['message'] = 'Ошибка при добавлении картинки'.basename($_FILES['anime_icon']['name']);
                }
            }
            else{
                $pictures = $_POST['path_anime_icon'];
            }

            if(!empty($_FILES['icon_video']['name'])){
                if(move_uploaded_file($_FILES['icon_video']['tmp_name'], '../../'.$path."/".basename($_FILES['icon_video']['name']))){
                    $screen_splash = $path."/".basename($_FILES['icon_video']['name']);
                }
                else{
                    $_SESSION['message'] = 'Ошибка при добавлении заставки видео'.basename($_FILES['icon_video']['name']);
                }
            }
            else{
                $screen_splash = $path_icon_video;
            }

            if(!empty($_FILES['video']['name'])){
                if(move_uploaded_file($_FILES['video']['tmp_name'], '../../'.$path."/".basename($_FILES['video']['name']))){
                    $video = $path."/".basename($_FILES['video']['name']);
                }
                else{
                    $_SESSION['message'] = 'Ошибка при добавлении видео'.basename($_FILES['video']['name']);
                }
            }
            else{
                $video = $path_video;
            }

            if($_FILES['gallery']['name'][0] != ''){
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
            else{
                $picture_1 = $path_gallery[0];
                $picture_2 = $path_gallery[1];
                $picture_3 = $path_gallery[2];
            }

            if(mysqli_num_rows(mysqli_query($link, "SELECT * FROM `anime` WHERE `initials`='$initials'")) > 0){
                if(mysqli_query($link, "UPDATE `anime` SET `name` = '$name', `initials` = '$initials', `pictures` = '$pictures', `genres` = '$genres', `num_of_episodes` = '$num_of_epis', 
                `series_duration` = '$duration', `year_of_issue` = '$year', `director` = '$director', 
                `studio` = '$studio', `description` = '$description', `picture_1` = '$picture_1', `picture_2` = '$picture_2', `picture_3` = '$picture_3', `screen_splash` = '$screen_splash', 
                `video` = '$video', `link_anime` = '$link_anime' WHERE `initials`='$initials'")){
                    $_SESSION['message'] = 'Аниме изменено';
                }
                else{
                    $_SESSION['message'] = 'Ошибка при изменении';
                }
            }
            else{
                $_SESSION['message'] = 'Такого аниме нет';
            }

            if($_SESSION['message'] == 'Аниме изменено'){
                unset($_SESSION['message']);
                header("Location: ../../admin.php");
            }
            else{
                header("Location: updateAnime.php");
            }
        }

    }
?>