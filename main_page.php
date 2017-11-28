
<?php
session_start();
include "connect.php";

if(!isset($_SESSION['name']))
	header('location:start.php');

if(!isset($_COOKIE['name']) &&  isset($_SESSION['name']) && isset($_SESSION['password']))
{
	unset($_SESSION['name']);
	unset($_SESSION['password']);
	header('location:start.php');
}

if(isset($_COOKIE['name']) &&  !isset($_SESSION['name']) && isset($_SESSION['password']))
{
	unset($_SESSION['name']);
	unset($_SESSION['password']);
	header('location:start.php');
}

if(isset($_GET['action']) && $_GET['action']=='logout'){
	unset($_SESSION['name']);

	setcookie('name','',0,"/");
	//setcookie('password','',0,"/");
	header('location:start.php');
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

<!-- <script type="text/javascript">
	function func()
	{
		// document.location.href = 'https//www.google.com';
		// alert('HI you there');
		var btn = document.getElementById('id_button');
		btn.addEventListener('click', function() {
  			document.location.href = 'google.com';
		});
	}
</script> -->

<script type="text/javascript">
		function vall()
		{
			if(fff.fname.value=="")
			{
				alert("Enter your handle");
				return false;
			}
			return true;
		}
		</script>
    
</head>