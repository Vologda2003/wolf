
$(document).ready(function(){
    if($(window).width() < 851){
        $(".m").click(function(){
            $(".x").css('display','flex');
            $(".m").css('display','none');
            $(".mn").css('display','flex');
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

