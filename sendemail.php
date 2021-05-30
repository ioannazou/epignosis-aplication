<?php

function send_request($id_user,$username,$from,$to,$reason){

$to = "ioannazournatzi19@gmail.com";
$subject = "Vacation Application Request";

$message = "
<html>
<head>
<title>Vacation Request</title>
</head>
<body>

<p>​Dear supervisor, employee {$user} requested for some time off, starting on
{$from} and ending on {$to}, stating the reason:
{$reason}
Click on one of the below links to approve or reject the application:
</p>
<table>
<tr>
<td><a href='http://localhost/answer.php?id_user=$id_user&from=$from&to=$to&reason=$reason&status=0'> Approve</a></td>
<td><a href='http://localhost/answer.php?id_user=$id_user&from=$from&to=$to&reason=$reason&status=1'> Reject</a></td>
</tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <info_application@epignosis.com>' . "\r\n";

$result =  mail($to,$subject,$message,$headers);
return $result;
}
?>