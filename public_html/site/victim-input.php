<?php 
require_once("authhead.php");
require_once("pdoconnect.inc.php");

if(isset($_POST['fname']) )		{
$event_id = $_SESSION['event_id'] = trim($_POST['event_id']);
$fname = $_SESSION['fname'] = trim($_POST['fname']);
$mi = $_SESSION['mi'] = trim($_POST['mi']);
$lname = $_SESSION['lname'] = trim($_POST['lname']);
$occup = $_SESSION['occup'] = trim($_POST['occup']);
$age = $_SESSION['age'] = trim($_POST['age']);
$dod = $_SESSION['dod'] = trim($_POST['dod']);
$town = $_SESSION['town'] = trim($_POST['town']);
$state = $_SESSION['state'] = trim($_POST['state']);
$vic_img = $_SESSION['vic_img'] = trim($_POST['vic_img']);
$comments = $_SESSION['comments'] = trim($_POST['comments']);
$ip = $_SERVER['REMOTE_ADDR'];
$vic_id = round(time() *.9); 
$sqlin = "INSERT INTO victims (
event_id, 
vic_id,
fname, 
mi, 
lname, 
occup, 
age, 
dod,
town, 
state, 
vic_img, 
comments, 
ip
) VALUES 
(
:event_id,
:vic_id,
:fname,
 :mi, 
 :lname, 
 :occup, 
 :age, 
 :dod,
 :town, 
 :state, 
 :vic_img,
 :comments, 
 :ip
 )"; 
$qin = $conn->prepare($sqlin);
$qin->execute($a=array(
':event_id'=>$event_id,
':vic_id'=>$vic_id,
':fname'=>$fname,
':mi'=>$mi,
':lname'=>$lname,
':occup'=>$occup,
':age'=>$age,
':dod'=>$dod,
':town'=>$town, 
':state'=>$state, 
':vic_img'=>$vic_img,
':comments'=>$comments,
':ip'=>$ip
));
}


?>
<!DOCTYPE html>  
<html lang="en">  
<head> 
<meta charset="utf-8">   
<meta name="description" content="" />
<title>untitled</title>  
<style>
th	{
	padding:5px;
	text-align:center;}
</style>
</head>  
<body>

<h2>Event Victim Input</h2>
<h3>Please Note, if your refresh the page, you will insert the last information entered as a duplicate.</h3>
<form action=" " method="post" enctype="multipart/form-data">
<table>
<tr><td>Event Id</td><td>
<?php

$sql = "SELECT * FROM event   ";
$q = $conn->prepare($sql);
$q->execute();
//$rowr = $q->fetch();
$eventname = $rowr['event'];
//$row = $q->fetch();
echo '<select name=event_id>';
if(isset($rowr['event_id'])) {echo '<option value = '.$rowr['event_id'].'>'.$rowr['event'].'</option>';}else{
while ($rowr = $q->fetch()){

echo '<option value="'.$rowr[event_id].'">'.$rowr[event].'</option>';

}

}
echo '</select>';

//echo $row['userid'];

?>
</td></tr>
<tr><td><label></label></td><td></td></tr>

