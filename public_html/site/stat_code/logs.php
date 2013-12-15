<?php
include("cdub_config.php");

$refer = $_GET['refer'];
$offset = $_GET['offset'];

if($action =="deleteall") {
$deleteall = mysql_query("DELETE FROM cdub_visitors");
$deletepages = mysql_query("DELETE FROM cdub_pagviews");
cdub_alertgo("All logs have been deleted.", "logs.php");
}
if($action =="deleteallnic") {
$deleteall = mysql_query("DELETE FROM cdub_visitors WHERE nic =''");
$deletepages = mysql_query("DELETE FROM cdub_pagviews WHERE nic =''");
cdub_alertgo("All logs with no nicname have been deleted.", "logs.php");
}
if($action =="delete") {
$deleteperson = mysql_query("DELETE FROM cdub_visitors WHERE id = '$deid'");
if(!$deleteperson) {
cdub_error("could not delete the entry, please try again");
} else {
cdub_alertgo ("Your selection has been deleted, Thanks!", "logs.php");
}
$deletepageviews = mysql_query("DELETE FROM cdub_pagviews WHERE ip = '$ipad'");
if(!$deletepageviews) {
cdub_error ("Could not delete the pageviews from database, please try again.");
} else {
cdub_alertgo ("PageViews have been deleted also.", "logs.php");
}
}
$limit = 5;
if ($offset == "") {
$offset = 0;
}

$Result=mysql_query("SELECT * FROM cdub_visitors WHERE ref LIKE '%$refer%'"); 
			    $countResult = mysql_num_rows($Result);
if ($offset == "") {
$num = 0;
} else {
$num = $offset+1;
}
?>
<div align="center">
  <table width="619" border="0" cellpadding="0" cellspacing="0" background="http://www.snagaurl.com/i/intromid.gif">
    <!--DWLayoutTable-->
    <tr valign="middle"> 
      <td colspan="3" align="right" bgcolor="white"><div align="center">&nbsp;&nbsp;&nbsp;&nbsp;<font color="#993300" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
          <font color="#006699" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
          <?
	$pages=intval($countResult/$limit); 
 
if ($countResult%$limit) { 
$pages++; 
} 
 
if ($offset>1) { 
$prevoffset=$offset-$limit; 
echo '<a href="' . $_SERVER['PHP_SELF'] . '?offset=' . $prevoffset . '&refer=' . $refer . '"><<</a>&nbsp;'; 
} else { 
     echo ( "<<&nbsp;" ); 
} 
for ($i=1;$i<=$pages;$i++) { 
$newoffset=$limit*($i-1); 
echo '&nbsp;<a href="' . $_SERVER['PHP_SELF'] . '?offset=' . $newoffset . '&refer=' . $refer . '">' . $i . '</a>&nbsp;'; 
} 
 
if ($countResult>($offset+$limit)) { 
$nextoffset=$offset+$limit; 
echo '&nbsp;<a href="' . $_SERVER['PHP_SELF'] . '?offset=' . $nextoffset . '&refer=' . $refer . '">>></i></a><p>'; 
} else { 
     echo ( "&nbsp;>>" ); 
	 }
	 ?>
          </font> </strong></font></div></td>
    </tr>
    <tr valign="middle"> 
      <td height="22" colspan="3" align="right" background="http://www.snagaurl.com/i/domaintop.gif"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;<font color="#993300" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
          Visitor Logs</strong></font></div></td>
    </tr>
    <tr> 
      <td width="25" height="86" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
      <td width="571" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <!--DWLayoutTable-->
          <tr> 
            <td width="571" valign="top" class="bluetxtbotborder" > 
              <?
			$limit = 5;
if ($offset == "") {
$offset = 0;
}

if ($offset == "") {
$num = 0;
} else {
$num = $offset+1;
}
?>
              <?
$Result=mysql_query("Select * FROM cdub_vips"); 
			    $totalv = mysql_num_rows($Result);
