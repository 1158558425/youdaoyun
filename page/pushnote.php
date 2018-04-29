<?php
session_start();
header("Content-type:text/html;charset=utf-8");
$link = mysqli_connect('localhost','root','123456','webnote');
if (!$link) {
    die("连接失败:".mysqli_connect_error());
}
$username=$_SESSION['username'];
$content=$_POST['content'];
$title=$_POST['title'];
if(!(isset($_SESSION['logined']) && $_SESSION['logined'])){
    //$_SESSION['logined']有设置，并且值为真，表示已经登录
    echo "<script>alert('同志，未登陆！');location.href='login.html'</script>";
    exit;
}
$sql = "insert into note (note_id,username,title,content,lastdate)
      values ('','$username','$title','$content',now())";
if(!(mysqli_query($link,$sql))){
    echo "<script>alert('保存失败');</script>";
}else{echo "<script>alert('保存成功');location.href='main.php'</script>";}
//header('HTTP/1.1 204 No Content');//调用http的204特性达到类似与ajax页面不刷新提交效果