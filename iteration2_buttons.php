
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
  <style>
		body {
			padding: 100px 20px;
			background: #434343;
			min-width: 600px;
			color: #fff;
			font-family: Arial, sans-serif;
		}
		.site-header {
			background: #545454;
			width: 100%;
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			height: 80px;
			min-width: 600px
		}
		.site-header .fr {
			float: right;
			line-height: 80px;
			margin-right: 30px;
			color: #fff;
			font-size: 13px;
			letter-spacing: 3px;
		}
		h1 {
			display: block;
			margin-top: 50px;
			color: #b4ae98;
		}
		h1:first-of-type {
			margin-top: 30px;
		}
		a {
			display: block;
			padding: 20px 10px;
			color: #fff;
			text-decoration: none;
			border-bottom: 1px solid #b4ae98;
			font-family: Arial, sans-serif;
			font-size: 14px;
		}
		a::after {
			content: 'View email';
			display: none;
			color: #b4ae98;
			float: right;
		}
		a:hover {
			background: #545454;
		}
		a:hover::after {
			display: block;
		}
	</style>
</head>
<body>
	<div class="site-header">
		<img class="logo" src="http://img2.email2inbox.co.uk/2016/stonegate/templates/sg_logo.jpg"></img>
		<span class="fr">CRM EMAIL TEMPLATES</span>
	</div>

<h1>Bosleys</h1>
<a href="buttons/inner/bosleys_buttons.html">Buttons</a>

<h1>Common Room</h1>
<a href="buttons/inner/common_room_buttons.html">Buttons</a>

<h1>Yates</h1>
<a href="buttons/inner/yates_buttons.html">Buttons</a>
</body>

</html>
