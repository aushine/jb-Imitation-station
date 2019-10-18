var $colorBar = $(".colorBar");
var $sub_menu = $(".sub-menu");
var $nav_bar_li = $("#top_nav_bar li");
var $slides = $(".slide");
var $category_btn = $(".category_btn ul li");
var $left_right_btn = $(".banner_slide .left_btn, .banner_slide .right_btn");
var flag = 0;
var t = null;
var t2 = null;
var diss = null;
var left_navi_flag = 0;
var navi_flag = 0;
var dd = null;


var li_point = "<li class='active'></li>";

for(var i=0;i<($slides.length)-1;i++){li_point += "<li></li>";}

$(".points").append($(li_point));

var $points = $(".points li");

$(".points").css("marginLeft",-($(".points").width())/2);
$(".special_reco_posts li,.rank_0 a img,.top_reco a img").css({"transition":"all .4s ease"});
$(".reco_post li:first-child").addClass("checked");

if($(window).width()<768){
    $(".banner_slide").height($(".reco").height()*2);
}else{
    $(".banner_slide").height($(".reco").height());
}



$(".reco img").css("transition","all .7s ease");
$(".to_up").click(function () {
    $("html, body").animate({"scrollTop": "0"});
});

$points.click(point_click);
$left_right_btn.click(fnleftOrRight_click);
$category_btn.click(function () {

   $( this ).addClass("underline").siblings().removeClass("underline");
    $($(".posts")[$category_btn.index($( this ))]).addClass("show").siblings().removeClass("show");

});
$(".mobile_navi").click(function () {
    $( this ).find(".mobile_nav").toggleClass("open_mobile_nav");
    $(".left_navi").height($(window).height());
    $(".left_navi").width(($(window).width()*.46));
    if(!navi_flag){
        navi_flag = 1;
        $("html").css("overflow","hidden");
        $("body").css({"left":$(".left_navi").width()});
    }else{
        navi_flag = 0;
        $("html").css("overflow","auto");
        $("body").css({"left":0});
    }
});
$(".left_navi").click(function () {
    event.stopPropagation();
});

$colorBar.html($colorBar.html()+$colorBar.html());

$sub_menu.addClass("clearfix");

function moveLeft(){
    $colorBar.animate({"left":-($colorBar.width()/2)}, 5000, "linear", function () {$colorBar.css({"left":0});});
}
moveLeft();
var move_lft_timer = setInterval(moveLeft,5000);
var slide_timer =  setInterval(slide_play,3900);

function slide_play(step=1) {

    $($slides[flag]).fadeTo(1000,0.1).css("zIndex",2);

    if(flag===$slides.length-1 && step !== -1){
        $($slides[flag]).fadeTo(1000,0.1).css("zIndex",2);
        flag = 0;
        $($points[flag]).addClass("active").siblings().removeClass("active");

        $($slides[flag]).fadeTo(1000,1).css("zIndex",3);
    }else if(flag===-1 && step !== 1){
        $($slides[flag+1]).fadeTo(1000,0.1).css("zIndex",2);
        flag = $slides.length-1;

        $($points[flag]).addClass("active").siblings().removeClass("active");

        $($slides[flag]).fadeTo(1000,1).css("zIndex",3);
    }

    else{

        if(flag === 0 && step === -1){
            $($points[$slides.length-1]).addClass("active").siblings().removeClass("active");
            $($slides[$slides.length-1]).fadeTo(1000,1).css("zIndex",3);
        }else{
            $($points[flag+step]).addClass("active").siblings().removeClass("active");
            $($slides[flag+step]).fadeTo(1000,1).css("zIndex",3);
        }

        flag+=step;

    }
}
window.onresize = function () {
    if($(window).width()<768){
        $(".banner_slide").height($(".reco").height()*2);
    }else{
        $(".banner_slide").height($(".reco").height());
    }
};
$(window).scroll(function fnScrollFunc() {
    /*
    /**此处为函数节流, 本来设置了滚轮事件0.1s的节流,
    /***但是使用感觉有一点不流畅, 所以取消了节流
    /****因为滚轮事件时高触发事件, 添加节流可节省系统资源, 取消注释可以开启
    clearTimeout(t2);
    $(window).off("scroll");*/
    if($(window).scrollTop() >= $(window).height()-98){
        $(".footer_tool .to_up").fadeIn("fast");
    }else{
        $(".footer_tool .to_up").fadeOut("fast");
    }
    if($("footer").offset().top - $(".footer_tool").offset().top <= 65){
        $(".footer_tool").css({
            "position":"absolute",
            "top":-65
        })
    }
    if(!($("footer").offset().top < $(window).scrollTop() + $(window).height() && $("footer").offset().top > $(window).scrollTop())){

        $(".footer_tool").css({
            "position":"fixed",
            "bottom":17,
            "top":""
        })
    }
    /*t2 = setTimeout(function () {
        $(window).on("scroll",fnScrollFunc);
    },100);*/

});
function fnleftOrRight_click() {
    clearTimeout(t);
    clearInterval(slide_timer);
    $left_right_btn.off("click");
    var rightOrleft = $( this )[0].id;
    if(rightOrleft === "left_btn"){
        slide_play(-1);
    }else{
        slide_play(1);
    }
    t = setTimeout(function () {

        $left_right_btn.on("click",fnleftOrRight_click);
        slide_timer = setInterval(slide_play,3900);
    },1000);
}
function point_click() {
    clearTimeout(t);
    clearInterval(slide_timer);
    $points.off("click");
    diss = $( this );

    diss.addClass("active").siblings().removeClass("active");
    var n = $points.index(diss);
    flag = n;
    $($slides[flag]).fadeTo(1000,1).css("zIndex",3).siblings().fadeTo(1000,0.1).css("zIndex",2);

    t = setTimeout(function () {

        $points.on("click",point_click);
        slide_timer = setInterval(slide_play,3900);

    },600);
   }
