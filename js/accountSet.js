layui.use('element', function(){
  var element = layui.element; //导航的hover效果、二级菜单等功能，需要依赖element模块
  
  //监听导航点击
  element.on('nav(demo)', function(elem){
    //console.log(elem)
    layer.msg(elem.text());
  });
});

//form切换 
var $ipts = $('.nav-show li a')
var $shows = $('.accountSet-form')
show($ipts,$shows)
function show($ipts,$shows){
	$ipts.click(function(event){
		$shows.hide()
		$($shows[$ipts.index($(this))]).show()
		event.preventDefault()
	});
}
