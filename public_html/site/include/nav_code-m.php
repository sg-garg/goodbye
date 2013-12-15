<!-- nav -->
<!--Scott, I changed the left margin to 200 when I removed the log in-->
<div id="dropdown" style="margin:0px auto; width:650px; border:none; ">
<ul id="JqueryMenu2" style="z-index:2000;   border:none;">
<li class="nav" style="-moz-border-radius: 8px  0px 0px 8px;
	-khtml-border-radius: 8px  0px 0px 8px;
	-webkit-border-radius: 8px  0px 0px 8px;
	border-radius: 8px  0px 0px 8px; border:none; box-shadow: -4px 0px 6px #111; "><a class="nav" href="dashboard.php">Home</a></li>
<li class="nav"><a class="nav" href="current-events-list.php">Memorials</a>
<ul><li class="nav" ><a class="nav" href="public-memorials.php"><span style="font-size: smaller;">Public&nbsp;Memorials</a></li>

</ul>
</li>
<li class="nav"><a class="nav" href="search-memorials.php">Search</a></li>
<li class="nav"><a class="nav" href="my_account.php">My&nbsp;Account</a>
</li>

<?php if(isset($_SESSION['ver'])){?>
<li class="nav" style="-moz-border-radius: 0px  8px 8px 0px;
	-khtml-border-radius: 0px  8px 8px 0px;
	-webkit-border-radius: 0px  8px 8px 0px;
	border-radius: 0px  8px 8px 0px; box-shadow: 4px 0px 6px #111;"><a class="nav"  href="logout.php">Log Out</a></li>
<?php  } else if(!isset($_SESSION['ver'])){?>
<li class="nav"><a class="nav" href="login.php">Log In</a></li>
<?php }?>
</ul>
</div>  <!-- end of navmenu -->