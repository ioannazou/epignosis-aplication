<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" href="styles/basic/style.css" type="text/css" media="screen" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
    <?php
		session_start();
		include "connect.php";
		include "functions.php";
		$_SESSION['role'] = 0;
		$email = mysqli_real_escape_string($link, $_POST['email']);
		$password = mysqli_real_escape_string($link, $_POST['password']);
		if (empty($email) || empty($password)) {
			send_message('You have to enter both email and password to log in', 'error');
			header("Location: index.php");
			exit();
		}
		
		$sql = "SELECT username, id_role, id_user FROM user WHERE email='$email' and password='$password'";
		$result = mysqli_query($link, $sql) or die(mysqli_error($link));
		$count = mysqli_num_rows($result);
		
		if ($count == 1) {
			$row = mysqli_fetch_assoc($result);
			$role = $row['id_role'];
			$username = $row['username'];
			$id_user = $row['id_user'];
			
			$_SESSION['username'] = $username;
			$_SESSION['id_user'] = $id_user;
			
			// $_SESSION['password'] = $password;
			$_SESSION['id_role'] = $role;
			} else {
			send_message('Wrong credentials', 'error');
			header("Location: index.php");
			exit();
		}
		
		switch ($_SESSION['id_role']) {
		case 1: //admin
            header("Location: admin.php");
            exit();
            break;
		case 2: //user
            header("Location: supervisor.php");
            exit();
            break;
		case 3: //user
            header("Location: employee.php");
            exit();
            break;
		}
	?>
