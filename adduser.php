<head>
    <link rel="stylesheet" href="styles/basic/style.css" type="text/css" media="screen" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
include "admin_check.php";
include "connect.php";
include "functions.php";

if ($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['submit'])) && ($_POST['submit'] == 'Submit')) {

    $fname = mysqli_real_escape_string($link, $_POST['fname']);
    $lname = mysqli_real_escape_string($link, $_POST['lname']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
	$pass1 = mysqli_real_escape_string($link, $_POST['pass1']);
	$pass2 = mysqli_real_escape_string($link, $_POST['pass2']);
	$role = mysqli_real_escape_string($link, $_POST['roleOption']);

    if (empty($fname) || empty($lname) || (empty($email)) || empty($role)|| empty($pass1) || empty($pass2)) {
        send_message('Fill out the required (*) fields.', 'error');
        header("Location: adduser.php");
        exit();
    }
	
	if($pass1!=$pass2){
        send_message('Passwords are not the same', 'error');
        header("Location: adduser.php");
        exit();
    }
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		send_message('The email wasn s found', 'error');
		header("Location: adduser.php");
        exit();
	}
	
    mysqli_autocommit($link, false);
	//check if email exist in database
	$query = "SELECT * FROM user WHERE `email`='$email'";
	$result = mysqli_query($link, $query) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($link), E_USER_ERROR);
	$count = mysqli_num_rows($result);
	
	if($count!=0){
		send_message('User with this email already exists.', 'error');
		header("Location: adduser.php");
        exit();
	}
	
	
	#update user
    $query = "INSERT INTO user (`fname`,`lname`,`email`,`password`,`id_role` ) VALUES('$fname','$lname','$email','$pass1',(SELECT id_role FROM role WHERE `title`= '$role'))";
	
    $result = mysqli_query($link, $query) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($link), E_USER_ERROR);

    if ($result) {
        mysqli_commit($link);
        send_message('Success.', 'success');
        header("Location: adduser.php");
        exit();
    } else {
        mysqli_rollback($link);
        send_message('Data not updated due to a problem on the database.', 'error');
    }
}
?>
<body>
    <?php
    print_message();
	include "connect.php";

	$sql_roles = "SELECT * FROM role ";
	$roles = array();
	$result = mysqli_query($link, $sql_roles) or die(mysqli_error($link));
	$array_length = mysqli_num_rows($result);
	while( $row = mysqli_fetch_assoc( $result ) ){
		$roles[] = $row["title"];
	}
	
    echo "<br>";
    ?>
	<span><a  href='admin.php' target="_self"><font color="green">See Employees</font></a></span><br>
    <form action="adduser.php" method="post">
        <table border="0" width="225" align="center">
            <tr>
                <td width="219" bgcolor="#999999">
                    <p align="center"><font color="white"><span style="font-size:12pt;"><b>Update User</b></span></font></p>
                </td>
            </tr>
            <tr>
                <td width="219">
                    <table border="0" width="382" align="center">
                        <tr>
                            <td width="116"><span style="font-size:10pt;">First Name:</span></td>
                            <td width="256"><input type="text" name="fname" maxlength="100" value=""> * </td>
                        </tr>
                        <tr>
                            <td width="116"><span style="font-size:10pt;">Last Name:</span></td>
                            <td width="156"><input type="text" name="lname" maxlength="100" value=""> * </td>
                        </tr>
                        <tr>
                            <td width="116"><span style="font-size:10pt;">Email:</span></td>
                            <td width="156"><input type="text" name="email" maxlength="100" value="">*</td>
                        </tr>
						<tr>
                            <td width="116"><span style="font-size:10pt;">Password:</span></td>
                            <td width="156"><input type="text" name="pass1" maxlength="100" value="">*</td>
                        </tr>
						<tr>
                            <td width="116"><span style="font-size:10pt;">Confirm Password:</span></td>
                            <td width="156"><input type="text" name="pass2" maxlength="100" value="">*</td>
                        </tr>
                        <tr>
                            <td width="116"><span style="font-size:10pt;">Role:</span></td>
                            <td width="156"><select name="roleOption"><?php for ($i=0;$i<$array_length;$i++){?>
							<option value="<?=$roles[$i];?>" ><?=$roles[$i];?></option><?php }?></select></td>
                        </tr>
                        <tr>
                            <td width="116">&nbsp;</td>
                            <td width="156">
                                <p align="left"><input type="submit" name="submit" value="Submit"></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </form>
</html>