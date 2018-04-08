<script>
function switchHide(n)
{
if(n==1)
{
//document.getElementById('tr1').style.display = '';
$("#tr1").hide();
var trs = $("tr[class='hid']");
trs[0].style.display = "none";
}
if(n==2)
//document.getElementById('tr1').style.display = 'none';
}
}
</script>
<?php
require_once 'db.php';
session_start();

 if(!isset($_SESSION['user_id'])){
 	header('Location: '."login.php");
 	exit();
 }


$positon = $_GET['id'];

if($_SESSION['user_id']!=$_GET['id'])
{
	echo "<script> switchHide(1);</script>";
}
else
{
	echo "<script> switchHide(2);</script>";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">



<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>
 
<body>
<table style="margin:100px auto" width="650" cellpadding="5" cellspacing="0" border="1">
  <tr>
    <td width="121" height="30" valign="middle">用户ID：</td>
    <td height="30" valign="middle"><?php echo $_SESSION['user_id']; ?></td>
  </tr>
  <tr id="tr1" style="display:" class='hid'>
    <td height="30" valign="middle">密码：</td>
    <td height="30" valign="middle">********</td>
  </tr>
  <tr>
    <td height="30" valign="middle">昵称：</td>
    <td height="30" valign="middle"><?php echo $_SESSION['nickname']; ?></td>
  </tr>
  <tr>
  	<td height="30" valign="middle">返回主页</td>
  	<td height="30" valign="middle"><input type="button" value="点击这里" onclick="location='index.php'"></td>

  </tr>
<!--  <tr>
    <td height="30" valign="middle">靓照上传：</td>
    <td height="30" valign="middle"><input type="file" /></td>
  </tr>
  <tr>
    <td height="30" valign="middle">性        别：</td>
    <td height="30" valign="middle"><input type="radio" name="sex" id="man" checked="checked" /><label for="man">男</label>
    <input type="radio" name="sex" id="women" /><label for="women">女</label></td>
  </tr>
  <tr>
    <td height="30" valign="middle">生        日：</td>
    <td height="30" valign="middle"><input type="text" size="5" />
     年 
    <select>
      <option selected="selected">选择</option>
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
      <option>6</option>
      <option>7</option>
      <option>8</option>
      <option>9</option>
      <option>10</option>
      <option>11</option>
      <option>12</option>
    </select>
     月 
    <input type="text" size="5" />
     日</td>
  </tr>
  <tr>
    <td height="30" valign="middle">爱        好：</td>
    <td height="30" valign="middle"><input type="checkbox" id="Basketball" /><label for="Basketball">篮球</label> 
    <input type="checkbox" id="Badminton" /><label for="Badminton">羽毛球</label> 
    <input type="checkbox" id="tennis" /><label for="tennis">乒乓球</label> </td>
  </tr>
  <tr>
    <td height="30" valign="top">备注信息：</td>
    <td height="30" valign="middle"><textarea style="width:500px; padding:5px; height:400px;">的若干规定郭德纲</textarea></td>
  </tr>
  <tr>
    <td height="30" valign="middle">图片展示：</td>
    <td height="30" valign="middle"><img src="logo.jpg" width="500" /></td>
  </tr>-->
</table>
 

</body>
</html>
