<?php
switch ($_GET['discount']) {
	case '10PERCENT':
		$discount = '10%';
		break;
	case '10DOLLARS':
		$discount = 10;
		break;
	case '10FOR10':
		$discount = $_GET['quantity'] === 10 ? $_GET['subtotal'] - 10 : 0;
		break;
	case 'FREESHIPPINGOVER100':
		$discount = $_GET['subtotal'] > 100 ? $_GET['shipping'] : 0;
		break;
	default:
		$discount = 0;
		break;
}
die(json_encode(array('discount' => $discount)));