<tr><td><label>First Name</label></td><td><input name="fname" autofocus=autofocus type="text" required /></td></tr>
<tr><td><label>MI</label></td><td><input name="mi"  type="text"   /></td></tr>
<tr><td><label>Last Name</label></td><td><input name="lname" type="text" required  /></td></tr>
<tr><td><label>Occupation</label></td><td><input name="occup" type="text"  /></td></tr>
<tr><td><label>Age</label></td><td><input name="age" type="text"  /></td></tr>
<tr><td><label>Date of Death</label></td><td><input name="dod" type="text"  /></td></tr>
<tr><td><label>Town</label></td><td><input name="town" type="text" /></td></tr>
<tr><td><label>State</label></td><td><select name="state" id="state"/>  
    <option value="" selected="selected"></option>
       <option<?php if($_SESSION['state']=='AK') { echo "
		selected=selected"; } ?> value="AK">Alaska</option>
		<option<?php if($_SESSION['state']=='AL') { echo "
		selected=selected"; } ?> value="AL">Alabama</option>
		<option<?php if($_SESSION['state']=='AR') { echo "
		selected=selected"; } ?> value="AR">Arkansas</option>  
        <option<?php if($_SESSION['state']=='AZ') { echo "
		selected=selected"; } ?> value="AZ">Arizona</option>
         <option<?php if($_SESSION['state']=='CA') { echo "
		selected=selected"; } ?> value="CA">California</option>
       <option<?php if($_SESSION['state']=='CO') { echo "
		selected=selected"; } ?> value="CO">Colorado</option>
         <option<?php if($_SESSION['state']=='CT') { echo "
		selected=selected"; } ?> value="CT">Connecticut</option>
		<option<?php if($_SESSION['state']=='DC') { echo "
		selected=selected"; } ?> value="DC">District of Columbia</option>
		<option<?php if($_SESSION['state']=='DE') { echo "
		selected=selected"; } ?> value="DE">Delaware</option>  
        <option<?php if($_SESSION['state']=='FL') { echo "
		selected=selected"; } ?> value="FL">Florida</option>
         <option<?php if($_SESSION['state']=='GA') { echo "
		selected=selected"; } ?> value="GA">Georgia</option>
       <option<?php if($_SESSION['state']=='HI') { echo "
		selected=selected"; } ?> value="HI">Hawaii</option>
         <option<?php if($_SESSION['state']=='IA') { echo "
		selected=selected"; } ?> value="IA">Iowa</option>
		<option<?php if($_SESSION['state']=='ID') { echo "
		selected=selected"; } ?> value="ID">Idaho</option>
		<option<?php if($_SESSION['state']=='IL') { echo "
		selected=selected"; } ?> value="IL">Illinois</option>  
        <option<?php if($_SESSION['state']=='IN') { echo "
		selected=selected"; } ?> value="IN">Indiana</option>
         <option<?php if($_SESSION['state']=='KS') { echo "
		selected=selected"; } ?> value="KS">Kansas</option>
       <option<?php if($_SESSION['state']=='KY') { echo "
		selected=selected"; } ?> value="KY">Kentucky</option>
         <option<?php if($_SESSION['state']=='LA') { echo "
		selected=selected"; } ?> value="LA">Louisiana</option>
		<option<?php if($_SESSION['state']=='MA') { echo "
		selected=selected"; } ?> value="MA">Massachusetts</option>
		<option<?php if($_SESSION['state']=='MR') { echo "
		selected=selected"; } ?> value="MR">Maryland</option>  
        <option<?php if($_SESSION['state']=='ME') { echo "
		selected=selected"; } ?> value="ME">Maine</option>
         <option<?php if($_SESSION['state']=='MI') { echo "
		selected=selected"; } ?> value="MI">Michigan</option>
       <option<?php if($_SESSION['state']=='MN') { echo "
		selected=selected"; } ?> value="MN">Minnesota</option>
         <option<?php if($_SESSION['state']=='MO') { echo "
		selected=selected"; } ?> value="MO">Missouri</option>
		<option<?php if($_SESSION['state']=='MS') { echo "
		selected=selected"; } ?> value="MS">Mississippi</option>
		<option<?php if($_SESSION['state']=='MT') { echo "
		selected=selected"; } ?> value="MT">Montana</option>  
        <option<?php if($_SESSION['state']=='NC') { echo "
		selected=selected"; } ?> value="NC">North Carolina</option>
         <option<?php if($_SESSION['state']=='ND') { echo "
		selected=selected"; } ?> value="ND">North Dakota</option>
       <option<?php if($_SESSION['state']=='NE') { echo "
		selected=selected"; } ?> value="NE">Nebraska</option>
         <option<?php if($_SESSION['state']=='NH') { echo "
		selected=selected"; } ?> value="NH">New Hampshire</option>
		<option<?php if($_SESSION['state']=='NJ') { echo "
		selected=selected"; } ?> value="NJ">New Jersey</option>
		<option<?php if($_SESSION['state']=='NM') { echo "
		selected=selected"; } ?> value="NM">New Mexico</option>  
        <option<?php if($_SESSION['state']=='NV') { echo "
		selected=selected"; } ?> value="NV">Nevada</option>
         <option<?php if($_SESSION['state']=='NY') { echo "
		selected=selected"; } ?> value="NY">New York</option>
       <option<?php if($_SESSION['state']=='OH') { echo "
		selected=selected"; } ?> value="OH">Ohio</option>
         <option<?php if($_SESSION['state']=='OK') { echo "
		selected=selected"; } ?> value="OK">Oklahoma</option>
		<option<?php if($_SESSION['state']=='OR') { echo "
		selected=selected"; } ?> value="OR">Oregon</option>
		<option<?php if($_SESSION['state']=='PA') { echo "
		selected=selected"; } ?> value="PA">Pennsylvania</option>  
        <option<?php if($_SESSION['state']=='PR') { echo "
		selected=selected"; } ?> value="PR">Puerto Rico</option>
         <option<?php if($_SESSION['state']=='RI') { echo "
		selected=selected"; } ?> value="RI">Rhode Island</option>
       <option<?php if($_SESSION['state']=='SC') { echo "
		selected=selected"; } ?> value="SC">South Carolina</option>
         <option<?php if($_SESSION['state']=='SD') { echo "
		selected=selected"; } ?> value="SD">South Dakota</option>
		<option<?php if($_SESSION['state']=='TN') { echo "
		selected=selected"; } ?> value="TN">Tennessee</option>
		<option<?php if($_SESSION['state']=='TX') { echo "
		selected=selected"; } ?> value="TX">Texas</option>  
        <option<?php if($_SESSION['state']=='UT') { echo "
		selected=selected"; } ?> value="UT">Utah</option>
         <option<?php if($_SESSION['state']=='VA') { echo "
		selected=selected"; } ?> value="VA">Virginia</option>
       <option<?php if($_SESSION['state']=='VT') { echo "
		selected=selected"; } ?> value="VT">Vermont</option>
         <option<?php if($_SESSION['state']=='WA') { echo "
		selected=selected"; } ?> value="WA">Washington</option>
		<option<?php if($_SESSION['state']=='WI') { echo "
		selected=selected"; } ?> value="WI">Wisconsin</option>
		<option<?php if($_SESSION['state']=='WV') { echo "
		selected=selected"; } ?> value="WV">West Virginia</option>  
        <option<?php if($_SESSION['state']=='WY') { echo "
		selected=selected"; } ?> value="WY">Wyoming</option>
       

       
        </select></td></tr>
<tr><td><label>Image</label></td><td><input name="vic_img" type="file" /></td></tr>
<tr><td><label>Comments</label></td><td><textarea name="comments" cols="20" rows="10" value="Your Comments"></textarea></td></tr>

</table>
<input name="submit" type="submit" value="Submit" />
</form>
<?php // echo '<h2>List of Victims in Database for </h2>';?>
<?php 
/*$sqls = "SELECT * FROM victims WHERE event_id ='$event_id '";
$qs = $conn->prepare($sqls);
$qs->execute();
$rowh = $qs->fetch();

echo '<table><tr><th>First Name</th><th>MI</th><th>Last Name</th><th>Occupation</th><th>Age</th><th>Town</th><th>State</th><th>Image</th><th>Comments</th></tr>';
while($rows = $qs->fetch())
{
echo '<tr><td>'.$rows['fname'].'</td><td>'.$rows['mi'].'</td><td>'.$rows['lname'].'</td><td>'.$rows['occup'].'</td><td>'.$rows['age'].'</td><td>'.$rows['town'].'</td><td>'.$rows['state'].'</td><td>'.$rows['vic_img'].'</td><td>'.$rows['comments'].'</td></tr>';

}
echo '</table>';*/
?>
<br /><br /><br />
<form action="events-admin.php">
<input type="submit"  value="Go to Event Admin Page" />
</form>
</body>
</html>