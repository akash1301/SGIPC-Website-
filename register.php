
<?php
session_start();
include 'connect.php';

if(isset($_COOKIE['name'])){
	$_SESSION['name']=$_COOKIE['name'];
	header('location:index.php');
}

if(isset($_POST['submit']))
{
	$user=$_POST['fname'];
	$mail=$_POST['mid'];
	$pass=$_POST['password'];
	$confirm=$_POST['cpassword'];
	$batch=$_POST['batch'];
	$city=$_POST['city'];
	$country=$_POST['country'];
	//$cf=$_POST['cfid'];
	//$heid=$_POST['heid'];
	
	$sql="SELECT * FROM login_info WHERE user_name='$user'";
	$result=mysql_query($sql);
	$val=0;
	while($row = mysql_fetch_array($result))
	{
		if(($row['user_name']==$user))
		{
			header("location:register.php?action=user_exist");
			$val=1;
		}
	}

	if($val==0)
	{
		$sql="SELECT * FROM login_info WHERE email='$mail'";
		$result=mysql_query($sql);
		while($row = mysql_fetch_array($result))
		{
			if(($row['email']==$mail))
			{
				header("location:register.php?action=mail_exist");
				$val=1;
			}
		}
	}

	// if($val==0)
	// {
	// 	$sql="SELECT * FROM login_info WHERE cf_id='$cf'";
	// 	$result=mysql_query($sql);
	// 	while($row = mysql_fetch_array($result))
	// 	{
	// 		if(($row['cf_id']==$cf))
	// 		{
	// 			header("location:register.php?action=cf_exist");
	// 			$val=1;
	// 		}
	// 	}
	// }

	// if($val==0)
	// {
	// 	$sql="SELECT * FROM login_info WHERE hackerearth_id='$heid'";
	// 	$result=mysql_query($sql);
	// 	while($row = mysql_fetch_array($result))
	// 	{
	// 		if(($row['hackerearth_id']==$heid))
	// 		{
	// 			header("location:register.php?action=hackerearth_exist");
	// 			$val=1;
	// 		}
	// 	}
	// }


	if($val==0){
	$sql="SELECT * FROM temp_login_info WHERE user_name='$user'";
	$result=mysql_query($sql);
	while($row = mysql_fetch_array($result))
	{
		if(($row['user_name']==$user))
		{
			header("location:register.php?action=user_exist");
			$val=1;
		}
	}
	}

	if($val==0)
	{
		$sql="SELECT * FROM temp_login_info WHERE email='$mail'";
		$result=mysql_query($sql);
		while($row = mysql_fetch_array($result))
		{
			if(($row['email']==$mail))
			{
				header("location:register.php?action=mail_exist");
				$val=1;
			}
		}
	}

	// if($val==0)
	// {
	// 	$sql="SELECT * FROM temp_login_info WHERE cf_id='$cf'";
	// 	$result=mysql_query($sql);
	// 	while($row = mysql_fetch_array($result))
	// 	{
	// 		if(($row['cf_id']==$cf))
	// 		{
	// 			header("location:register.php?action=cf_exist");
	// 			$val=1;
	// 		}
	// 	}
	// }

	// if($val==0)
	// {
	// 	$sql="SELECT * FROM temp_login_info WHERE hackerearth_id='$heid'";
	// 	$result=mysql_query($sql);
	// 	while($row = mysql_fetch_array($result))
	// 	{
	// 		if(($row['hackerearth_id']==$heid))
	// 		{
	// 			header("location:register.php?action=hackerearth_exist");
	// 			$val=1;
	// 		}
	// 	}
	// }




		if($pass==$confirm && $val==0)
		{
			$sql="INSERT INTO temp_login_info VALUES('','$user','$pass','$mail','$batch','$city','$country')";
			if(mysql_query($sql))
			{
				$_SESSION['mail_id']=$mail;
				$_SESSION['username']=$user;
				header("location:sent_mail.php");
			}
			else
			{
				header('location:register.php');
			}
		}

}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register</title>
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
		<title>Register</title>

		<script type="text/javascript">
		function vall()
		{
			if(fff.fname.value=="" || fff.password.value==""  || fff.cpassword.value=="" || fff.mid.value=="" || fff.cfid.value=="" || fff.heid.value=="")
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
<form name="fff" method="POST" style="text-align: center; color:#DDD; margin-left:400px">
	<table style="text-align:center; color:#DDD; font-size:28px" cellpadding="5" cellspacing="5"> 
		<tr>
			<td>User-name</td>
			<td><input style="border-radius: 5px; height: 25px; width: 200px; " name="fname" type="text" placeholder="User-name" pattern="[A-Z]*[a-z]*" title="Only Alphabet allowed"  ></td>
			<td style="color:#ff531a; font-size:20px;" ><?php if(isset($_GET['action']) && $_GET['action']=='user_exist') echo "User id already in use";  ?></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input style="border-radius: 5px; height: 25px; width: 200px;"  name="password" type="password" placeholder="Enter password" ></td>
		</tr>
		<tr>
			<td>Confirm Password</td>
			<td><input style="border-radius: 5px; height: 25px; width: 200px;"  name="cpassword" type="password" placeholder="Enter password" ></td>
		</tr>
		<tr>
			<td>Mail ID</td>
			<td><input style="border-radius: 5px; height: 25px; width: 200px;"  name="mid" type="email" placeholder="Enter email" ></td>
			<td style="color:#ff531a; font-size:20px;"><?php if(isset($_GET['action']) && $_GET['action']=='mail_exist') echo "Email id already in use";  ?></td>
		</tr>
<!-- 		<tr>
			<td>Codeforces ID</td>
			<td><input style="border-radius: 5px; height: 25px; width: 200px;"  name="cfid" type="text" placeholder="Enter Codeforces ID" ></td>
			<td style="color:#ff531a; font-size:20px;" ><?php if(isset($_GET['action']) && $_GET['action']=='cf_exist') echo "Codeforces id already in use";  ?></td>
		</tr>
		<tr>
			<td>Hackerearth ID</td>
			<td><input style="border-radius: 5px; height: 25px; width: 200px;"  name="heid" type="text" placeholder="Enter Hackerearth ID" ></td>
			<td style="color:#ff531a; font-size:20px;" ><?php if(isset($_GET['action']) && $_GET['action']=='hackerearth_exist') echo "Hackerearth id already in use";  ?></td>
		</tr> -->
		<tr>
			<td>Batch</td>
			<td><input style="border-radius: 5px; height: 25px; width: 200px;"  name="batch" type="text" placeholder="Enter your Batch(example:2k13)" ></td>
		</tr>
		<tr>
			<td>Current City</td>
			<td><input style="border-radius: 5px; height: 25px; width: 200px;"  name="city" type="text" placeholder="Enter your current city" ></td>
		</tr>
		<tr>
			<td>Country</td>
			<td><input style="border-radius: 5px; height: 25px; width: 200px;"  name="country" type="text" placeholder="Enter your Country" ></td>
		</tr>
		<tr>
			<td></td>
			<td><input style="border-width:0px; background:#3366ff;  margin-right:130px; display:block; height:30px; width:80px;" name="submit" type="submit" value="Register" onclick="return vall();"> </td>
		</tr>
	</table>
</form>
<br>


</body>
</html>