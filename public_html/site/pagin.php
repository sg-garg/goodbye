<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>


<!--<link href="css/shThemeDataTables.css" rel="stylesheet" type="text/css" media="all">-->
<!--<link href="css/shCore.css" rel="stylesheet" type="text/css" media="all">-->
<!--<link href="css/doc.css" rel="stylesheet" type="text/css" media="all">-->
<link href="css/demo_table.css" rel="stylesheet" type="text/css" media="all">
<script type="text/javascript" charset="utf-8" src="js/jquery.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery.dataTables.js"></script>
<script>
$(document).ready(function() {
    $('#table_id').dataTable( {
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "server_processing.php"
    } );
} );

</script>
</head>

<body>

<table id="table_id"  class="display">
    <thead>
        <tr>
            <th>First Name</th>
            <th>MI</th>
            <th>Last Name</th>
            <th>Branch of Service</th>
             <th>Age</th>
              <th>Date of Death</th>
               <th>Town</th>
               <th>State</th>
        </tr>
    </thead>
 <tbody>
        <tr>
            <td></td>
            <td></td>
             <td></td>
            <td></td>
             <td></td>
            <td></td>
             <td></td>

           
        </tr>

    </tbody>
</table>



</body>
</html>
