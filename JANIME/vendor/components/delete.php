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
            $path = '../../assets/image/characters/'.$_POST['name_anime'];
            deleteAnime($path);
            mysqli_query($link, "DELETE FROM `anime` WHERE `id`= '$id_anime'");
            header("location: ../../admin.php");
        }

    }
?>