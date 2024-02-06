<?php

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Payement</title>
</head>
<body>
<form action="includes/StripePayment.php" method="POST">
  <input type="hidden" name="action" value="create-checkout-session">
  <button type="submit">S'abonner</button>
</form>
</body>
<?php 
// include 'includes/footer_index.php'; 
?>
<style type="text/css">
	* {
		box-sizing:border-box; 
		outline:none;
		margin:0;
		padding:0;
		font-family: verdana;
	}	
	body, html{
		width: 100%;
		height: 100%;
	}
	img{
		pointer-events: none;
	}
	body{
		background-color: #1f0bd9;
	}
</style>
</html>