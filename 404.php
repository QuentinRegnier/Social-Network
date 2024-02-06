<?php
$id_user_live = $_COOKIE['id'];
$stmt1 = $pro_bdd->prepare('SELECT * FROM users WHERE use_code = :id_user');
$stmt1->execute(array('id_user' => $id_user_live));
$resultat1 = $stmt1->fetch();
if ($resultat1['pp'] == 1) {
	$pp = $resultat1['use_code'] . "_pp.png";
}else{
	$pp = "noimage.jpeg";
}
?>
<!DOCTYPE html>
<html style="overflow:hidden;">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes"/>
	<link rel="shortcut icon" href="IMG/favicon.png" />
	<link rel="stylesheet" type="text/css" href="CSS/burgermunu3.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<title>404</title>
</head>
<body>
	<?php include 'includes/nav.php'; ?>
	<div class="header" style="height: 100%;">
	<div class="inner-header flex" style="position:relative;height: 80%;">
	<h1>Erreur 404</h1>
	</div>
	<div style="position:relative;height: 20%;">
	<svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
	viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
	<defs>
	<path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
	</defs>
	<g class="parallax">
	<use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
	<use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
	<use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
	<use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
	</g>
	</svg>
	</div>
	</div>
	<style type="text/css">
		* {
		  	box-sizing:border-box; 
		  	outline:none;
		  	margin:0;
		  	padding:0;
		  	font-family: verdana;
		}
		html, body{
			width: 100%;
			height: 100%;
			overflow-x: hidden;
		}
		@import url(//fonts.googleapis.com/css?family=Lato:300:400);
		@import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@800&display=swap');
		/* cyrillic-ext */
		@font-face {
		  font-family: 'Pacifico';
		  font-style: normal;
		  font-weight: 400;
		  font-display: swap;
		  src: url(https://fonts.gstatic.com/s/pacifico/v22/FwZY7-Qmy14u9lezJ-6K6MmTpA.woff2) format('woff2');
		  unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
		}
		/* cyrillic */
		@font-face {
		  font-family: 'Pacifico';
		  font-style: normal;
		  font-weight: 400;
		  font-display: swap;
		  src: url(https://fonts.gstatic.com/s/pacifico/v22/FwZY7-Qmy14u9lezJ-6D6MmTpA.woff2) format('woff2');
		  unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
		}
		/* vietnamese */
		@font-face {
		  font-family: 'Pacifico';
		  font-style: normal;
		  font-weight: 400;
		  font-display: swap;
		  src: url(https://fonts.gstatic.com/s/pacifico/v22/FwZY7-Qmy14u9lezJ-6I6MmTpA.woff2) format('woff2');
		  unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+0300-0301, U+0303-0304, U+0308-0309, U+0323, U+0329, U+1EA0-1EF9, U+20AB;
		}
		/* latin-ext */
		@font-face {
		  font-family: 'Pacifico';
		  font-style: normal;
		  font-weight: 400;
		  font-display: swap;
		  src: url(https://fonts.gstatic.com/s/pacifico/v22/FwZY7-Qmy14u9lezJ-6J6MmTpA.woff2) format('woff2');
		  unicode-range: U+0100-02AF, U+0304, U+0308, U+0329, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
		}
		/* latin */
		@font-face {
		  font-family: 'Pacifico';
		  font-style: normal;
		  font-weight: 400;
		  font-display: swap;
		  src: url(https://fonts.gstatic.com/s/pacifico/v22/FwZY7-Qmy14u9lezJ-6H6Mk.woff2) format('woff2');
		  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
		}
		@import url('https://fonts.googleapis.com/css2?family=Inter&display=swap');
		@import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
		body {
		  margin:0;
		}

		h1 {
		  font-family: 'Pacifico', cursive;
		  font-weight:300;
		  letter-spacing: 2px;
		  font-size:48px;
		}
		.header {
		  position:relative;
		  text-align:center;
		  background: linear-gradient(60deg, rgba(84,58,183,1) 0%, rgba(0,172,193,1) 100%);
		  color:white;
		}
		.logo {
		  width:50px;
		  fill:white;
		  padding-right:15px;
		  display:inline-block;
		  vertical-align: middle;
		}

		.inner-header {
		  height:65vh;
		  width:100%;
		  margin: 0;
		  padding: 0;
		}

		.flex { /*Flexbox for containers*/
		  display: flex;
		  justify-content: center;
		  align-items: center;
		  text-align: center;
		}
		.waves {
			position: relative;
			width: 100%;
			height: 100%;
			margin-bottom: -7px;
			min-height: 100px;
		}
		.content {
		  position:relative;
		  height:20vh;
		  text-align:center;
		  background-color: white;
		}

		/* Animation */

		.parallax > use {
		  animation: move-forever 25s cubic-bezier(.55,.5,.45,.5)     infinite;
		}
		.parallax > use:nth-child(1) {
		  animation-delay: -2s;
		  animation-duration: 7s;
		}
		.parallax > use:nth-child(2) {
		  animation-delay: -3s;
		  animation-duration: 10s;
		}
		.parallax > use:nth-child(3) {
		  animation-delay: -4s;
		  animation-duration: 13s;
		}
		.parallax > use:nth-child(4) {
		  animation-delay: -5s;
		  animation-duration: 20s;
		}
		@keyframes move-forever {
		  0% {
		   transform: translate3d(-90px,0,0);
		  }
		  100% { 
		    transform: translate3d(85px,0,0);
		  }
		}
		.img_nav_bar{
		  width: 48px;
		  height: 48px;
		  float: left;
		  margin-top: 6px;
		  margin-left: 15px;
		  position: absolute;
		}
		.imgnav_bar{
		  width: 45px;
		  height: 45px;
		  margin-top: 2px;
		}
		.linav_bar{
		  list-style: none;
		  display: inline-block;
		}
		.nav_bar{
		  background-color: #1f0bd9;
		  height: 60px;
		  width: 100%;
		  margin-top: -60px;
		}
		.listnav_bar{
		  text-align: center;
		  width: 100%;
		}
		.linav_bar{
		  margin-top: 5px;
		}
		.linav2, .linav3, .linav4{
		  margin-left: 100px;
		}
		.linav1{
		  margin-left: 163px;
		}
		.img_user{
		  width: 40px;
		  height: 40px;
		  margin-right: 14px;
		  border-radius: 20px;
		}
		.name_user{
		  font-size: 25px;
		  color: #ffff;
		  font-family: 'Pacifico', cursive;
		  margin-right: 20px;
		  vertical-align: top;
		  cursor: pointer;
		}
		.content_user{
		  float: right;
		  margin-top: 10px;
		  text-decoration: none;
		}
		.nonSelectionnableindex, span, li, h1{
		  -moz-user-select: none; /* Firefox */
		  -webkit-user-select: none; /* Chrome, Safari, Opéra depuis la version 15 */
		  -ms-user-select: none; /* Internet explorer depuis la version 10 et Edge */
		  user-select: none; /* Propriété standard */
		}
	</style>
	<script type="text/javascript">
		window.onload = function() {
			$('document').ready(function () {
		trigger = $('.hamburger-nav');
		isClosednav = false;
		trigger.click(function () {
		  burgerTimenav();
		  start_menu_nav();
		})
	})
	window.addEventListener('resize', function() {
		ham_linav();
	});
	ham_linav();
};
	</script>
</body>
<?php include 'includes/footer_index.php'; ?>
</html>