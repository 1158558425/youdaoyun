<!doctype html>
<html class="no-js">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- X-UA-Compatible是IE8的一个专有<meta>属性，它告诉IE8采用何种IE版本渲染网页,这里使用edge来渲染，提高兼容性 -->

        <meta name="description" content="低配版有道云笔记">
        <meta name="keywords" content="有道云">
        <!-- 添加网站描述，关键字等，便于搜索引擎优化 -->

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>低配版有道云笔记</title>

        <!-- 使用 amazeUI库 -->
        <!-- 所有的以 am- 开始的class值，都是该库提供的样式 -->
        <link rel="stylesheet" type="text/css" href="../css/module/amazeui.min.css">
        <!-- 使用 layui库 -->
        <link rel="stylesheet" type="text/css" href="../layui/css/layui.css">

        <!-- 抽取基本样式与复用样式，基本样式以 bs- 开头的class值 -->
        <link rel="stylesheet" type="text/css" href="../css/base.css">
        <link rel="stylesheet" type="text/css" href="../css/main.css">
        <link rel="stylesheet" type="text/css" href="../css/search.css">

    </head>
    <body>

    <!-- 复用组件样式全部抽取在base中，各部分解耦，不同页面根据需要选择性使用，可在本页面覆盖起始样式 -->
    <header class="header bs-header">
        <div class="bs-logo">
            <!-- 使用a标签的background引入logo，可以在基础样式中配置logo，使得logo与各个页面解耦 -->
            <a href="#"></a>
        </div>

        <div class="bs-header-nav">
            <div class="bs-header-nav-left">
                <a class="bs-header-nav-active" href="#">查找笔记</a>
            </div>
            <div class="bs-header-nav-right">
                <div id="userModel" class="bs-header-nav-right-userinfo am-dropdown" data-am-dropdown>
                </div>
            </div>
        </div>
    </header>
    <section class="main">
        <section id="main_show" class="main-show search-left">
            <form action="" method="get">
                <div class="main-show-file">
                    <div class="main-main-top">
                        <input class="note-select" type="text" name = "keywords" placeholder="搜索"/>
                        <input type="submit" class="layui-btn layui-btn-radius layui-btn-primary note-select-frame">
                    </div>
                        <?php
                         $keywords = isset($_GET['keywords']) ? trim($_GET['keywords']) : '';
                          $conn = @mysql_connect("localhost", "root", "123456") or die("数据库链接错误");
                          mysql_select_db("webnote", $conn);
                          mysql_query("set names 'utf8'"); //使用utf-8中文编码;
                           //PHP模糊查询
                           $sql="SELECT * FROM note WHERE content LIKE '%{$keywords}%'";
                           $rs= mysql_query($sql);
                           $users = array();//保存所以得查询到的用户
                           if(!empty($keywords)){
                            while ($row=mysql_fetch_assoc($rs)){
                            $row['content'];// = str_replace($keywords,'<font color="red">'.$keywords.'</font>',$row['content']);
                            $users[] = $row;
                             //$users[] =$row['content'] ;
                              }}
                            foreach ($users as $key=>$value){?>

                            <table class="middle-content-box">
                        <tr class="two-row" >
                            <td colspan="2" id="title1"class="middle-content-title">
                                <div onclick="my()" class="middle-content-img layui-btn layui-btn-normal layui-btn-sm">
                                    <i class="layui-icon"></i>
                                </div>
                                <?php echo $value['title'];?>
                            </td>
                        </tr>
                        <tr class="two-row middle-noteContent">
                            <td colspan="2" id="content1" class="middle-noteContent"><?php echo $value['content'];?></td>
                        </tr>
                        <tr class="two-row">
                            <td colspan="2" class="middle-content-time"><?php echo $value['lastdate'];?></td>
                        </tr>
                        <tr>
                            <td align="left" class="middle-content-edit">
                                <!-- <a onclick="my()"  >编辑</a> -->
                                <!--<button onclick="my()">点击这里</button>-->
                                <script type="text/javascript">
                                    function my(){
                                        var E = window.wangEditor
                                        var editor = new E('#editorToolbar', '#editorText')
                                        editor.create()
                                        //var $text = $('#content')
                                        var title = document.getElementById("title1").innerHTML
                                        title = title.slice(252)
                                        document.getElementById("title").value=title
                                        editor.txt.html(document.getElementById("content1").innerHTML)}
                                </script>
                            </td>
                            <td align="right">
                                <!-- 收藏 -->
                                <a id="middle-content-collection" class="middle-delAndCollect layui-btn layui-btn-normal layui-btn-sm">
                                    <i class="layui-icon"></i>
                                </a>
                                <!-- 删除 -->
                                <a href="del.php?note_id=<?php echo $value['note_id'];?>" class="middle-delAndCollect layui-btn layui-btn-normal layui-btn-sm">
                                    <i class="layui-icon"></i>
                                </a>
                            </td>
                        </tr>
                    </table>

                             <?php } ?>
                </div>
                <div class="drag-line main-file-line"></div>

			<div class="main-show-text">
				<div class="main-main-top">
					<top-title class="main-main-title">
						<input class="note-title" type="text" id="title" name = "title" placeholder="输入笔记标题"   maxlength="250" tabindex="-1" /><br>
					</top-title>

					<!--<button type="submit"  class="note-btn-submit am-btn am-btn-xl am-btn-primary">保存</button>-->
                    <a href="javascript:window.opener=null;window.open('','_self');window.close();"class="note-btn-submit am-btn am-btn-xl am-btn-primary">关闭</a>


				 </div>

				<div id="editorToolbar"></div>
    			<div id="editorText" style="width:100%;height: 100%;">
        			<p>欢迎使用 <b>没道云笔记</b> </p>
    			</div>
                <textarea id="text1" name="content" style="width:100%; height:200px;"></textarea>
            </div>
        </form>
    </section>

    </section>

    <!--
        js文件引入，放置位置在文档最后且body之前
        先引入库js文件，再引入页面js文件!!!
        如果有加载dom节点的js文件，可以放在前面
    -->
    <script src="../js/module/jquery.min.js"></script>
    <script src="../js/module/amazeui.min.js"></script>
    <script src="../layui/layui.js"></script>
    <!-- 引入富文本js文件,注意,只需要引用 JS 无需引用任何 CSS ！！！-->
    <script src="../js/module/wangEditor.min.js"></script>
    <script src="../js/module/cropper.min.js"></script>
    <script src="../js/base.js"></script>
    <script src="../js/main.js"></script>

    </body>
    </html>