<!DOCTYPE html>
<html>

<head>
    <title>Angular Scratch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="http://media.example.com:9090/css/w3.css" />
</head>

<body class="w3-indigo">
    <div class="wrapper w3-container">
            <div ng-app="signupsApp">

                    <div ng-controller="WelcomeController">
                            <h1>{{config.appname}}</h1>
                            <div class="w3-deep-purple w3-padding">
                                    <a class="w3-btn w3-hover-orange w3-red" href="#!/welcome">Welcome</a>
                                    <a class="w3-btn w3-hover-orange w3-red" href="#!/#__CLASS_NAME__/list">#__CLASS_NAME__</a>
                            </div>
                    </div>

                    <div ui-view=""></div>

            </div>
    </div>
    <script src="http://media.example.com:9090/js/angular.min.js"></script>
    <script src="http://media.example.com:9090/js/angular-route.min.js"></script>
    <script src="http://media.example.com:9090/js/angular-ui-router.min.js"></script>
    <script src="http://media.example.com:9090/js/angular-cookies.min.js"></script>

    <script src="#__URL__/entities/#__PACKAGE_NAME__/#__CLASS_NAME__/js/app.js"></script>
    <script src="#__URL__/entities/#__PACKAGE_NAME__/#__CLASS_NAME__/js/routes.js"></script>
    <script src="#__URL__/entities/#__PACKAGE_NAME__/#__CLASS_NAME__/js/services.js"></script>
    <script src="#__URL__/entities/#__PACKAGE_NAME__/#__CLASS_NAME__/js/controller.js"></script>
</body>
</html>
