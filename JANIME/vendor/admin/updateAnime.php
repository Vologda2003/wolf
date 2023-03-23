<?php
    include "../components/connect.php";
    $anime = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `anime` WHERE `id` = '{$_GET['id']}'"));
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/admin/admin.css">
    <link rel="stylesheet" href="../../assets/css/JANIME.css">
    <link rel="stylesheet" href="../../assets/css/Font.css"> 
    <link rel="shortcut icon" href="../../assets/image/ban.png" type="image/png">
    <title>JANIME</title>

</head>
<body>

    <ul class="body_slides">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>

    <header>

            <div class="logo-img">
                <a href="../../admin.php">
                    <img class="logo" src="../../assets/image/лого-2.png" alt="#">
                </a>
            </div>

            <div class="oc">
                <svg class="m" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 11H4C3.4 11 3 11.4 3 12C3 12.6 3.4 13 4 13H20C20.6 13 21 12.6 21 12C21 11.4 20.6 11 20 11ZM4 8H20C20.6 8 21 7.6 21 7C21 6.4 20.6 6 20 6H4C3.4 6 3 6.4 3 7C3 7.6 3.4 8 4 8ZM20 16H4C3.4 16 3 16.4 3 17C3 17.6 3.4 18 4 18H20C20.6 18 21 17.6 21 17C21 16.4 20.6 16 20 16Z" fill="black"/>
                </svg>
                <svg class="x" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.4 12L19.7 5.7C20.1 5.3 20.1 4.7 19.7 4.3C19.3 3.9 18.7 3.9 18.3 4.3L12 10.6L5.7 4.3C5.3 3.9 4.7 3.9 4.3 4.3C3.9 4.7 3.9 5.3 4.3 5.7L10.6 12L4.3 18.3C4.1 18.5 4 18.7 4 19C4 19.6 4.4 20 5 20C5.3 20 5.5 19.9 5.7 19.7L12 13.4L18.3 19.7C18.5 19.9 18.7 20 19 20C19.3 20 19.5 19.9 19.7 19.7C20.1 19.3 20.1 18.7 19.7 18.3L13.4 12Z" fill="black"/>
                </svg>
                
            </div>

            <a class="admin" href="../../admin.php">admin</a>

            <form class="search" method="post" action="../search/search.php">
                <input class="search2" name="search2" placeholder="Поиск" type="search">
                <button class="btn" type="submit" name="btnsearch"></button>
            </form>

    </header>

    <div class="content">

        <form class="content-editing" action="main.php" method="post" enctype="multipart/form-data">
            <div class="info">
                <div class="info-icon" style="background-image: url(../../<?php echo $anime['pictures']?>)">+
                    <input type="hidden" name="path_anime_icon" value="<?php echo $anime['pictures']?>">
                    <input type="file" name="anime_icon" class="info-icon-image" accept=".jpg, .png, .jpeg">
                </div>

                <ul class="info-head">
                    <li>Название аниме:<input type="text" name="name_anime" value="<?php echo $anime['name']?>"></li>
                    <input type="hidden" name="initials" value="<?php echo $anime['initials']?>">
                    <li>Жанры:<input type="text" name="genres" value="<?php echo implode(", ", json_decode($anime['genres'])); ?>"></li>
                    <li>Количество серий<input type="number" name="num_of_epis" value="<?php echo $anime['num_of_episodes']?>"></li>
                    <li>Длительность серии:<input type="text" name="duration" value="<?php echo $anime['series_duration']?>"></li>
                    <li>Год выпуска:<input type="text" name="year" value="<?php echo $anime['year_of_issue']?>"></li>
                    <li>Режиссер:<input type="text" name="director" value="<?php echo $anime['director']?>"></li>
                    <li>Студия:<input type="text" name="studio" value="<?php echo $anime['studio']?>"></li>
                </ul>             
            </div>

            <div class="info-description">
                <h1>Описание</h1>
                <textarea class="info-description-text" name="description"><?php echo $anime['description']?></textarea>
            </div>
            
            <div class="info-gallery-section">
                <h1>Галлерея</h1>
                <div class="info-gallery">Добавить
                    <input type="hidden" name="path_gallery" value="<?php echo $anime['picture_1']?>, <?php echo $anime['picture_2']?>, <?php echo $anime['picture_3']?>">
                    <input type="file" class="info-gallery-image" name="gallery[]" accept=".jpg, .png, .jpeg" multiple>
                </div>

                <div class="gallery-images-section">
                    <img src="../../<?php echo $anime['picture_1']?>" alt="#" class="gallery-images-image">
                    <img src="../../<?php echo $anime['picture_2']?>" alt="#" class="gallery-images-image">
                    <img src="../../<?php echo $anime['picture_3']?>" alt="#" class="gallery-images-image">
                </div>
            </div>

            <div class="info-video-section">

                <div class="info-video-icon" style="background-image: url(../../<?php echo $anime['screen_splash']?>)">Заставка видео
                    <input type="hidden" name="path_icon_video" value="<?php echo $anime['screen_splash']?>">
                    <input class="video-icon-image" type="file" accept=".jpg, .png, .jpeg" name="icon_video">
                </div>

                <div class="info-video">
                    
                    <div class="video-btn">Видео
                        <input type="hidden" name="path_video" value="<?php echo $anime['video']?>">
                        <input class="video" type="file" accept=".mp4" name="video">
                    </div>

                    <video controls class="video-video">
                        <source src="../../<?php echo $anime['video']?>" type="video/mp4">
                    </video>

                </div>

            </div>

            <input type="submit" class="save" value="Сохранить" name="saveUpdate">

            <?php
                if($_SESSION['message']){
            ?>
                <h3><?php echo $_SESSION['message']; ?></h3>
            <?php
                unset($_SESSION['message']);
                }
            ?>
            
        </form>

    </div>

    <footer>

        <div class="logo-img2">
            <a href="../../admin.php">
                <img class="logo2" src="../../assets/image/лого-2.png" alt="#">
            </a>
        </div>

        <p>Автор сайта не несёт ответственности за его содержимое ©2022</p>
        
        <p>janime@list.ru</p>

    </footer>

    <script src="../../assets/js/jquery-3.6.0.js"></script>
    <script src="../../assets/js/admin/admin.js"></script>
</body>
</html>