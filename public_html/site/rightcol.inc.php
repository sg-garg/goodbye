<h3>Account Information</h3>
<?php 
$sqlmai = "SELECT * FROM users WHERE userid = '$userid'";
$qmai = $conn->prepare($sqlmai);
$qmai->execute();
$rowmai = $qmai->fetch();
$mail_remain = $rowmai['goodbyes'] - $count;
?>
<table>
<tr>
<td>User Name:</td><td><?php echo $rowmai['username']; ?></td></tr>
<td>User Id:</td><td><?php echo $rowmai['userid']; ?></td></tr>
<td>Account Level:</td><td><?php echo $rowmai['user_level']; ?></td></tr>
<td>Emails Remaining:</td><td><?php echo $mail_remain; ?>

</td></tr>
<td>Postal Mail Messages Remaining:</td><td><?php echo 5 - $count; ?></td></tr>
<td>Video Uploads Remaining:</td><td></td></tr>
<td>Memorials Remaining:</td><td></td></tr>


</tr>
</table>



