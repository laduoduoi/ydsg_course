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
});  
// 数字动态增加


 var aDiv=document.getElementById('div1');
 var avalue=1;
 setInterval(function(){
  aDiv.innerHTML=avalue;
   if(avalue<6){
  avalue++;
    }     
 },200);
var bDiv=document.getElementById('div2');
 var bvalue=100;
 setInterval(function(){
  bDiv.innerHTML=bvalue;
   if(bvalue<10000){
  bvalue=bvalue+100;
    }     
 },20);
 var cDiv=document.getElementById('div3');
 var cvalue=1;
 setInterval(function(){
  cDiv.innerHTML=cvalue;
   if(cvalue<29){
  cvalue++;
    }     
 },100);

// 项目列表
$(".i6 .b-nav-1").hover(function(){
    $(this).addClass('b-nav-in').siblings().removeClass('b-nav-in'); 
    id=$(this).data('id');
    $(".c-nav-list").hide(); 
     $('#'+id).show();
})
// 案例列表
$(".i7 .b-nav-1").hover(function(){
    $(this).addClass('b-nav-in').siblings().removeClass('b-nav-in'); 
    id=$(this).data('id');
    $(".i7-nav").hide(); 
     $('#'+id).show();
    var swiper5 = new Swiper('#'+id, {
      slidesPerView: 4,
      autoplay:true,
      loop: true,
});      
})
// 新闻列表
$(".i12 .b-nav-1").hover(function(){
    $(this).addClass('b-nav-in').siblings().removeClass('b-nav-in'); 
    id=$(this).data('id');
     $(".i12-nav-list").hide(); 
     $('#'+id).show();   
})
// 悬浮
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