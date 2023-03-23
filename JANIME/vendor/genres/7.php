<?php
    include "../components/connect.php";
    $animes = mysqli_query($link, "SELECT * FROM `anime`");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/JANIME.css">
    <link rel="stylesheet" href="../../assets/css/Font.css"> 
    <link rel="shortcut icon" href="../../assets/image/ban.png" type="image/png">
    <title>JANIME</title>
    <script src="../../assets/js/jquery-3.6.0.js"></script>
    <script src="j../../assets/s/main.js"></script>

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
                <a href="../../index.php">
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
            
            <div class="mn">
                <label class="menu-1">Жанры</label>
                <nav class="menu">
                    <ul>
                        <li><a href="1.php">Исекай</a></li>
                        <li><a href="2.php">Сёнен</a></li>
                        <li><a href="3.php">Фэнтези</a></li>
                        <li><a href="4.php">Комедия</a></li>
                        <li><a href="5.php">Меха</a></li>
                        <li><a href="6.php">Повседневность</a></li>
                        <li><a href="7.php">Приключения</a></li>
                        <li><a href="8.php">Спорт</a></li>
                    </ul>
                </nav>
            </div>

            <form class="search" method="post" action="../search/search.php">
                <input class="search2" name="search2" placeholder="Поиск" type="search">
                <button class="btn" type="submit" name="btnsearch"></button>
            </form>

    </header>

    <div class="content">

        <?php 
            while($anime = mysqli_fetch_array($animes)){
                if(in_array('Приключения', json_decode($anime['genres']))){
        ?>
        <div class="page">
            <a href="../../<?php echo $anime['link_anime']?>">
                <img src="../../<?php echo $anime['pictures']?>" alt="#">
            </a>
            <ul>
                <a href="../../<?php echo $anime['link_anime']?>">
                    <li class="name"><?php echo $anime['name']?></li>
                </a>
                <li>Жанры: <?php echo implode(", ", json_decode($anime['genres'])); ?></li>
                <li>Количество серий: <?php echo $anime['num_of_episodes']?> из <?php echo $anime['num_of_episodes']?> эп</li>
                <li>Длительность серии: <?php echo $anime['series_duration']?></li>
                <li>Год выпуска: <?php echo $anime['year_of_issue']?></li>
                <li>Режиссер: <?php echo $anime['director']?></li>
                <li>Студия: <?php echo $anime['studio']?></li>
            </ul>
        </div>
        <?php
                }
            }
        ?>

    </div>

    <footer>

        <div class="logo-img2">
            <a href="../../index.php">
                <img class="logo2" src="../../assets/image/лого-2.png" alt="#">
            </a>
        </div>

        <p>Автор сайта не несёт ответственности за его содержимое ©2022</p>
        
        <p>janime@list.ru</p>

    </footer>

</body>
</html>


