/* iLost Sidefollow. */

(function(ilostQ){ilostQ(function(){
var $window=ilostQ(window),$document=ilostQ(document),mouseover_tid=[],mouseout_tid=[];
$window.load(function(){
  var sidebar=ilostQ('#aside'),
      side_topLine=sidebar.offset(),
      side_Width=sidebar.width(),
      footer=ilostQ('footer');
  
  //if(sidebar.length>0)var sideTop_Line=sidebar.offset().top;
  $window.scroll(function(){
    sideFollow(sidebar,side_topLine,footer.offset().top,side_Width);
  });
});
function sideFollow(id,offset,footer,widthFix){
  
  if(id.length>0){
    
    var startLine=offset.top+id.outerHeight()-$window.height(),
        endLine=footer-$window.height();
        
    if($document.scrollTop()>=startLine){
      if($document.scrollTop()<=endLine){
        id.css({position:'fixed',bottom:0,width:widthFix});
      }else{
        id.css({bottom:function(){
          return footer - $document.scrollTop();
          }
        });
      }
    }else{
      id.css({position:'static'});
    }
  }
}

})})(jQuery);
/* */
/*
(function($){
$.fn.sidefollow=function(options){
  var defualts={footer:null,bottom:0};var opts=$.extend({},defualts,options);var aside=$(this);
  
  if(aside.outerHeight(true)>$(window).height()){
    var sideTop=aside.offset().top+aside.outerHeight(true)-$(window).height()+opts.bottom;
  }else{
    var sideTop=aside.offset().top;
  }
  
  var sideLeft=aside.offset().left;
  var sideWidth=aside.width();
  
  $(window).scroll(function(){
    if(aside.outerHeight(true)>=$(window).height()){
      if(jQuery('article').outerHeight(true)>aside.outerHeight(true))sideOnScroll(sideWidth);
    }
  });
  
  $(window).resize(function(){
    sideLeft=aside.offset().left;
    if(aside.outerHeight(true)>=$(window).height()){
      if(jQuery('article').outerHeight(true)>aside.outerHeight(true))sideOnScroll(sideWidth);
    }
  });
  
  function sideOnScroll(w){
    
    var fooTop=$(document).height()-$(window).height()-opts.footer.outerHeight(true);
	
    if($(document).scrollTop()>=sideTop){
    
      aside.css({width:w,position:'fixed',top:function(index,value){
      
      if(aside.outerHeight(true)>=$(window).height()){
      
        var sideTop=$(window).height()-aside.outerHeight(true);
        if($(document).scrollTop()>=fooTop){
      
          return fooTop-$(document).scrollTop()+sideTop-opts.bottom;
      
        }else{
      
          return sideTop-opts.bottom;
      
        }
      }else{
        if($(document).scrollTop()>fooTop){
          return fooTop-$(document).scrollTop()-opts.bottom;
        }else{
          return 0-opts.bottom;
        }
      }
      
      },left:function(index,value){
      return sideLeft;
      
      }});
    
    }else{
      aside.css({position:'static'});
    }
  }
};  
})(jQuery); 
(function(){(function(jQuery){
jQuery(document).ready(function(){
  if(jQuery(window).width()>940){
    jQuery('#aside').sidefollow({footer:jQuery('footer'),bottom:10});
  }
});
})(jQuery);})();*/