<!-- nav -->
<div id="dropdown" style="margin-left: 155px;">
<ul id="JqueryMenu2">
	<li class="nav"><a class="nav" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/site/dashboard.php">Home</a></li>
	<li class="nav"><a class="nav" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/site/current-events-list.php">Memorials</a>
		<ul><li class="nav" ><a class="nav" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/site/public-memorials.php"><span style="font-size: smaller;">Public&nbsp;Memorials</a></a></li>
		</ul>
	</li>
<li class="nav"><a class="nav" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/site/search-memorials.php">Search</a></li>
<li class="nav"><a class="nav" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/site/my_account.php">My&nbsp;Account</a>
</li>

<?php
if(isset($_SESSION['userid'])){
?>

<li class="nav"><a class="nav" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/site/logout.php">Log Out</a></li>
	
<?php	
} else {
?>
	
<li class="nav"><a class="nav" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/site/login.php">Log In</a></li>
	
<?php	
}	
?>
</ul>
</div> <!-- end of navmenu -->