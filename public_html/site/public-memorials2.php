<!DOCTYPE html>  
<html lang="en">  
<head> 
<meta charset="utf-8">   
<meta name="description" content="Find recent memorials or obituaries of loved ones or our brave heros.">

<title>eGoodbyes - Say Goodbye Now, Be Remembered Forever</title>
<script src="js/jquery.js"></script>
<script src="js/jquery.plum.form.js"></script>
<link rel="stylesheet" href="css/default.css">
<link rel="stylesheet" href="css/design3-style.css" type="text/css" media="all" />
<!--[if lte IE 7]>
<link rel="stylesheet" href="css/design3-styleie.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/default.ie7.css">
<![endif]-->

<script type="text/javascript" charset="utf-8" src="js/jquery.dataTables.js"></script>
<script language="javascript" type="text/javascript" src="js/nav2.1.js"></script>
<script language="javascript" type="text/javascript" src="js/menu.js"></script>
<link rel="stylesheet" href="css/extra-style.css">
<link href="css/demo_table.css" rel="stylesheet" type="text/css" media="all">
<style>
table	{
	text-align:left;
	}
td {
	padding-right:15px;}
#main	{
width:880px;
	margin:0px auto;
	background-color:#D8E0E4;
	overflow:hidden;
	min-height:600px;
	}
input	{
	line-height:15px;}
	div.pagination {
	padding: 3px;
	margin: 3px;
}

div.pagination a {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #AAAADD;
	
	text-decoration: none; /* no underline */
	color: #000099;
}
div.pagination a:hover, div.pagination a:active {
	border: 1px solid #000099;

	color: #000;
}
div.pagination span.current {
	padding: 2px 5px 2px 5px;
	margin: 2px;
		border: 1px solid #000099;
		
		font-weight: bold;
		background-color: #000099;
		color: #FFF;
	}
	div.pagination span.disabled {
		padding: 2px 5px 2px 5px;
		margin: 2px;
		border: 1px solid #EEE;
	
		color: #DDD;
	}
.center	{
	text-align:center;
	display:block;
	width:200px;
	margin:0px auto;
	}
.blue	{
	background-color:#0033FF;}
.right		{
	text-align:right;
	padding-left:6px;}
</style>
<script>
$(document).ready(function() {
    $('#table_id').dataTable( {
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "server_processing_public_memorials.php"
    } );
} );

</script>
</head>
<body>

<div id="minMax">
		<div id="header">
			<div align="center">
			<img src="img/eGoodbyes-COVER2.jpg" alt="eGoodbyes" height="200" width="900" border="0"><br>
			<?php include("include/nav-main.php"); ?>
			</div> <!-- end of center -->
			<div class="content"><br></div>
		</div>
		
<div class="content">
<div id="main">
<h1 class="center">Public Memorials</h1>
<table id="table_id"  class="display">
    <thead>
        <tr>
        
            <th>First Name</th>
           
            <th>Last Name</th>
          
             <th>Created By</th>
              <th>Birth Date</th>
               <th>Date of Passing</th>
               <th>Date Created</th>
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

           
        </tr>

    </tbody>
</table>



<br />

</div> <!-- end outer2 -->
</div><!-- end #wrapper -->

<div id="footer">
<div class="content">
<?php require("include/footer_code.html") ;?>
</div> <!-- end content -->
</div> <!-- end footer -->
</div> <!-- end wrapperA -->

	<script src="js/validate.js"></script>
</body>
</html>
