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
        $sql = "update eventcat set isdefault = 0 where eventcatid <> :id; 
            update eventcat set isdefault = 1 where eventcatid = :id";
        $q = $conn->prepare($sql);        
        $count = $q->execute( array(':id' => $obj->id ));       
        
        header("Location: event-catadmin.php?count=" . $count);
        die();
    }
    
    require_once("include/adminstart.php");
?>

<div class="Admin">
<a href="event-catadmin.php">Back to list</a><br />

<p>Setting the default category will cause posts with this category to display by
    default when clicking the Memorials menu item.</p>

<form method="post" action="event-catadmin-setdefault.php?event_id=<?php echo $obj->id; ?>">
<fieldset>
    <legend>Set Default Category - <?php echo htmlspecialchars($obj->name); ?> - Confirmation</legend>

    <input type="submit" value="Confirm!" />
</fieldset>
</form>
</div>
<?php require_once("include/adminend.php"); ?>