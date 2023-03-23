
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




$(document).on("click", ".image-1", function(){
    $(".foto").css('display','flex');
    $(".image-1-1").css('display','flex');
});



$(document).on("click", ".image-2", function(){
    $(".foto").css('display','flex');
    $(".image-2-1").css('display','flex');
});



$(document).on("click", ".image-3", function(){
    $(".foto").css('display','flex');
    $(".image-3-1").css('display','flex');
});



$(document).on("click", ".foto_left", function(){
    if($(".image-1-1").css("display") == "flex"){
            $(".image-3-1").css('display','flex');
            $(".image-1-1").css('display','none');
    }
    else if($(".image-3-1").css("display") == "flex"){
        $(".image-2-1").css('display','flex');
        $(".image-3-1").css('display','none');
    }
    else{
        $(".image-1-1").css('display','flex');
        $(".image-2-1").css('display','none');
    }
});



$(document).on("click", ".foto_right", function(){
    if($(".image-1-1").css("display") == "flex"){
            $(".image-2-1").css('display','flex');
            $(".image-1-1").css('display','none');
    }
    else if($(".image-2-1").css("display") == "flex"){
        $(".image-3-1").css('display','flex');
        $(".image-2-1").css('display','none');
    }
    else{
        $(".image-1-1").css('display','flex');
        $(".image-3-1").css('display','none');
    }
});



$(document).mouseup(function (e) {
    if($(".foto").css("display") == "flex"){
        if ($(".foto_div").has(e.target).length === 0){
            $(".foto").css('display','none');
            $(".image-1-1").css('display','none');
            $(".image-2-1").css('display','none');
            $(".image-3-1").css('display','none');
        }
    }
});



$(document).ready(function(){
    $(".search").submit(function(){
        var an = $('input[name="search2"]').val();
        sessionStorage.setItem("a", an);
    });
});
