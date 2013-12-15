<?php
session_start();
$_SESSION['ver'] = 1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="utf-8">
<title>Membership Processing - Select A Plan</title>

<?php require("include/head.html") ?>
</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=489619547756822";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- facebook like check -->

<div id="minMax">
<div id="header">
<div align="center">
<img src="img/eGoodbyes-COVER2.jpg" alt="eGoodbyes" height="200" width="900" border="0"><br>
<?php include("include/nav-main.php"); ?>
</div> <!-- end of center -->

<div class="content"><br></div>

</div> <!-- end header -->
<div id="wrapper">
		
<div id="egcol2">
<div class="content">		

<?php require("include/side_menu.php"); ?>

<div id="cart"></div>
</div> <!-- end content -->
</div> <!-- end outer3 -->


<div id="topbar">
<div class="content">
<h3><b>Show your Support</b> Honor the victims by making a donation to the <a href="#hdisaster">hurricane disaster relief fund</a>.</h3>		
</div>
</div>
			
<div id="egcol1">
<div class="content">
<h1>Choose a Plan</h1>

<div class="clear_fix"></div>

<!-- plan 1 -->
<div class="plan-block">
<h2>Free Account</h2>
<hr>
<p>You may start using eGoodbyes today!<br>Free  For  Life Time</p>
<p>This will allow you to see how eGoodbyes.com works.</p>
<p><a class="large button blue">Subscribe Now</a></p>
</div>

<!-- plan 2 -->
<div class="plan-block">
<h2>Memorial</h2>
<hr> 
<p><i>$ 2.99 For  Life Time</i><br>
This plan is for Memorials. Can add multiple quantity, as well as accessories.</p>
<p><a class="large button blue">Subscribe Now</a></p>
</div>

<div class="clear_fix"></div>

<!-- plan 3 -->
<div class="plan-block">
<h2>Standard Goodbyes</h2>
<hr>
<p>This plan is the best value<br>
<i>$ 14.99 For  Life Time</i><br> 
This is a paid membership option.</p>
<p><a class="large button blue">Subscribe Now</a></p>
</div>

<!-- plan 4 -->
<div class="plan-block">
<h2>Premium Paid</h2>
<hr>
<p>This is the plan with all benefits, plus extra options<br>
<i>$ 24.99 For  Life Time</i><br> 
This is the paid premium plan.</p>
<p><a class="large button blue">Subscribe Now</a></p>
</div>

<div class="clear_fix"></div>

<!-- plan 5 -->
<div class="plan-block">
<h2>Free (sample)</h2>
<hr>
<p>This is the plan specifically used for testing<br>
<i>0.05 cents will be transacted with ePay.</i><br> 
<p>This is the paid premium plan.</p>
<p><a class="large button blue">Subscribe Now</a></p>
</div>

<div class="plan-block-clear">
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</div>

<div class="clear_fix"></div>

<br><br><br>
<hr>
<!-- facebook like check -->

<fb:like href="https://www.facebook.com/Egoodbyes" send="true" width="450" show_faces="true"></fb:like>
<br><br><br>


<?php require("development.php"); ?>



</div> <!-- end content -->
</div> <!-- end outer2 -->
</div><!-- end #wrapper -->

<div id="footer">
<div class="content">
<?php include("include/footer.php") ;?>
</div> <!-- end content -->
</div> <!-- end footer -->
</div> <!-- end wrapperA -->
	<script src="js/validate.js"></script>
	
<script>
/**
 * Example plum.Shop configuration
  */

$('#cart').plum('shop', {
	cartitem: '{title} &mdash; {pricesingle} '
		+ '&times; {quantity} &mdash; '
		+ '{pricetotal}' + ' You are registering for the {product.id} plan.',
		discountCodes: { '10PERCENT': '10%', '10DOLLARS': 10 },
		discountURL : discount.php,
		geolocation : true,
		currencyCode: 'USD',
		storage : 'session',
		storageName : 'plum_shop',
		storageURL : '<?php echo $site_url; ?>',
		checkout : function () {
		console.dir(this.cart);
		return false;
		alert('Verifying Facebook Discount.\n\n'
			+ '$1 Discount Applied for liking on facebook ' + this.quantity + ' (-$1) for a '
			+ 'total of ' + this.formatPrice(this.total));
		return true;
	}
	});

$('#cart2').plum('shop', {
	cartitem: '<span>{title}</span> '
		+ '<div class="options">'
			+ '<select class="color">'
				+ '<option value="cyan">Cyan</option>'
				+ '<option value="magenta">Magenta</option>'
				+ '<option value="yellow">Yellow</option>'
				+ '<option value="black">Black</option>'
			+ '</select> '
			+ '<select class="size">'
				+ '<option value="6">6</option>'
				+ '<option value="7">7</option>'
				+ '<option value="8">8</option>'
				+ '<option value="9">9</option>'
			+ '</select>'
		+ '</div>'
		+ '<input class="quantity" value="{quantity}">'
		+ '<span>{pricesingle}</span> '
		+ '<span>{pricetotal}</span> '
		+ '<a class="remove" href="#">Remove</a>',
	properties: [ 'description', 'thumb', 'color', 'size' ],
	currencyFormat: '$00,000,000.00', // £
	currencyCode: 'USD',
	generateSKU: true,
	geolocation: true,
	taxRate: { 'US': [ 0.08 ] },
	discountCodes: { '10PERCENT': '10%', '10DOLLARS': 10 },
	sandbox: true,
	shippingRate: {
		'USPS': 0.10,
		'UPS Ground': 0.15,
		'FedEx Express': 0.18
	},

	checkout: function () {
		console.dir(this.cart);
		return false;
		alert(
			'This message is controlled by a callback function.\n\n'
			+ 'Checking out your cart of ' + this.quantity + ' items for a '
			+ 'total of ' + this.formatPrice(this.total)
		);
		return true;
	},
	emptyCartBefore: function () {
		return confirm(
			'This message is controlled by a callback function.\n\n'
			+ 'Are you sure you want to empty your cart?'
		);
	}
});
</script>
	
</body>
</html>
