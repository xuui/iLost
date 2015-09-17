/* iLost Sidefollow. */
(function(ilostQ){ilostQ(function(){
var $window=ilostQ(window),$document=ilostQ(document),mouseover_tid=[],mouseout_tid=[];
$window.load(function(){
  var sidebar=ilostQ('#aside');
  /*
  if(sidebar.length>0)var side0ffset=sidebar.offset();
  $window.scroll(function(){
    Sidefollow(sidebar,side0ffset);
  });
  */
  sidebar.affix({
  offset: {
    top: sidebar.offset().top;
    bottom: function () {
      return (this.bottom = ilostQ('footer').outerHeight(true));
    }
  }
})
})
/*
function Sidefollow(id,offset){
  if(id.length>0){
    var id_line=offset.top+id.outerHeight()-$window.height();
    var footer_line=ilostQ('footer').offset().top;
    if($document.scrollTop()>id_line){
      id.css({position:'fixed',bottom:0});
    }else{
      id.css({position:'static'});
    }
  }
}
*/
});})(jQuery);
/*
(function(ilostQ){ilostQ(function(){
ilostQ(window).load(function(){
  var side=ilostQ('#siderbar'),sideOset=side.offset();
  ilostQ(window).scroll(function(){
  console.log('sideOset.top='+sideOset.top);
   });
});
});})(jQuery);
/*
(function($){
$.fn.sidefollow=function(options){/*
  var defualts={footer:null,bottom:0};var opts=$.extend({},defualts,options);var aside=$(this);
  
  //if(aside.outerHeight(true)>$(window).height()){
    var sideTop=aside.offset().top+aside.outerHeight(true)-$(window).height()+opts.bottom;
  //}else{
    var sideTop=aside.offset().top;
  //}
  
  var sideLeft=aside.offset().left;
  
  $(window).scroll(function(){
    if(aside.outerHeight(true)>=$(window).height()){if(jQuery('article').outerHeight(true)>aside.outerHeight(true))sideOnScroll();}
  });
  
  $(window).resize(function(){
    sideLeft=aside.offset().left;
    if(aside.outerHeight(true)>=$(window).height()){if(jQuery('article').outerHeight(true)>aside.outerHeight(true))sideOnScroll();}
  });
  
  function sideOnScroll(){
	var fooTop=$(document).height()-$(window).height()-opts.footer.outerHeight(true);
	
	if($(document).scrollTop()>=sideTop){
	
	  aside.css({position:'fixed',top:function(index,value){
		
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
	
	}else{aside.css({position:'static'});}
  }*//*
};  
})(jQuery); 
(function(){(function(jQuery){
jQuery(document).ready(function(){
  if(jQuery(window).width()>940)jQuery('#aside .clean').sidefollow({footer:jQuery('footer'),bottom:0});
});
})(jQuery);})();*/