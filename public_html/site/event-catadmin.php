<?php 
require_once("include/adminbase.php"); 

$sql = "SELECT * FROM eventcat order by Sequence, Name";
$q = $conn->prepare($sql);
$q->execute();
//$rowid=$q->fetch();

require_once("include/adminstart.php");
?>
    <div class='Admin'>
        <a href="event-catadmin-edit.php">Enter New Category</a><br />
        <a href="events-admin.php">Back to Events Admin</a><br /><br />
        
        There can be one default category.  It is selected when you select Memorials.
        All categories display in the sidebar of Memorials, ascending by Name
        within Sequence.  If you delete the default category, you should
        set another category as the default!
    
<?php
echo '<table class="Bordered">';
echo '<tr><th>Category Id</th><th>Name</th><th>Sequence</th><th>Is Default?</th><th /><th /><th /></tr>';
while($row = $q->fetch())//remove extra ) when no loop
{
echo '<tr><td>'.$row['eventcatid'].'</td><td>' . htmlspecialchars($row['name']) .'</td><td>' . htmlspecialchars($row['sequence']) .'</td><td>'.$row['isdefault'].'</td>
    <td><a href="event-catadmin-edit.php?event_id='.$row['eventcatid'].'">Edit</a></td>
    <td><a href="event-catadmin-delete.php?event_id='.$row['eventcatid'].'">Delete</a></td>
    <td><a href="event-catadmin-setdefault.php?event_id='.$row['eventcatid'].'">Set Default</a></td>
</tr>';
}
echo '</table>';

?>
    </div>

<?php require_once("include/adminend.php"); ?>