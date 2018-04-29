<?php
session_start();
unset($_SESSION['logined']);
unset($_SESSION['username']);
echo "<script>alert('log-out!');location.href='login.html'</script>";