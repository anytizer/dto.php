<!DOCTYPE html>
<html lang="en">
<head>
	<title>#__PACKAGE_NAME__ - #__CLASS_NAME__</title>
	<meta charset="UTF-8" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
	<meta name="theme-color" content="#DB5945" />
	<link rel="icon" sizes="192x192" href="logo.png" />
	<link rel=stylesheet href="css/w3.css" type="text/css" media="screen, print" />
	<link rel=stylesheet href="#__CSS_URL__/style.css" type="text/css" media="screen, print" />
</head>
<body>

<div class="wrapper">
	<div ng-app="#__CLASS_NAME__App">
		<h1 class="application-name">#__CLASS_NAME__</h1>
		<div ng-controller="#__CLASS_NAME__WelcomeController">
			<ul class="entity-menus">
				<li><a href="#!/#__CLASS_NAME__">Welcome</a></li>
				<li><a href="#!/#__CLASS_NAME__/list">List</a></li>
				<li><a href="#!/#__CLASS_NAME__/add">Add</a></li>
				<li><a href="#!/#__CLASS_NAME__/edit">Edit</a></li>
				<li><a href="#!/#__CLASS_NAME__/delete">Delete</a></li>
				<li><a href="#!/#__CLASS_NAME__/flag">Flag</a></li>
				<li><a href="#!/#__CLASS_NAME__/details">Details</a></li>
			</ul>
		</div>
		<div ui-view=""></div>
	</div>
</div>

<script type="text/javascript" src="#__MEDIA_URL__/angular.min.js"></script>
<script type="text/javascript" src="#__MEDIA_URL__/angular-cookies.min.js"></script>
<script type="text/javascript" src="#__MEDIA_URL__/angular-route.min.js"></script>
<script type="text/javascript" src="#__MEDIA_URL__/angular-ui-router.min.js"></script>

<script type="text/javascript" src="#__JS_URL__/#__CLASS_NAME__-app.js"></script>
<script type="text/javascript" src="#__JS_URL__/#__CLASS_NAME__-routes.js"></script>
<script type="text/javascript" src="#__JS_URL__/#__CLASS_NAME__-directives.js"></script>
<script type="text/javascript" src="#__JS_URL__/#__CLASS_NAME__-services.js"></script>
<script type="text/javascript" src="#__JS_URL__/#__CLASS_NAME__-controller.js"></script>

</body>
</html>