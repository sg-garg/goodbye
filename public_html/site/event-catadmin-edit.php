<?php 
    require_once("include/adminbase.php");

    $catid = intval($_GET["event_id"]);
    
    $sql = "SELECT * FROM eventcat where eventcatid = :id";
    
    $q = $conn->prepare($sql);
    
    $q->execute( array(':id' => $catid));

    $row = $q->fetch();
    
    $obj = new stdClass;
    $obj->name = "";
    $obj->default = false;
    $obj->id = "";
    $obj->sequence = 0;
    
    if (!$row) 
    {
        $obj->id = "";
    }
    else
    {
        $obj->id = $row['eventcatid'];
        $obj->name = $row['name'];
        $obj->isdefault = $row['isdefault'];
        $obj->sequence = $row['sequence'];
    }
    
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $obj->name = $_POST["name"];
        $obj->sequence = intval($_POST["sequence"]);
        
        // JRHTODO - validate sequence.  Require all
        
        $sql = "insert into eventcat (name, isdefault, sequence) values (:name, 0, :sequence)";
        if ($obj->id !== ''){
            $sql = "update eventcat set name = :name, sequence = :sequence where eventcatid = :id";
        }

        $q = $conn->prepare($sql);
        if ($obj->id !== ''){
            $q->execute( array(':id' => $obj->id, 
                ':name' => $obj->name,
                ':sequence' => $obj->sequence
            ));
        }
        else
        {
            $q->execute( array(
                ':name' => $obj->name,
                ':sequence' => $obj->sequence
            ));
        }        
        
        header("Location: event-catadmin.php");
        die();
    }
    
    require_once("include/adminstart.php");
?>

<div class="Admin">
    <a href="event-catadmin.php">Back to list</a><br />
    <br />

    <p>
        Categories display on the memorial side bar.  Categories display
        in ascending order of Name within Sequence.  The default category
        will display when the Memorial link is selected.        
    </p>

<ul>
    <li>TODOS:
        <ol>
            <li>Required Edits</li>
            <li>Number validation</li>
        </ol>
    </li>    
</ul>

<form method="post" action="event-catadmin-edit.php?<?php echo $obj->id; ?>">
<fieldset>
    <legend>Edit Category</legend>
    
    <table>
        <tr>
            <td>
                <label for="name">Name</label>
            </td>
            <td>
                <input type="text" size="45" maxlength="45" name="name" id="name"
                       value="<?php echo htmlspecialchars($obj->name); ?>"
                       />
            </td>
        </tr>
        <tr>
            <td>
                <label for="default">Is Default?</label>
            </td>
            <td>
                <input type="checkbox" disabled 
                       <?php 
                        if ($obj->isdefault)
                                echo 'checked="checked"';                        
                       ?>                       
                       />
            </td>
        </tr>
         <tr>
            <td>
                <label for="sequence">Sequence</label>
            </td>
            <td>
                <input type="text" size="4" maxlength="4" name="sequence" id="sequence"
                       value="<?php echo htmlspecialchars($obj->sequence); ?>"
                       />
            </td>
        </tr>
    </table>

    <input type="submit" value="Save" />
    

</fieldset>
</form>

</div>

<?php require_once("include/adminend.php"); ?>