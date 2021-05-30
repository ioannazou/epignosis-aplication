<head>
    <link rel="stylesheet" href="styles/basic/style.css" type="text/css" media="screen" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php

include "connect.php";
include "functions.php";

if ($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['submit'])) && ($_POST['submit'] == 'Submit')) {

    $fname = mysqli_real_escape_string($link, $_POST['fname']);
    $lname = mysqli_real_escape_string($link, $_POST['lname']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
	$role = mysqli_real_escape_string($link, $_POST['roleOption']);

    if (empty($fname) || empty($lname) || (empty($email)) || empty($role)) {
        send_message('Πρέπει να συμπληρώσετε τα υποχρεωτικά πεδία (με τον αστερίσκο *)', 'error');
        header("Location: update.php");
        exit();
    }
	
	
	
    mysqli_autocommit($link, false);
	$get_user = $_GET['id_user'];
	#update user
    $query = "UPDATE user SET
				`fname` = '$fname',
				`lname` = '$lname',
				`email` = '$email',
				`fname` = '$fname',
				`id_role` = (SELECT id_role FROM role WHERE `title`= '$role')
				WHERE `id_user` = '$get_user';	
			";
	
    $result = mysqli_query($link, $query) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($link), E_USER_ERROR);

    if ($result) {
        mysqli_commit($link);
        send_message('Successful entry', 'success');
        header("Location: updateuser.php?id_user=$get_user");
        exit();
    } else {
        mysqli_rollback($link);
        send_message('There was a problem with the database. Try again', 'error');
    }
}
?>
<body>
    <?php
	include "admin_check.php";
	$get_user = $_GET['id_user'];
    print_message();
	include "connect.php";

	$sql_roles = "SELECT * FROM role ";
	$roles = array();
	$result = mysqli_query($link, $sql_roles) or die(mysqli_error($link));
	$array_length = mysqli_num_rows($result);
	while( $row = mysqli_fetch_assoc( $result ) ){
		$roles[] = $row["title"];
	}
	
	
	$sql = "SELECT * FROM user,role WHERE user.`id_role`=role.`id_role` AND user.`id_user`=$get_user";
	$result = mysqli_query($link, $sql) or die(mysqli_error($link));
	
	$row = mysqli_fetch_assoc( $result );
    echo "<br>";
    ?>
	<span><a  href='admin.php' target="_self"><font color="green">See Employees</font></a></span><br>
    <form action="updateuser.php?id_user=<?php echo $row ['id_user']; ?>" method="post">
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
                            <td width="256"><input type="text" name="fname" maxlength="100" value="<?php echo $row ['fname']; ?>"> * </td>
                        </tr>
                        <tr>
                            <td width="116"><span style="font-size:10pt;">Last Name:</span></td>
                            <td width="156"><input type="text" name="lname" maxlength="100" value="<?php echo $row ['lname']; ?>"> * </td>
                        </tr>
                        <tr>
                            <td width="116"><span style="font-size:10pt;">Email:</span></td>
                            <td width="156"><input type="text" name="email" maxlength="100" value="<?php echo $row ['email']; ?>"></td>
                        </tr>
                        <tr>
                            <td width="116"><span style="font-size:10pt;">Role:</span></td>
                            <td width="156"><select name="roleOption"><?php for ($i=0;$i<$array_length;$i++){?>
							<option value="<?=$roles[$i];?>" <?php echo($roles[$i]==$row['title'])? ' selected="selected"' : '';?> ><?=$roles[$i];?></option><?php }?></select></td>
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