(function () {

    $(".top_nav_bar ul a").each(function () {
        if( $(this).attr("href") == location.href ){
            $(this).css("color","#00c1de");
        }
    });
    $(".reco li").hover(function () {
        $(this).find(".mask").stop().animate({"opacity":"0.1"});
        $(this).find("img").css({"transform":"scale(1.3)"})

    },function () {
        $(this).find(".mask").stop().animate({"opacity":"0.4"});
        $(this).find("img").css("transform","scale(1.2)")
    });

    $(".new_posts .post_thumbnail").hover(function () {
        $(this).find("img").css("transform","scale(1.1)");
    },function () {
        $(this).find("img").css("transform","scale(1)");
    });

    $(".special_reco_posts li").hover(function () {
        $( this ).find("img").css("transform","scale(1.1)");
    },function () {
        $( this ).find("img").css("transform","scale(1)");
    });

    $( ".tb_head").hover(function () {
        $( this ).addClass("tb_head_hover");
    },function () {
        $( this ).removeClass("tb_head_hover");
    });

    $(".reco_post").mouseleave(function () {
        $( this ).find(".checked").removeClass("checked");
        $($( this )[0].children[0]).addClass("checked");
    });

    $(".reco_post li").hover(function () {
        $( this ).addClass("checked").siblings().removeClass("checked");
    });

    $(".reco_img li").hover(function () {

        $( this ).find("i").stop().animate({opacity:0.1});
        $( this ).find("img").css("transform","scale(1.1) translateY(-50%)");
    },function () {
        $( this ).find("i").stop().animate({opacity:0.4});
        $( this ).find("img").css("transform","scale(1) translateY(-50%)");
    });
    $nav_bar_li.hover(function () {
        $( this ).find(".sub-menu").stop().slideDown("fast");
    },function () {
        $( this ).find(".sub-menu").stop().slideUp("fast");
    });

    $nav_bar_li.each(function () {
        if($( this ).find(".sub-menu")[0]){
            $( this ).find("a")[0].append($("<i class=\"fa fa-angle-down\" aria-hidden=\"true\"></i>")[0]);
        }
    });

    $(".left_navi li").each(function () {
        if($( this ).find(".sub-menu")[0]){
            $( this ).append($("<i class=\"fa fa-angle-down\"></i>")[0]);
            // var $had_sub_li = $( this );
            $( this ).click(function () {
                $($( this ).find(".sub-menu")[0]).slideToggle("fast");
                if(!left_navi_flag){
                    left_navi_flag = 1;
                    $($( this ).find("i")[0]).css("transform", "rotate(180deg)");
                }else{
                    left_navi_flag = 0;
                    $($( this ).find("i")[0]).css("transform", "rotate(0deg)");
                }

            })
            // $($( this ).find(".sub-menu")[0]).parent().append($("<i class=\"fa fa-angle-down\"></i>")[0]);
        }
    })

})();