global = {
	init : function(){
		this.pos();
		this.hig();
		this.event();
	},
	event : function(){
		$('.file').change(function(){
			$(this).prev().prev().val(this.value);
		})

		/*内容列表页*/
		$('.content_list_sel').change(function(){
			url = document.location.href;
			str = url.indexOf('&');
			if(str < 0){
				document.location.href = url + '&p=' + this.value;
			}else{
				document.location.href = url.substring(0,str) + '&p=' + this.value;
			}
		})
	},
	pos : function(){
		url = document.location.href;
		str = url.indexOf('m=');
		if(str > 0){
			str = document.location.search.substring(1);
			arr = str.split('&');
			obj = {};
			for(var i in arr){
				str_arr = arr[i].split('=');
				obj[str_arr[0]] = str_arr[1];
			}
			$('.nav a').each(function(){
				if($(this).attr('href').indexOf(obj['m']) > 0){
					$(this).addClass('selected');
					return false;
				}
			})
			num = url.indexOf('menu') > 0 ? 0 : 1;
		}else{
			$('.nav a').eq(0).addClass('selected');
			str = document.location.search;
			if(str){
				num = str.substr(-1) - 1;
			}else{
				str = url.substr(-8);
				$('#sidebar a').each(function(){
					if($(this).attr('href').indexOf(str) > 0){
						$(this).parent().addClass('selected');
						return false;
					}
				})
				return;
			}
		}
		$('#sidebar dd').eq(num).addClass('selected')
	},
	tip : function(msg){
		$('.infos_box').empty().show().append(msg).delay(1000).fadeOut();
	},
	hig : function(){
		sidebar_hig = $('#sidebar').outerHeight();
		main_hig = $('#main').outerHeight();
		wid_hig = $(window).height() - 100;
		if(main_hig < wid_hig){
			if(sidebar_hig < wid_hig){
				$('#sidebar').height(wid_hig);
			}
		}else if(sidebar_hig < main_hig){
			$('#sidebar').height(main_hig + 100)
		}
	}



}
global.init();