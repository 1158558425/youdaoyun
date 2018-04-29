<?php
session_start();
header("Content-type:text/html;charset=utf-8");
$link = mysqli_connect('localhost','root','123456','webnote');
if (!$link) {
    die("连接失败:".mysqli_connect_error());
}
$username=$_SESSION['username'];
$oldpassword=md5($_POST['oldpassword']);
$newpassword=md5($_POST['newpassword']);
$sql_select="select id,username,password from user where username= ?";      //从数据库查询信息
$stmt=mysqli_prepare($link,$sql_select);
mysqli_stmt_bind_param($stmt,'s',$username);
mysqli_stmt_execute($stmt);
$result=mysqli_stmt_get_result($stmt);
$rows=mysqli_fetch_assoc($result);
if($rows){

    if($username == $rows["username"] && $oldpassword == $rows["password"]){
        $sql = "UPDATE  user SET password='{$newpassword}' where username='{$username}'";
        if(!(mysqli_query($link,$sql))){
            echo "<script>alert('数据插入失败');window.location.href='accountSet.html'</script>";
        }else{echo "<script>alert('更改成功！去登陆！');window.location.href='login.html'</script>";}
    }
    else{
        echo "<script>alert('原密码错误！');history.back(-1);</script>";
    }
}
else{
    echo "<script>alert('您输入的用户名不存在!');location.href='accountSet.html'</script>";
    exit;
};
?>