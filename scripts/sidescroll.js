/* iLost Sidefollow. */
(function($){  
$.fn.sidefollow=function(options){
  var defualts={footer:null,bottom:0};var opts=$.extend({},defualts,options);var aside=$(this);
  if(aside.outerHeight(true)>$(window).height()){var sideTop=aside.offset().top+aside.outerHeight(true)-$(window).height()+opts.bottom;}else{var sideTop=aside.offset().top;}
  var sideLeft=aside.offset().left;
  $(window).scroll(function(){
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
	}else{
	  aside.css({position:'static'});
	}
  });
  $(window).resize(function(){
	 sideLeft=aside.offset().left;
  });
};  
})(jQuery); 
///////////////////////////////////////////////////////////////////////////////
(function(){(function(jQuery){
jQuery(document).ready(function(){
  if(jQuery(window).width()>800)jQuery('#aside').sidefollow({footer:jQuery('footer'),bottom:0});
});
})(jQuery);})();