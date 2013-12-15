<?php 
    require_once("include/adminbase.php");

    $catid = intval($_GET["event_id"]);
    
    $sql = "SELECT eventcatid, name FROM eventcat where eventcatid = :id";
    
    $q = $conn->prepare($sql);
    
    $q->execute( array(':id' => $catid));

    $row = $q->fetch();
    
    $obj = new stdClass;
    $obj->name = "";
    $obj->id = "";
    
    if (!$row) 
    {
        // Not found
        header("Location: event-catadmin.php");
        die();
    }
    else
    {
        $obj->id = $row['eventcatid'];
        $obj->name = $row['name'];
    }
    
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
        $sql = "delete from eventcat where eventcatid = :id";
        $q = $conn->prepare($sql);        
        $count = $q->execute( array(':id' => $obj->id ));       
        
        header("Location: event-catadmin.php?count=" . $count);
        die();
    }
    
    require_once("include/adminstart.php");
?>

<div class="Admin">
<a href="event-catadmin.php">Back to list</a><br />

<ul>
    <li>TODOS:
        <ol>
            <li>If deleting default, re-assign default</li>
            <li>Re-assign posts to a different category</li>
        </ol>
    </li>    
</ul>

<form method="post" action="event-catadmin-delete.php?event_id=<?php echo $obj->id; ?>">
<fieldset>
    <legend>Delete Category - <?php echo htmlspecialchars($obj->name); ?> - Confirmation</legend>

    <input type="submit" value="Confirm!" />
</fieldset>
</form>

</div>
<?php require_once("include/adminend.php"); ?>