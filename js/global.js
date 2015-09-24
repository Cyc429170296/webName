var global = {
	init : function(){
		//this.checkCookie();
		this.pos();
		this.loadEvnt();
	},
	/*getCookie : function(c_name){
		if (document.cookie.length > 0){
			c_start = document.cookie.indexOf(c_name + "=")
			if (c_start != -1){ 
				c_start = c_start + c_name.length + 1 
				c_end = document.cookie.indexOf(";",c_start)
				if (c_end == -1) c_end = document.cookie.length
				return unescape(document.cookie.substring(c_start,c_end))
			} 
		}
		return ""
	},
	setCookie : function(c_name,value,expiredays){
		var exdate = new Date()
		exdate.setDate(exdate.getDate() + expiredays)
		document.cookie = c_name + "=" + escape(value)+
		((expiredays == null) ? "" : ";expires=" + exdate.toGMTString())
	},
	checkCookie : function(){
		var index = this.getCookie('index');
		if (!index){
			index = 0;
		};
		$('.nav a').eq(index).addClass('cu');
	},*/
	pos : function(){
		var search = window.location.search;
		var mid = search ? search.substr(search.indexOf('m=') + 2,1) : 0;
		$('.nav a').eq(mid).addClass('cu');
	},
	loadEvnt : function(){
		/*var _this = this;
		$('.nav a').click(function(){
			_this.setCookie('index',$(this).parent().index());
		})*/
		/*鼠标移过，左右按钮显示*/
		jQuery(".banner").hover(function(){ jQuery(this).find(".prev,.next").stop(true,true).fadeTo("show",0.2) },function(){ jQuery(this).find(".prev,.next").fadeOut() });
		/*SuperSlide图片切换*/
		jQuery(".banner").slide({ mainCell:".pics",effect:"fold", autoPlay:true, delayTime:600, trigger:"click"});
	
		/*index prolist 滚动*/
		jQuery('.picMarquee').slide({mainCell:"ul.picList",autoPlay:true,effect:"leftMarquee",vis:5,interTime:50});
		
		$('#left_nav h2').each(function(){
			next = $(this).next();
			var _height = next.height();
			console.log(_height)
			if(!next.parent().hasClass('active')){
				next.height(0);
			}
			$(this).click(function(){
				next = $(this).next();
				if(next.is(':hidden')){
					$('#left_nav .ej').stop().animate({
						height : 0
					},300,function(){
						$(this).css({'display':'none','overflow':'hidden'})
					})
					next.stop().css({'display':'block','height':0,'overflow':'visible'}).animate({
						height : _height
					},300)
				}else{
					next.stop().animate({height : 0},300,function(){
						$(this).css({'display':'none','overflow':'hidden'})
					})
				}
			})
		})
	}
}
global.init();





