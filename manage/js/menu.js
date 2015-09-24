$(function(){
	/*提交和修改*/
	$('.update').live('click',function(){
		_this = $(this);
		parent = _this.parents('tr').eq(0);
		if(_this.hasClass('dis')){
			dom_hide(parent);
			$(this).html('提交').removeClass('dis')
			$('.cancel',parent).removeClass('disabled');
			prev_val = parent.find('.menu_input').val();
			return false;
		}else{
			val = parent.find('.menu_input').val();
			if(val){
				$.ajax({
					url : 'menu.php?action=update&p=' + $(this).attr('pid'),
					dataType : 'text',
					type : 'post',
					data : {'menu_name' : val},
					success : function(){
						$('.cancel',parent).addClass('disabled');
						span = parent.find('span:last');
						span.html(val);
						if(span.hasClass('fir_nemu')){
							$('.menu_sec_table .fir_nemu').each(function(i,n){
								if(prev_val == this.innerHTML){
									this.innerHTML = val;
								}
							})
							$('.sel option').each(function(){
								if(prev_val == $(this).text()){
									$(this).text(val);
								}
							})
						}
						dom_show(parent);
					},
					error:function(){
						alert('数据更新失败，请重试');
					}
				})
			}else{
				parent.find('.menu_input').val(prev_val);
				dom_show(parent);
			}
		}
	})

	
	var dom_hide = function(parent){
		for(var i = 3 ;i > 1;i--){
			var td = parent.find('td').eq(i),
			span = td.find('span');
			if(span[0]){
				if(td.find('input')[0]){
					td.find('input').show();
				}else{
					td.append('<input class="menu_input" type="text" value=' + span.html() + '>')
				}
				span.hide();
				break;
			}
		}
	}
	var dom_show = function(parent){
		for(var i = 3 ;i > 1;i--){
			var td = parent.find('td').eq(i),
			span = td.find('span');
			if(span[0]){
				if(td.find('input')[0]){
					td.find('input').hide();
				}
				span.show();
				break;
			}
		}
		$('.update',parent).html('修改').addClass('dis')
	}
	/*取消*/
	$('.cancel').live('click',function(){
		dom_show($(this).parents('tr').eq(0))
		$(this).addClass('disabled');
	})
	/*删除*/
	$('.del').live('click',function(){
		_this = this;
		$.ajax({
			url : 'menu.php?action=delete&p=' + $(this).attr('pid'),
			dataType : 'text',
			type : 'post',
			success : function(){
				parent = $(_this).parents('tr').eq(0);
				val = parent.find('span:last').html();
				parent.remove();
				if(parent.find('span:last').hasClass('fir_nemu')){
					$('.menu_sec_table .fir_nemu').each(function(i,n){
						if(val == this.innerHTML){
							$(this).parents('tr').remove();
						}
					})
					
					$('.sel option').each(function(){
						if(val == $(this).text()){
							$(this).remove();
						}
					})
					/*if($('.sel option').length <= 1){
						$('.add_sec_menu').addClass('disabled');
					}*/
				}
			},
			error:function(){
				alert('数据删除失败，请重试');
			}
		})
	})
	/*二级栏目下拉ajax*/
	$('.menu_list_sel').change(function(){
		/*if(!parseInt(this.value)){
			$('.add_sec_menu').addClass('disabled');
		}else{
			$('.add_sec_menu').removeClass('disabled');
		}*/
		_this = this;
		$.ajax({
			url : 'menu.php?action=show&m=' + $(this).attr('mid') + '&p=' + $(this).val(),
			dataType : 'json',
			type : 'post',
			success : function(msg){
				data = msg.data;
				table = $('.menu_list_table');
				table.empty();
				str = "<tr><th width='120'>编号</th><th width='180'>所属栏目</th><th width='180'>一级栏目</th><th width='180'>二级栏目</th><th width='180'>操作</th></tr>"
				if(data.length){
					for(i in data){
						str += "<tr>";
						str += "<td>" + data[i].pid + "</td><td>所属栏目</td>";
						str += "<td><span class='fir_nemu'>" + data[i].fir_nemu + "</span></td>";
						str += "<td><span class='sec_nemu'>" + data[i].sec_nemu + "</span></td>";
						str += "<td><a class='update dis' href='javascript:void(0)' pid=" + data[i].pid + ">修改</a> | <a class='del' href='javascript:void(0)' pid=" + data[i].pid + " onclick=\"return confirm('你真的要删除这个栏目吗？') ? true : false\">删除</a> |<a class='cancel disabled' href='javascript:void(0)'>取消</a></td>";
						str += "</tr>";
					}
				}else{
					str += "<tr><td colspan='5'>当前栏目没有子栏目</td></tr>";
				}
				table.append(str);
				global.hig();
			},
			error : function(){
				global.tip('数据加载失败，请重试');
			}
		})
	});
	/*二级栏目按钮*/
	/*$('.add_sec_menu').click(function(){
		if($(this).hasClass('disabled')){
			return;
		}
		document.location.href = 'menu.php?action=add&m=' + $(this).attr('mid') + '&p=' + $('.sel').val()
	});*/

	/*添加二级栏目*/
	(function(){
		if($('.hid')[0]){
			val = $('.hid').val();
			$('.menu_sel option').each(function(i,n){
				if(n.value == val){
					n.selected = true;
					return false;
				}
			})
		}
		$('.menu_add_sel').change(function(){
			val = this.value;
			text = this.options[this.selectedIndex].text;
			$('.hid').val(val);
			$('.fir_nemu').each(function(i,n){
				n.innerHTML = text;
			})
		})
	})();	
})