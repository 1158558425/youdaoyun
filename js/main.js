
/*************
富文本使用
**************/
var E = window.wangEditor
var editor = new E('#editorToolbar', '#editorText')
// 或者 var editor = new E( document.getElementById('editor') )
var $text1 = $('#text1')
editor.customConfig.onchange = function (html) {
    // 监控变化，同步更新到 textarq
    $text1.val(html)
}
/*editor.customConfig.onchange = function (html) {
    // html 即变化之后的内容
    console.log(html)
}*/
editor.customConfig.uploadImgShowBase64 = true
editor.create()
$text1.val(editor.txt.html())

/*document.getElementById('btn1').addEventListener('click', function () {
    // 如果未配置 editor.customConfig.onchange，则 editor.change 为 undefined
    editor.change && editor.change()
})*/

/****************
封装 folder 滑入滑出函数
****************/
var $ipt_main__sidebar_ipt = $('#main_sidebar_slideipt')
var $less_main_sidebar = $('#main_sidebar')
var icon_class_arr = ['am-icon-caret-left', 'am-icon-caret-right']
folderSlideFun($ipt_main__sidebar_ipt, $less_main_sidebar, icon_class_arr)

/*
 *$ipt 操作侧边栏的按钮，要求扩张的模块元素是距离按钮最近的section元素
 *$less 改变状态的侧边栏
 *iconClassArr 按钮中图标的两个class值数组，第一个数组元素为起始图标，第二个为改变图标
*/
function folderSlideFun($ipt, $less, iconClassArr){
    var $expand = $ipt.closest('section')
    var $expand_left = $expand.css('left')

    var $less_form = $less.find('form')
    var $less_width = $less.width()

    var icon_class1 = iconClassArr[0]
    var icon_class2 = iconClassArr[1]
	
	$ipt.on('click.slide', function(event) {
		if(parseInt($less.css('width')) != 0){
			$less_form.hide()
			$less.animate({width: 0},200)
			$expand.animate({left: 0},200,function(){
				$ipt.find('.'+icon_class1)
				 	.removeClass(icon_class1)
					.addClass(icon_class2)
			})
		}else{
			$less.animate({width: $less_width},200,function(){
				$less_form.show()
			})
			$expand.animate({left: $expand_left},200,function(){
				$ipt.find('.'+icon_class2)
					.removeClass(icon_class2)
					.addClass(icon_class1)
			})

		}		
	})
}

//JavaScript代码区域
layui.use('element', function(){
    var element = layui.element;
 });

// 我的文件 开合效果
    var ipt = document.getElementById('myFile')
    showMyfile(ipt)
    function showMyfile(ipt) {
        $(ipt).data('flag',0)
        $(ipt).click(function (event) {
            console.log($(this).data('flag'))
            if($(this).data('flag') == 0){
                $(this).next().slideUp()
                $(this).data('flag',1)
            }else{
                $(this).next().slideDown()
                $(this).data('flag',0)
            }

        })
    }

//
$('#middle-content-collection').click(function(event) {
    $(this).toggleClass('middle-content-collection');
})