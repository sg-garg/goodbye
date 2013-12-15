<?
include("cdub_config.php");
$ip = $_GET['ip'];
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr> 
    <td width="400" height="13" valign="top"><font color="#666666" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
      <?
			  $getpages = mysql_query("SELECT * FROM cdub_pagviews WHERE ip = '$ip' ORDER BY id DESC");
			  while ($row = mysql_fetch_array($getpages)) {
			  $page = $row["page"];
			  $vdate = $row["date"];
			  ?>
      </strong> 
      <a href="../..<?php echo $page; ?>" target="_blank"><?php echo $page; ?></a>
      - - 
      <?php echo $vdate; ?>
      <br>
      
	<?
	}
	?>
      </font></td>
  </tr>
</table>
