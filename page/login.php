<?php
session_start();
header("Content-type:text/html;charset=utf-8");
$link = mysqli_connect('localhost','root','123456','webnote');  //链接数据库
mysqli_set_charset($link ,'utf8'); //设定字符集
$username=$_POST['username'];
$password=md5($_POST['password']);
$yzm=$_POST['yzm'];


if($username==""){
    echo "<script>alert('请输入用户名！');window.history.back(-1);</script>";
    exit;
}
if($password==''){

    echo "<script>alert('请输入密码！');window.history.back(-1);</script>";
    exit;

}
if($yzm!=$_SESSION['authcode']){

    echo"<script>alert('你的验证码不正确，请重新输入！');window.history.back(-1);</script>";
    exit;

}
$sql_select="select id,username,password from user where username= ?";      //从数据库查询信息
$stmt=mysqli_prepare($link,$sql_select);
mysqli_stmt_bind_param($stmt,'s',$username);
mysqli_stmt_execute($stmt);
$result=mysqli_stmt_get_result($stmt);
$rows=mysqli_fetch_assoc($result);

if($rows){

    if($username == $rows["username"] && $password == $rows["password"]){
        $_SESSION['logined']=1;   //判断是否已经登录的依据。
        $_SESSION['username']=$username;
        echo "<script>alert('登陆成功！');location.href='main.php'</script>";

    }
    else{
        echo "<script>alert('用户名或密码错误！');window.history.back(-1);</script>";
    }
}
else{
    echo "<script>alert('您输入的用户名不存在!');window.history.back(-1);</script>";
    exit;
};
