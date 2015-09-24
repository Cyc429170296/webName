$(function(){
	//系统设置
	$('.list_num').each(function(){
		var val= this.value;
		$(this).blur(function(){
			if(isNaN(this.value) || this.value < 0){
				this.value = val;
			}else{
				this.value = parseInt(this.value);
				val = this.value;
			}
		})
	})
	
	//更新用户信息
	$('.update').click(function(){
		obj = {id : $(this).parents('tr').eq(0).index()};
		common(this,obj,'admin.php?action=2')
	})
	//更新模板
	$('.module_update').live('click',function(){
		//parent = $(this).parents('tr').eq(0);
		//prev_val = parent.find('input[name=module_name]').val();
		obj = {mid : $(this).parents('tr').eq(0).attr('mid')};
		common(this,obj,'module.php?action=update'/*,function(_this){
			$('.nav a').each(function(){console.log('prev_val' + prev_val);
				if(this.innerHTML == prev_val){console.log('html' + this.innerHTML);
					this.innerHTML = $(_this).parents('tr').eq(0).find('input[name=module_name]').val();
					return false;
				}
			})
		}*/);
	})
	//删除模板
	$('.module_del').live('click',function(){
		parent = $(this).parents('tr').eq(0);
		$.ajax({
			url :'module.php?action=delete',
			type : 'post',
			dataType : 'text',
			data : {send : true,mid : parent.attr('mid')},
			success : function(msg){
				html = parent.find('input[name=module_name]').val();
				$('.nav a').each(function(){
					if(this.innerHTML == html){
						$(this).parent().remove();
						return false;
					}
				})
				parent.remove();
				global.tip('删除成功');
			},
			error : function(){
				global.tip('很遗憾,数据删除失败');
			}
		})
	})
	//添加模板
	$('.module_add').live('click',function(){
		common(this,{},'module.php?action=add',function(_this,msg){
			parent = $(_this).parents('tr').eq(0);
			parent.attr('mid',msg);
			parent.find('td:first').html(msg);
			$('.nav').append('<li><a href="menu.php?m=' + msg + '">' + parent.find('input[name=module_name]').val() + '</a></li>');
			_html = "<a class='module_update' href='javascript:void(0)'>提交修改</a> ";
			_html += "<a class='module_del' href='javascript:void(0)'>删除</a>"
			$(_this).parent().empty().html(_html)
		})
	})
	$('.add_module').click(function(){
		html = "<tr mid=''>";
		html += "<td></td>";
		html += "<td><input type='text' name='module_name' class='text' value='' /></td>";
		html += "<td><input type='text' name='module_tpl' class='text' value='' /></td>";
		html += "<td><input type='text' name='module_det' class='text' value='' /></td>";
		html += "<td><input type='text' name='param1' class='text' value='' /></td>";
		html += "<td><input type='text' name='param2' class='text' value='' /></td>";
		html += "<td><input type='text' name='param3' class='text' value='' /></td>";
		html += "<td><input type='text' name='module_same' class='text' value='' /></td>";
		html += "<td><a class='module_add' href='javascript:void(0)'>增加模板</a> <a class='cancel' href='javascript:void(0)'>取消</a></td>";
		html += "</tr>";
		$('.module_table').append(html);
		global.hig();
	})
	
	//取消
	$('.cancel').live('click',function(){
		$(this).parents('tr').eq(0).remove();
	})
	
	var common = function(_this,obj,url,fn){
		input = $(_this).parents('tr').eq(0).find('input');
		num = 0;
		len = input.length;
		input.each(function(i,n){
			if(!this.value){
				num++;
			}
			obj[this.name] = this.value;
		})
		if(num == len){
			if(!confirm('当前的的信息为空,你确定要修改?')){
				return;
			}
		}
		$.ajax({
			url : url,
			type : 'post',
			dataType : 'text',
			data : {send : true,user_info : obj},
			success : function(msg){
				if(msg){
					global.tip('数据操作成功');
					if(typeof(fn) != 'undefined'){
						fn(_this,msg);
					}
				}else{
					global.tip('很遗憾,数据操作失败');
				}
			},
			error : function(){alert('cuowu');
				global.tip('很遗憾,数据操作失败');
			}
		})
	}
	
	/*轮播*/
	$('.banner_sel').change(function(){
		_this = this;
		$.ajax({
			url : 'admin.php?action=3',
			type : 'post',
			dataType : 'json',
			data : {id : this.value},
			success : function(msg){
				$('.banner_id').val(_this.value);
				$('.banner_img').attr('src','../upload/' + msg['banner_src']);
				$('.title').val(msg['title']);
				$('.recom').val(msg['recom']);
				parseInt(msg['recom']) ? $('.recom')[0].checked = true : $('.recom')[0].checked = false;
				$('.txt').eq(1).val(msg['banner_src']);
				$('.del_img').val(msg['banner_src']);
			},
			error : function(){
				global.tip('很遗憾,数据加载失败');
			}

		})
	})
	var banner_sel = $('.banner_sel');
	if(banner_sel[0]){
		banner_sel[0].selectedIndex = parseInt($('.banner_id').val()) - 1;
	}
	/*recom = $('.recom');
	if(parseInt(recom.val())){
		recom[0].checked = true;
	}
	recom.change(function(){
		this.value = this.checked ? 1 : 0;
	})*/
})