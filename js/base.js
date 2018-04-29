
// 表单样式生效
layui.use('form', function(){
  var form = layui.form;
});
layui.use('layer', function(){ //独立版的layer无需执行这一句
	//弹出框样式
	var modelNotice = '\
		<form class="layui-form user-info-form">\
		\
		\	<div class="layui-form-item">\
				<label class="layui-form-label user-info-label">头像：</label>\
				<div >\
					<img class="user-info-img" src="../image/user.jpg" alt="头像" />\
				</div>\
                <label title="上传图片" for="chooseImg" class="user-info-chooseImg-btn">\
                    <input type="file" accept="image/jpg,image/jpeg,image/png" name="file" id="chooseImg" class="hidden" onchange="selectImg(this)">\
                </label>\
		  	</div>\
		  	\
			<div class="layui-form-item">\
				<label class="layui-form-label user-info-label">用户名：</label>\
				<div class="layui-input-inline">\
					<input type="text" name="username" id = "username" value="linge" lay-verify="required" placeholder="请输入用户名" autocomplete="off"class="layui-input">\
					<script>\
					//document.getElementById("username").value="Hello World";\
	                </script>\
				</div>\
		  	</div>\
		  	\
			<div class="layui-form-item">\
				<label class="layui-form-label user-info-label">性别：</label>\
				\
				<div class="layui-input-block">\
				\
					<input type="radio" name="sex" value="男" title="男" checked="">\
					<div class="layui-unselect layui-form-radio layui-form-radioed">\
						<i class="layui-anim layui-icon layui-anim-scaleSpring"></i>\
						<div>男</div>\
					</div>\
					\
					<input type="radio" name="sex" value="女" title="女">\
					\<div class="layui-unselect layui-form-radio ">\
						<i class="layui-anim layui-icon"></i>\
						<div>女</div>\
					</div>\
					\
					<input type="radio" name="sex" value="保密" title="保密">\
					\<div class="layui-unselect layui-form-radio ">\
						<i class="layui-anim layui-icon"></i>\
						<div>保密</div>\
					</div>\
					\
				</div>\
			</div>\
			\
			<div class="layui-form-item layui-form-text">\
				<label class="layui-form-label user-info-label">个性签名：</label>\
				<div class="layui-input-block user-info-sign">\
				  <textarea placeholder="请输入内容" value="" class="layui-textarea"></textarea>\
				</div>\
			</div>\
		</form>';


  //触发事件
  var active = {
    
    notice: function(){
      layer.open({
        type: 1
        ,title: '个人信息' //不显示标题栏
        ,closeBtn: false
        ,area: '500px;'
        ,shade: 0.8
        ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
        ,btn: ['确认', '取消']
        ,btnAlign: 'c'
        ,moveType: 1 //拖拽模式，0或者1
        ,content: modelNotice
        ,success: function(layero){
          var btn = layero.find('.layui-layer-btn');
          btn.find('.layui-layer-btn0').attr({
            href: '#'
            ,target: '_blank'
          });
        }
      });
    }
    
  };
  
  $('#userModel .user-model-ipt').on('click', function(){
    var othis = $(this), method = othis.data('method');
    active[method] ? active[method].call(this, othis) : '';
  });
  
});