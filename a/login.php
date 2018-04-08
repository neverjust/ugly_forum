<?php
//插入连接数据库的相关信息
require_once 'db.php';
//开启一个会话
session_start();
$error_msg = "";
//如果用户未登录，即未设置$_SESSION['user_id']时，执行以下代码
if(!isset($_SESSION['user_id']))
{
  if(isset($_POST['submit'])){//用户提交登录表单时执行如下代码
    $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    $user_id = mysqli_real_escape_string($dbc,trim($_POST['id']));
    $user_password = mysqli_real_escape_string($dbc,trim($_POST['password']));
  
    if(!empty($user_id)&&!empty($user_password))
    {
      //MySql中的SHA()函数用于对字符串进行单向加密
      $query = "SELECT id,password,nickname FROM log WHERE id = '$user_id' AND password = sha1($user_password)";
      //用用户名和密码进行查询
      $data = mysqli_query($dbc,$query);
      //若查到的记录正好为一条，则设置SESSION，同时进行页面重定向
      if($data)
      {
        $row = mysqli_fetch_array($data);
        $_SESSION['user_id']=$row['id'];
        $_SESSION['password']=$row['password'];
        $_SESSION['nickname']=$row['nickname']; 

        echo "<script>alert('恭喜你，登陆成功！');location.href='index.php';</script>";
      }
      else
      {//若查到的记录不对，则设置错误信息
        $error_msg = 'Sorry, you must enter a valid username and password to log in.1';
      }
    }
    else
    {
      $error_msg = 'Sorry, you must enter a valid username and password to log in.2';
    }
  }
}else{//如果用户已经登录，则直接跳转到已经登录页面
  echo "<script>alert('恭喜你，已登陆成功！');location.href='index.php';</script>";
} 
?>
<html>
  <head>
    <title>Mismatch - Log In</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
    <h3>Msimatch - Log In</h3>
    <!--通过$_SESSION['user_id']进行判断，如果用户未登录，则显示登录表单，让用户输入用户名和密码-->
    <?php
    if(!isset($_SESSION['user_id'])){
      echo '<p class="error">'.$error_msg.'</p>';
    ?>
    <!-- $_SERVER['PHP_SELF']代表用户提交表单时，调用自身php文件 -->
    <form method = "post" action="<?php echo $_SERVER['PHP_SELF'];?>">
      <fieldset>
        <legend>Log In</legend>
  
        <label for="username">Username:</label>
        <!-- 如果用户已输过用户名，则回显用户名 -->
        <input type="text" id="i" name="id"
        value="<?php if(!empty($user_username)) echo $user_username; ?>" placeholder="请输入用户名" />
  
        <br/>
  
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="请输入密码"/>
  
      </fieldset>
      <input type="submit" value="Log In" name="submit"/>
      <input type="submit" value="register" onclick="window.open('register.php')"  name="submit"/>
    </form>
    <?php
    }
    ?>
  </body>
</html>





