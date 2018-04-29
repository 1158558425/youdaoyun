<?php
session_start();
header("Content-type:text/html;charset=utf-8");
$link = mysqli_connect('localhost','root','123456','webnote');
if (!$link) {
    die("连接失败:".mysqli_connect_error());
}

$username=$_POST['username'];
$password=md5($_POST['password']);
$passwordconfirm=md5($_POST['passwordconfirm']);
//$yzm=$_POST['yzm'];
$email=$_POST['email'];
$sex = $_POST['sex'];
$qianming = $_POST['qianming'];
//$regtime = time();
//$token = md5($username.$password.$regtime); //创建用于激活识别码
//$token_exptime = time()+60*60*24;//过期时间为24小时后
if($username == "" || $password == "" || $passwordconfirm == "" || $email == "" /*|| $yzm == ""*/)
{
    echo "<script>alert('信息不能为空！重新填写');window.history.go(-1);</script>";
} elseif ((strlen($username) < 4)||(!preg_match('/^\w+$/i', $username))) {
    echo "<script>alert('用户名至少3位!且不含非法字符！重新填写');window.history.go(-1);</script>";
    //判断用户名长度
} elseif($password != $passwordconfirm) {
    echo "<script>alert('两次密码不相同！重新填写');window.history.go(-1);</script>";
    //检测两次输入密码是否相同
} elseif (!preg_match('/^[\w\.]+@\w+\.\w+$/i', $email)) {
    echo "<script>alert('邮箱不合法！重新填写');window.history.go(-1);</script>";
    //判断邮箱格式是否合法
}elseif(mysqli_fetch_array(mysqli_query($link,"select * from user where username = '$username'"))){
    echo "<script>alert('用户名已存在');window.history.go(-1);</script>";
}else{
      $sql = "insert into `user` (`username`,`password`,`email`,`sex`,`qianming`)
      values ('$username','$password','$email','$sex','$qianming')";
       if(!(mysqli_query($link,$sql))){
        echo "<script>alert('数据插入失败');window.history.go(-1);</script>";
      }else{echo "<script>alert('注册成功！去登陆！');window.location.href='login.html'</script>";}
}
?>
