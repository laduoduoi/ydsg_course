    $(function(){
    function main(){
        // 顶部二维码弹出
        $(".i1hover").hover(function(){
            $(this).find(">.ewm").show(); 
           var submenuEl = $(this).find(">.ewm");
            if (submenuEl) {
                submenuEl.stop().fadeIn();
            }
        }, function(){
            $(this).find(">.ewm").stop().fadeOut(); 
        });
        // 热门项目弹出
        $(".kc-l").hover(function(){
            $(this).next().show(); 
           var submenuEl1 = $(this).next();
            if (submenuEl1) {
                submenuEl1.show();
            }
        }, function(){
            $(this).next().hide(); 
        });
    }  
    main();  

    //大图小图切换（产品主图）
    $(".smallImg img").hover(function () {
        $(this).addClass("on").siblings().removeClass("on");
        $(".bigImg img").hide();
        $(".bigImg img").eq($(this).index()).show();
    });

      
});  
 $(function(){   
     $(window).scroll(function() {      
       if($(window).scrollTop() >= 100){
           $('.xuanfu').fadeIn(300); 
            }else{    
               $('.xuanfu').fadeOut(300);    
             }  
              });
              $('.xf-top').click(function(){
              $('html,body').animate({scrollTop: '0px'}, 800);}); 
   }); 
 // 新闻详情
$("#hot").hide();
$(".xwtj-nav").hover(function(){
    $(this).addClass('hover').siblings().removeClass('hover'); 
    id=$(this).data('id');
     $(".xwtj-lb").hide(); 
     $('#'+id).show();   
})
//联系我们锚点
 $(".jigou").click(function(){
 $('.jigou').removeClass('hover');
 $(this).addClass('hover'); 
  var href = 't'+$(this).data("id");
  var pos = $('#'+href).offset().top-130;
  $("html,body").animate({scrollTop: pos}, 500); 
  return false;
});