$gettotalp = mysql_query("SELECT views FROM cdub_logs_views");
while ($row = mysql_fetch_array($gettotalp)) {
$totalp = $row["views"];
$average = $totalp / $totalv;
$average = round($average, 2);
?>
              <font color="#006699" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Total 
              Unique Visitors : <font color='red'> 
              <?php echo $totalv; ?>
              <font color="#006699">- Total Page Views</font></font></strong></font> 
              : <font color="#006699" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong><font color='red'> 
              <?php echo $totalp; ?>
              - &nbsp;</font></strong></font> 
              <br>
              <br>
              <font color="#006699" size="2" face="Verdana, Arial, Helvetica, sans-serif"><font color="#009900" size="1">Average 
              Page views Per Visitor :<strong> 
              <?php echo $average; ?>
              </strong></font></font> <font size="1"><strong><font color="#009900"> 
              <?
}
$yahoo=mysql_query("Select * FROM cdub_visitors WHERE ref LIKE '%yahoo%'"); 
			    $yahooc = mysql_num_rows($yahoo);
$google=mysql_query("Select * FROM cdub_visitors WHERE ref LIKE '%google%'"); 
			    $googlec = mysql_num_rows($google);
$aol=mysql_query("Select * FROM cdub_visitors WHERE ref LIKE '%aol%'"); 
			    $aolc = mysql_num_rows($aol);
?>
              </font></strong></font><strong><font color="#009900"> </font></strong>&nbsp;<br>
              <hr size="1" noshade>
              <div align="left"><font color="#CC0000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Hits 
                from Search Engines:</strong></font>&nbsp;&nbsp;&nbsp;&nbsp;<font size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;<a href="logs.php?refer=yahoo"><font color="#FF9900">yahoo 
                - 
                <?php echo $yahooc; ?>
                </font></a></font><font size="1" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="logs.php?refer=google"><font color="#3300CC">google 
                - 
                <?php echo $googlec; ?>
                </font> </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="logs.php?refer=aol"><font color="#999900">Aol 
                - 
                <?php echo $aolc; ?>
                </font></a><font color="#999900">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                </font>&nbsp;<strong><a href="logs.php"><font color="#666666">View 
                All Logs</font></a></strong></font></div>
              <hr size="1" noshade></td>
          </tr>
		  <tr>
            <td width="571" valign="top" class="bluetxtbotborder" > <div align="left"><font size="1"> 
                <?
			$limit = 5;
if ($offset == "") {
$offset = 0;
}

$Result=mysql_query("SELECT * FROM cdub_visitors WHERE ref LIKE '%$refer%'"); 
			    $countResult = mysql_num_rows($Result);
$Result2=mysql_query("Select * FROM cdub_pagviews"); 
			    $countResult2 = mysql_num_rows($Result2);
if ($offset == "") {
$num = 0;
} else {
$num = $offset+1;
}
?>
                <font color="#0066CC" face="Verdana, Arial, Helvetica, sans-serif">From 
                Logs Listed : Unique :</font><font color="#006699" face="Verdana, Arial, Helvetica, sans-serif"><font color='red'> 
                <?php echo $countResult; ?>
                <font color="#0066CC">- Page Views</font></font></font><font color="#0066CC"> 
                :</font> <font color="#006699" face="Verdana, Arial, Helvetica, sans-serif"><font color='red'> 
                <?php echo $countResult2; ?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </font></font>&nbsp;</font> 
                <hr size="3" noshade>
                </div></td>
</tr>
          <?
