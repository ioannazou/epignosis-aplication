<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="styles/basic/style.css" type="text/css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
	session_start();
	if(!isset($_SESSION['id_role']) || $_SESSION['id_role'] != "1")
	{
		echo "Not log in as an admin";
		exit;
	}
?>