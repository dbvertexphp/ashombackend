/*slide.js create by suliang on 2015.06.26 */
function slide(obj){
    var $oGallery = $(".gallery");
    var $oSlide = $("#"+obj.wrap);
    var $lt = $(".lt-control");
    var $rt = $(".rt-control");
    var $btn = $(".btn");
    var wid = $oGallery.width();
    var len = $oGallery.find("li").length;
    var index = 0;
    $oGallery.css("width",wid*len);
    var timer = null;

    function move(i,t){
        $oGallery.stop(true,true).animate({
            "left":-wid*i
        },t,"easeInOutExpo");
        $btn.find("p").eq(i).addClass("btn-current").siblings("p").removeClass("btn-current");
    }

    function autoPlay(){
        if(index>=len-1){
            index = 0;
        }else{
            index++;
        }
        move(index,800);
    }

    timer = setInterval(autoPlay,obj.duration);

    $oSlide.hover(function(){
        clearInterval(timer);
    },function(){
        timer = setInterval(autoPlay,obj.duration)
    })

    $rt.on("click",function(){
        if(index>=len-1){
            index = 0;
        }else{
            index++;
        }
        move(index,200);
    })

    $lt.on("click",function(){
        if(index<=0){
            index = len-1;
        }else{
            index--;
        }
         move(index,200);
    })

    $btn.on("click","p",function(){
        index = $(this).index();
        move(index,800);
    })
}