
<?php
/*if(!isset($_SERVER['HTTP_REFERER'])||$_SERVER['HTTP_REFERER']!='http://127.0.0.1/dashboard/a/login.php')
{
	header('Location: '.'login.php');
	echo $_SERVER['HTTP_REFERER'];
}*/

session_start();

 if(!isset($_SESSION['user_id'])){
 	header('Location: '."login.php");
 	exit();
 }






require_once('db.php');

$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

if (!$db) 
{
	die("无法连接数据库 ，错误信息：".mysql_error());
	exit(0);
}

$pagesize = 10;//设置每页显示条数 
$rs = "select * from xian";//取得记录总数，计算总页数用 
$count = $db->query($rs);
$numrows = mysqli_num_rows($count);//计算总记录 

$pages = intval($numrows/$pagesize); 
if($numrows%$pagesize)$pages++;//设置页数 
if(isset($_GET['page'])) 
    { 
        $page = intval($_GET['page']); 
    } 
    else 
    { 
        $page = 1;//设为第一页 
    } 
$offset = $pagesize*($page-1);//计算记录偏移量 
//分页代码结束 
$sql = "select cont,time,th,nickname from xian order by th desc limit $offset,$pagesize";//用到了DATE-FORMAT格式化日期格式 
$rows = [];

$result = $db->query($sql);
if ($result) 
{
	$num = mysqli_num_rows($result);
	while($row = $result->fetch_array(MYSQLI_ASSOC))
		$rows[] = $row;
}
else
	$num = 0;










/*$db->query("SET NAMES UTF8");
$searh = "SELECT * FROM xian";
$mysql_result = $db->query($searh);


if($mysql_result == false)
{
	echo "sql错误";
	exit(0);
}*
$rows = [];
while($row = $mysql_result->fetch_array(MYSQLI_ASSOC))
{
	$rows[] = $row;
}

$num = count($rows)
*/
?>






<!DOCTYPE html>
<head>
	<link rel="stylesheet" type="text/css" href="mystyle.css">
	<meta charset="utf-8">
	<title>留言板</title>
</head>
<body>
	<div style="background-color:#CCC; width:300px; padding-left:10px;position:relative;z-index:-1;">
	</div>
	<div align="right" class="user_data">
		<span class="user_name" text-align:right;>您的用户名为<?php echo $_SESSION['nickname']." "; ?></span>
		<br>
		<button class="bt" onclick="location='self.php?id=<?php echo $_SESSION['user_id'];?>'">个人主页</button>
		<br>
		<button class="bt" onclick="location='logout.php'">退出登录</button>&nbsp
	<div position:relative z-index:0>
	<h1 id="3">留言板</h1>	
	</div>
	

	<div position:relative z-index:1 id="g" align="center">
		<form action="index_response.php" method="post" accept-charset="utf-8">
			<textarea id="1" name="content" cols="50" rows='5'></textarea>
			<br>
			<input id="3" type="submit" align="right" class="btn" name="提交" value="提交信息">
		</form>
	</div>
	<?php
	foreach ($rows as $row) 
	{
	?>
		<div position:relative z-index:2 class="data">
			<br>
			<div id="content" style="background-color:#EEEEEE;height:100px;width:400px;"><?php echo '<span id="a" style="color:#696969 ; font-family: STXingkai">留言内容:</span>'.$row["cont"]; ?>   </div>
			<div id="footer" style="background-color:#FFA500;clear:both;width: 400px"><?php echo 
			'<span id="a" style="color:#696969 ; font-family: STXingkai">留言人:</span>'.$_SESSION['nickname']."       于 ".$row["time"] ?></div>
		</div>

	<?php	
	}
	?>
<br>
<div id="show_page" align="center"> 
<p> 
<?php 
$first=1; 
$prev=$page-1; 
$next=$page+1; 
$last=$pages; 
if($page==1&&$pages>1) 
{ 
    echo "首页 | "; 
    echo "上一页 | "; 
    echo "<a href=\"?page=".$next."\">下一页</a> | "; 
    echo "<a href=\"?page=".$last."\">尾页</a> | "; 
} 
elseif($page>=1&&$page!=$pages&&$num>0) 
{ 
    echo "<a href=\"?page=".$first."\">首页</a> | "; 
    echo "<a href=\"?page=".$prev."\">上一页</a> | "; 
    echo "<a href=\"?page=".$next."\">下一页</a> | "; 
    echo "<a href=\"?page=".$last."\">尾页</a> | "; 
} 
elseif($page==$pages&&$page!=1) 
{ 
    echo "<a href=\"?page=".$first."\">首页</a> | "; 
    echo "<a href=\"?page=".$prev."\">上一页</a> | "; 
    echo "下一页 | "; 
    echo "尾页 | "; 
} 
elseif($page==$pages) 
{ 
    echo "首页 | "; 
    echo "上一页 | "; 
    echo "下一页 | "; 
    echo "尾页 | ";     
} 
else 
{ 
    echo "首页 | "; 
    echo "上一页 | "; 
    echo "下一页 | "; 
    echo "尾页 | "; 
} 
?> 
共 <span><?= $pages ?></span> 页 | 当前第 <span><?= $page ?></span> 页 | 共 <span><?=$numrows ?></span> 条留言</p> 
</div> 


</body>
