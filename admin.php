<?php
include "admin_check.php";
include "connect.php";

	$id_user = $_SESSION['id_user'];

	$sql = "SELECT * FROM user,role WHERE user.`id_role`=role.`id_role`";

	$result = mysqli_query($link, $sql) or die(mysqli_error($link));
	$count = mysqli_num_rows($result);
?>
<html>
<head>

</head>
<body>

 <span><a  href='adduser.php' target="_self"><font color="green">Add user</font></a></span>
  <br>
<table border="2">
	<thead>
		<tr>
			<th> Name </th>
			<th> Surname </th>
			<th>Email</th>
			<th> Role </th>
		</tr>
	</thead>
	<tbody>
	<?php
      if( $count==0 ){
        echo '<tr><td colspan="4">No Rows Returned</td></tr>';
      }else{
        while( $row = mysqli_fetch_assoc( $result ) ){
			$id_userr = $row['id_user'];
          echo "<tr><td><a href='http://localhost/updateuser.php?id_user=$id_userr'>{$row['fname']}</a></td><td>{$row['lname']}</td><td>{$row['email']}</td><td>{$row['title']}</td></tr>\n";
        }
      }
    ?>
	</tbody>
</table>

<br>

<table>
    <tr>
        <td width="219" bgcolor="#999999"><a href="logout.php" target="_self"><font color="white">Logout</font></a><font color="white"> </font><b><i><font color="white"> Now!</font></i></b></td>
    </tr>
</table>

</body>
</html>