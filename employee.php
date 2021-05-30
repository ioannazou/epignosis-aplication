<?php
include "check.php";

	include "connect.php";
	$iduser = $_SESSION['id_user'];
	
	# get all applications from database for given user
	$sql = "SELECT *, DATEDIFF( `to`, `from`)+1 AS DateDiff FROM application WHERE id_user='$iduser' ORDER BY submitted DESC";
	$result = mysqli_query($link, $sql) or die(mysqli_error($link));
	$count = mysqli_num_rows($result);
	echo "<h3> Welcome " . $_SESSION['username'] . "</h3>"
?>

<table border="2">
	<thead>
		<tr>
			<th>Start date </th>
			<th>End date</th>
			<th>Number of days</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
	<?php
      if( $count==0 ){
        echo '<tr><td colspan="4">No Rows Returned</td></tr>';
      }else{
        while( $row = mysqli_fetch_assoc( $result ) ){
			
          echo "<tr><td>{$row['from']}</td><td>{$row['to']}</td><td>{$row['DateDiff']}</td><td>{$row['status']}</td></tr>\n";
        }
      }
    ?>
	</tbody>
</table>

<table>
	<tr>
        <td width="300" bgcolor="#6723456"><a href="application.php" target="_self"><font color="white">submit request</font></a></td>
    </tr>
    <tr>
        <td width="219" bgcolor="#999999"><a href="logout.php" target="_self"><font color="white">Logout</font></a><font color="white"> </font><b><i><font color="white"> Now!</font></i></b></td>
    </tr>
</table>