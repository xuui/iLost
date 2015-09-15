(function(){function goTop(acceleration,time){acceleration=acceleration||0.1;time=time||16;var dx=0,dy=0,bx=0,by=0,wx=0,wy=0;if(document.documentElement){dx=document.documentElement.scrollLeft||0;dy=document.documentElement.scrollTop||0;}if(document.body){bx=document.body.scrollLeft||0;by=document.body.scrollTop||0;}var wx=window.scrollX||0,wy=window.scrollY||0,x=Math.max(wx,Math.max(bx,dx)),y=Math.max(wy,Math.max(by,dy)),speed=1+acceleration;window.scrollTo(Math.floor(x/speed),Math.floor(y/speed));if(x>0||y>0){var invokeFunction="ilosts.goTop("+acceleration+","+time+")";window.setTimeout(invokeFunction,time);}}function quickComments(){commentobj=document.getElementById('comment');if(commentobj){commentobj.onkeydown=function(moz_ev){var ev=null;if(window.event){ev=window.event;}else{ev=moz_ev;}if(ev!=null&&ev.ctrlKey&&ev.keyCode==13){document.getElementById('submit').click();}}}}window['ilosts']={};window['ilosts']['goTop']=goTop;window['ilosts']['quickComments']=quickComments;})();var ilost_notify=function(title,options){if(!window.Notification){return;}if(Notification.permissionLevel()==='default'){Notification.requestPermission(function(){notify(title,options);});}else if(Notification.permissionLevel()==='granted'){var n=new Notification(title,options);}else if(Notification.permissionLevel()==='denied'){return;}};
/* iLost JS Code. */
(function(ilostQ){ilostQ(function(){
var $window=ilostQ(window),$document=ilostQ(document),mouseover_tid=[],mouseout_tid=[];
$document.ready(function(){
  var $nav=ilostQ('.navbar-nav'),$searchs=ilostQ('#searchform #s'),Storage=localStorage,$username=ilostQ('input#author'),$usermaill=ilostQ('input#email'),$userurl=ilostQ('input#url');
  
  /* dropdown-menu */
  $nav.find('li').has('ul').addClass('sub-ul dropdown');
  $nav.find('li').has('ul').find('ul').addClass('dropdown-menu');
  $nav.find('li').each(function(index){ilostQ(this).hover(function(){var _self=this;clearTimeout(mouseout_tid[index]);mouseover_tid[index]=setTimeout(function(){ilostQ(_self).find('ul:eq(0)').slideDown(200);},200);},function(){var _self=this;clearTimeout(mouseover_tid[index]);mouseout_tid[index]=setTimeout(function(){ilostQ(_self).find('ul:eq(0)').slideUp(200);},200);});});
  
  /* Search placeholder */
  if(!('placeholder' in document.createElement('input'))){
  $searchs.focus(function(){if(ilostQ(this).val()=='Search blog...'){
    ilostQ(this).css({color:'#666'}).val('');
  }}).blur(function(){
    if(ilostQ(this).val()==''){ilostQ(this).css({color:'#aaa'}).val('Search blog...');}
  });
  ilostQ(function(){if($searchs.val()=='' || $searchs.val()=='Search blog...'){$searchs.css({color:'#999'}).val('Search blog...');}});
  }
  /* comments first */
  ilostQ('#comments ul.children li:first-child').addClass('toprep');
  ilostQ('#comments ul.children li:last-child').after('<li class="box-bottom"><span class="left"></span><span class="right"></span></li>');
  
  /* Storage Remember Me */
  if(Storage.ilostQ_commentform_author){$username.val(Storage.ilostQ_commentform_author);}
  if(Storage.ilostQ_commentform_author){$usermaill.val(Storage.ilostQ_commentform_email);}
  if(Storage.ilostQ_commentform_author){$userurl.val(Storage.ilostQ_commentform_url);}
  $username.blur(function(){Storage.ilostQ_commentform_author=ilostQ(this).val();});
  $usermaill.blur(function(){Storage.ilostQ_commentform_email=ilostQ(this).val();});
  $userurl.blur(function(){Storage.ilostQ_commentform_url=ilostQ(this).val();});
  
  /* target _blank *//*
  ilostQ("section .entry a[href*='http://']:not([href*='"+location.hostname+"']),[href*='https://']:not([href*='"+location.hostname+"'])").attr('target','_blank');
  
  /* sidehome Collapse */
  ilostQ('#sidehome li ul').hide();
  ilostQ('#sidehome li ul:first').show();
  ilostQ('#sidehome h3:first').addClass('active');
  ilostQ('#sidehome h3').click(function(){
    if(ilostQ(this).next().is(':hidden')){
      ilostQ('#sidehome h3').removeClass('active');
      ilostQ('#sidehome li ul').slideUp();
      ilostQ(this).next().slideDown();
      ilostQ(this).addClass('active');	
    }
  });
  /* Ajax Load article  */
  /*
  ilostQ('body.blog #container article section .title a').click(function(e){
    var $url=ilostQ(this).attr('href');
    ilostQ('#container').load($url+' #container');
  });*/
});
/*
$document.ajaxStart(function(){
  //$(".log").text("Triggered ajaxStart handler.");
});$document.ajaxStop(function(){
  //$(".log").text("Triggered ajaxStop handler.");
});$document.ajaxComplete(function(){
  //$(".log").text("Triggered ajaxComplete handler.");
});*/
$window.load(function(){
  var gotop=ilostQ('#gotop'),share=ilostQ('#share'),$article=ilostQ('article');
  if(share.length>0)var share0ffset=share.offset();
  $window.scroll(function(){
    gotopbutton(gotop);
    sharefixed(share,share0ffset);
  });
})
function gotopbutton(id){if(id.length>0){if($document.scrollTop()>=128){id.fadeIn(200);}else{id.fadeOut(200);}}}
function sharefixed(id,offset){
  if(id.length>0){
    if(ilostQ('#wpadminbar').length>0){var idtop=offset.top-ilostQ('#wpadminbar').height()-3;
    }else{var idtop=offset.top;}
    if($document.scrollTop()>idtop){
      id.addClass('fixedpop').css({top:function(index,value){
        if(ilostQ('#wpadminbar').length>0){value=ilostQ('#wpadminbar').height()+3;}else{value=0;}
        return value;
      }
    });
    }else{id.removeClass('fixedpop').css({bottom:'auto'});}
  }
}
});})(jQuery);