$getvisitors = mysql_query("SELECT * FROM cdub_visitors WHERE ref LIKE '%$refer%' ORDER BY id DESC LIMIT $offset, $limit");
while ($row = mysql_fetch_array($getvisitors)) {
$id = $row["id"];
$ip = $row["ip"];
$ref = $row["ref"];
$browse = $row["browse"];
$hits = $row["hits"];
$fvisit = $row["fvisit"];
$lvisit = $row["lvisit"];
$nic = $row["nic"];
if($ref =="") {
$ref = "Reached manually or through link via instant messenger.";
}
?>
          <tr> 
            <td width="571" height="86" valign="top" class="bluetxtbotborder"><p><strong><font color="#006699" size="1" face="Verdana, Arial, Helvetica, sans-serif">I.P. 
                Address : </font></strong><font color="#006699" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                <?php echo $ip; ?>
                - 
                <?php
			  if($nic !="") {
			  echo("<b>nicname : </b>$nic");
			  } else {
			  ?>
                <a href='javascript:;' onClick="window.open('<?php echo $cdub_site; ?>/givnic.php?ipid=<?php echo $id; ?>&ip=<?php echo $ip; ?>','newwindow','height=200','width=400',
                'dependent=1','directories=0','locationA35=30',
                'menubar=0','resizable=1',
                'scrollbars=1','toolbar=0')">Assign Nicname</a> 
                <?php
			  }
			  ?>
                </font></p>
              <p><font color="#006699" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Reffering 
                Site :</strong>
                <?
			  if($ref =="Reached manually or through link via instant messenger.") {
			  ?>
                <font color='red'>
                <?php echo $ref ?>
                </font> 
                <?
			  } else {
			  ?>
                <a href="<?php echo $ref ?>" target="_blank"><font color='green'>
                <?php echo $ref ?>
                </font></a> 
                <?
			  }
			  ?>
                </font></p>
              <p><font color="#006699" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Browser 
                : </strong> 
                <?php echo $browse ?>
                </font></p>
              <p><font color="#FF6600" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Total 
                Page Views : </strong> 
                <?php echo $hits ?>
                </font></p>
              <p><font color="#666666" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><a href='javascript:;' onClick="window.open('<?php echo $cdub_site; ?>/pageviews.php?ip=<? echo($ip); ?>','newwindow','height=200,width=400,dependent=1,directories=0,locationA35=30,menubar=0,resizable=1,scrollbars=1,toolbar=0')">Click to see Page Views</a></strong></font></p>
              
              <p><font color="#006699" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>First Visit : </strong></font>
              <font color="#FF6600" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                <?php echo $fvisit; ?>
                </font><font color="#666666" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><br>
                </strong></font><font color="#006699" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Last 
                Visit :</strong></font><font color="#666666" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
                </strong></font><font color="#FF00FF" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                <?php echo $lvisit; ?>
                </font></p>
              <p>*eGoodbyes Rules*</p>
              <hr size="1"></td>
          </tr>
          <?
		}
		?>
        </table></td>
      <td width="23" valign="top" class="introtext"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
    <tr> 
      <td height="11" colspan="3" valign="top"><img src="icon-cool001.jpg" width="75" height="75"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="15" colspan="3" valign="top"><div align="center"><strong><font color="#006699" size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="icon-cool001.jpg" width="1" height="1"> 
          <?
	$pages=intval($countResult/$limit); 
 
if ($countResult%$limit) { 
$pages++; 
} 
 
if ($offset>1) { 
$prevoffset=$offset-$limit; 
echo '<a href="' . $_SERVER['PHP_SELF'] . '?offset=' . $prevoffset . '&refer=' . $refer . '"><<</a>&nbsp;'; 
} else { 
     echo ( "<<&nbsp;" ); 
} 
for ($i=1;$i<=$pages;$i++) { 
$newoffset=$limit*($i-1); 
echo '&nbsp;<a href="' . $_SERVER['PHP_SELF'] . '?offset=' . $newoffset . '&refer=' . $refer . '">' . $i . '</a>&nbsp;'; 
} 
 
if ($countResult>($offset+$limit)) { 
$nextoffset=$offset+$limit; 
echo '&nbsp;<a href="' . $_SERVER['PHP_SELF'] . '?offset=' . $nextoffset . '&refer=' . $refer . '">>></i></a><p>'; 
} else { 
     echo ( "&nbsp;>>" ); 
	 }
	 ?>
          </font></strong> </div></td>
    </tr>
  </table>
</div>