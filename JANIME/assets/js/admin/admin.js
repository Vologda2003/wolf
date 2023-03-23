$(document).ready(function(){
    if($(window).width() < 851){
        $(".m").click(function(){
            $(".x").css('display','flex');
            $(".m").css('display','none');
            $(".mn").css('display','flex');
            $(".admin").css('display','flex');
            $(".search").css('display','flex');
        });
    }
});



$(document).ready(function(){
    if($(window).width() < 851){
        $(".x").click(function(){
            $(".m").css('display','flex');
            $(".x").css('display','none');
            $(".mn").css('display','none');
            $(".admin").css('display','none');
            $(".search").css('display','none');
        });
    }
});



$(document).ready(function(){
    if($(window).width() < 851){
        var scrol;
        var y=0;
        $(window).scroll(function(){
            var scrolled = $(window).scrollTop();
            if(scrolled>scrol){
                y++;
                if(y >= 2){
                    $("header").css('display','none');
                    $(".m").css('display','flex');
                    $(".x").css('display','none');
                    $(".mn").css('display','none');
                    $(".admin").css('display','none');
                    $(".search").css('display','none');
                    y=0;
                }
            }else {
            $("header").css('display','flex');
            }
            scrol = scrolled;
        });
    }
});

// Получение и вывод картинки

let image_icon = document.getElementsByClassName('info-icon-image')[0];

image_icon.addEventListener('change', () => {
    document.getElementsByClassName('info-icon')[0].style.backgroundImage = "url(" + URL.createObjectURL(image_icon.files[0]) + ")";
});

// document.getElementsByClassName('artifacts-form-add')[0].addEventListener('reset', function() {
//     document.getElementsByClassName('info-icon')[0].style.backgroundImage = "url(" + path + ")";
// });

// Получение и вывод картинок галереи

let gallery = document.getElementsByClassName('info-gallery-image')[0];
let gallery_image = '';

gallery.addEventListener('change', function () {
    for (let i = 0; i < gallery.files.length; i++) {
        gallery_image += '<img src="' + URL.createObjectURL(gallery.files[i]) + '" alt="#" class="gallery-images-image">';
    }
    document.getElementsByClassName('gallery-images-section')[0].innerHTML = gallery_image;

    gallery_image = '';
});

// Получение и вывод картинки для видео

let image_icon_video = document.getElementsByClassName('video-icon-image')[0];

image_icon_video.addEventListener('change', () => {
    document.getElementsByClassName('info-video-icon')[0].style.backgroundImage = "url(" + URL.createObjectURL(image_icon_video.files[0]) + ")";
});


let video = document.getElementsByClassName('video')[0];

video.addEventListener('change', function () {
    document.getElementsByClassName('video-video')[0].src = `${URL.createObjectURL(video.files[0])}`;
    document.getElementsByClassName('video-video')[0].play();
});

