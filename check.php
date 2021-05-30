<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="styles/basic/style.css" type="text/css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
	session_start();
	if(!isset($_SESSION['username']) || $_SESSION['username']=="")
	{
		echo "Not logged in. Try again";
		exit;
	}
?>