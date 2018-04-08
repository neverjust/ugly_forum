<?php

require_once 'db.php';
session_start();

$error_id = "";
$error_pwd = "";
$error_nick = "";



$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

if (!$dbc)
{
	echo "连接数据库失败";
}

if(empty($_POST['uid']))
{
	$error_id = "用户名不能为空";
}
elseif(empty($_POST['pwd']))
{
	$error_pwd = "密码不能为空";
}
elseif(empty($_POST['nick_name']))
{
	$error_nick = "昵称不能为空";
}

else
{
	$pwd = sha1($_POST['pwd']);
	$id = $_POST['uid'];
	$nick_name = $_POST['nick_name'];
	$q = "SELECT * FROM log WHERE id='$id'";
	$check_query = mysqli_query($dsc,$q);
	if($check_query==false)
	{
		echo "222";
 		$query = "INSERT INTO log (id,password,nickname) VALUES ('$id','$pwd','$nick_name')";

		$retval = mysqli_query($dbc,$query);

		if(!$retval)
		{
			die('无法插入数据: ' . mysqli_error($conn));
		}
		else
		{
			echo "<script>alert('恭喜你，注册成功！');location.href='login.php';</script>";
		}
	}
	elseif($check_query==true)
	{
		$error_id =  '用户名 '.$id.' 已存在';
	}
 	
}

?>


<html>
<head>
<title>无标题文档</title>
</head>

<body>
<div style="background-color:#CCC; width:300px; padding-left:10px;">
<h1>注册页面</h1>
<form action="register.php" method="post" accept-charset="utf-8">

<label for="username">用户名</label>
<input type="text" id="uid" name="uid" value="<?php if(!empty($id)) echo $id; ?>" placeholder="请输入用户名" /><?php echo $error_id ?><br />

<label for="username">密&nbsp;&nbsp;&nbsp;码</label>
<input type="text" name="pwd" id="pwd" value="" placeholder="请输入密码" /><?php echo $error_pwd ?><br />

<label for="username">昵&nbsp;&nbsp;&nbsp;称</label>
<input type="text" name="nick_name" value="" placeholder="请输入昵称" /><?php echo $error_nick ?><br />
<!--<div>性&nbsp;&nbsp;别：<input type="radio" checked="checked" name="sex" id="nan" value="true" />男&nbsp;<input type="radio" name="sex" value="false" />女</div><br />
<div>生&nbsp;&nbsp;日：<input type="text" id="birthday" /></div><br />
<div>工&nbsp;&nbsp;号：<input type="text" id="code" /></div><br /> -->
<div><input type="submit" value="提交" name="submit" id="submit" />&nbsp;&nbsp;&nbsp;</div><br />
</form>
</div>

</body>
</html>