
<?php
session_start();

include "connect.php";

if(isset($_GET['userid']))
{
	$val=$_GET['userid'];

	$sql="SELECT * FROM temp_login_info WHERE user_name='$val'";
	$result=mysql_query($sql);
	while($row = mysql_fetch_array($result))
	{
		if($row['user_name']==$val)
		{
			$uu=$row['user_name'];
			$pp=$row['password'];
			$ee=$row['email'];
			$batch=$row['batch'];
			$city=$row['city'];
			$country=$row['country'];
			//$cc=$row['cf_id'];
			//$hh=$row['hackerearth_id'];

			$sql2="INSERT INTO login_info VALUES('','$uu','$pp','$ee','$batch','','$city','$country')";
			$sql3="DELETE FROM temp_login_info WHERE user_name='$uu'";
			if(mysql_query($sql2) && mysql_query($sql3))
			{
				header('location:start.php');
			}
			else
				header('location:start.php');
		}
	}
}

if(isset($_COOKIE['name'])){
	$_SESSION['name']=$_COOKIE['name'];
	header('location:index.php');
}

if(isset($_POST['submit']))
{
	$username=$_POST['fname'];
	//$_SESSION['name']=$username;
	$pass=$_POST['password'];

	$sql="SELECT * FROM login_info WHERE user_name='$username' AND password='$pass'";
	$result=mysql_query($sql);
	$val=0;
	while($row = mysql_fetch_array($result))
	{
		if(($row['password']==$pass) && ($row['user_name']==$username))
		{
			$_SESSION['name']=$row['user_name'];
			$ses=$_SESSION['name'];
			if(isset($_POST['rem']))
			{
				setcookie("name",$ses,time() + (3600),"/");
				$_SESSION['password']=$pass;
			}
			$val=1;
			header('location:index.php');
			die();
		}
	}

	header('location:start.php?q=1');

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SGIPC</title>
<meta name="keywords" content="" />
<meta name="description" content="" />

<link href="tooplate_style.css" rel="stylesheet" type="text/css" />


<link rel="stylesheet" type="text/css" href="ddsmoothmenu.css" />

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="ddsmoothmenu.js">



</script>

<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "tooplate_menu", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

</script>
    
</head>

<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<head>

		<script type="text/javascript">
		function vall()
		{
			if(fff.fname.value=="" || fff.password.value=="" )
			{
				alert("Fill-up all the section");
				fff.password.focus();
				return false;
			}
			return true;
		}
		</script>

	</head>

<body>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<form name="fff" method="POST" style="text-align: center; color:#DDD; margin-left:480px">
	<table style="text-align:center; color:#DDD; font-size:28px" cellpadding="5" cellspacing="5"> 
		<tr>
			<td>User-name</td>
			<td><input style="border-radius: 5px; height: 25px; width: 200px; " name="fname" type="text" placeholder="User-name" pattern="[A-Z]*[a-z]*" title="Only Alphabet allowed"  ></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input style="border-radius: 5px; height: 25px; width: 200px;"  name="password" type="password" placeholder="Enter password" ></td>
		</tr>
		<tr>
			<td></td>
			<td style="font-size:20px;"><input style="border-radius: 5px; margin-right:10px;" name="rem" type="checkbox">Remember-me</td>
		</tr>
		<tr>
			<td></td>
			<td><input style="border-width:0px; background:#3366ff;  margin-right:130px; display:block; height:30px; width:80px;" name="submit" type="submit" value="Log-in" onclick="return vall();"> </td>
		</tr>
	</table>
</form>
<br>
<p style="margin-left:600px;color:#DDD;font-size: 20px;">New user? <a href="register.php" style="text-decoration:none;color:#66ff66;font-size:20px;">register</a> here</p>


</body>
</html>