<head>
    <link rel="stylesheet" href="styles/basic/style.css" type="text/css" media="screen" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
include "check.php";
include "connect.php";
include "functions.php";

	$id_user = $_SESSION['id_user'];
	$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['submit'])) && ($_POST['submit'] == 'Submit')) {

    $from = mysqli_real_escape_string($link, $_POST['from']);
    $to = mysqli_real_escape_string($link, $_POST['to']);
    $reason = mysqli_real_escape_string($link, $_POST['reason']);

    if (empty($from) || empty($to) || (empty($reason))) {
        send_message('Please fill out all the required * fields', 'error');
        header("Location: application.php");
        exit();
    }

	$from = date("Y-m-d", strtotime($from));
	$to = date("Y-m-d", strtotime($to));
	$date_now = date("Y-m-d");
	
	if($from < $date_now){
		send_message('Date must be later s than todays', 'error');
        exit();
		header("Location: application.php");
        exit();
	}

	if($from > $to){
		send_message('Start date must be sooner than the ending date', 'error');
        header("Location: application.php");
        exit();
	}
	
	
    mysqli_autocommit($link, false);

    $query = "INSERT INTO `application` 
                            (
                                `id_user`,
                                `from`,
                                `to`,
                                `reason`
                            ) 
                            Values
                            (
                                '$id_user',
                                '$from',
                                '$to',
                                '$reason'
                            )";
//echo $query;
//die;
    $result = mysqli_query($link, $query) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($link), E_USER_ERROR);;


include "sendemail.php";
    if ($result) {
        mysqli_commit($link);
        send_message('Data successfully updated', 'success');
		
		$msg = send_request($id_user,$username,$from,$to,$reason);
		if(!$msg) {   
			send_message('Error', 'error');
		} else {
			send_message('Success', 'error');
		}
		exit();
		
        header("Location: employee.php");
        exit();
    } else {
        mysqli_rollback($link);
		exit();
        send_message('Data not updated due to a problem on the database.', 'error');
    }
}
?>
<body>
    <?php
    print_message();
    echo "<br>";
    ?>
    <form action="application.php" method="post">
        <table border="0" width="225" align="center">
            <tr>
                <td width="219" bgcolor="#999999">
                    <p align="center"><font color="white"><span style="font-size:12pt;"><b>Submit Application</b></span></font></p>
                </td>
            </tr>
            <tr>
                <td width="219">
                    <table border="0" width="382" align="center">
                        <tr>
                            <td width="116"><span style="font-size:10pt;">Starting date:</span></td>
                            <td width="256"><input type="date" id="from" name="from"> * </td>
                        </tr>
                        <tr>
                            <td width="116"><span style="font-size:10pt;">Ending date:</span></td>
                            <td width="156"><input type="date" id="to" name="to"> * </td>
                        </tr>
                        <tr>
                            <td width="116"><span style="font-size:10pt;">Reason*:</span></td>
                            <td width="156"><textarea id="reason" name="reason" rows="4" cols="50"></textarea></td>
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