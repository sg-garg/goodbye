<?
include("cdub_config.php");

$ip = $_GET['ip'];
$ipid = $_GET['ipid'];
$nicname = $_POST['nicname'];

// example post: ?ipid=3&ip=65.175.49.98
if(isset($_GET['ipid1'])) {$ipid1 = $_GET['ipid1'];}
if(isset($_GET['ipid'])) {$ipid = $_GET['ipid'];}
if(isset($_POST['mip'])) {$mip = $_POST['mip'];}
if(isset($_POST['pip'])) {$pip = $_POST['pip'];}
if(isset($_POST['nicname'])) {$nicname = $_POST['nicname'];}



if(isset($nicname)) {
$updatenic = mysql_query("UPDATE cdub_visitors SET
nic = '$nicname'
WHERE id = '$mip'");
$updatepag = mysql_query("UPDATE cdub_pagviews SET
nic = '$nicname'
WHERE ip = '$pip'");
echo("Thanks! Nicname has been added. Click the X to close this window and refresh the logs page");
} else {
?><table width="400" border="0" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr><form method="post" action="givnic.php?ipid1=<?php echo $ipid ?>">
      <td width="400" height="13" valign="top">
        <?php echo $ip ?>
        <br>
        <input type="text" name="nicname">
	<input type="hidden" name="mip" value="<?php echo $ipid ?>">
	<input type="hidden" name="pip" value="<?php echo $ip ?>">
      <label>
      <input type="submit" name="Submitnic" value="Assign Nicname">
      </label></td></form>
  </tr>
</table>
<?
}
?>