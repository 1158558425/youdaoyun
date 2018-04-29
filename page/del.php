<?php
include 'conn.php';
$note_id = $_GET['note_id'];
$query="delete from note where note_id=".$note_id;
mysql_query($query);
?>
<?php
//页面跳转，实现方式为javascript
$url = "main.php";
echo "<script>";
echo "window.location.href='$url'";
echo "</script>";
?>