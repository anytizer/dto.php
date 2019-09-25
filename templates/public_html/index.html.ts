<!DOCTYPE html>
<html>
<head>
    <title>CRUD</title>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>

    <link href="favicon.ico" rel="shortcut icon"/>

    <link href="css/w3.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet"/>

    <script src="https://kit.fontawesome.com/f825c3d96c.js"></script>

    <script type="text/javascript" src="js/angularjs/angular.min.js"></script>
    <script type="text/javascript" src="js/angularjs/angular-sanitize.min.js"></script>
    <script type="text/javascript" src="js/ui-router/angular-ui-router.min.js"></script>
    <script type="text/javascript" src="js/ui-router/stateEvents.min.js"></script>
    <script type="text/javascript" src="js/app.js"></script>

    <!--ANGULAR-JS-COMPONENTS-MARKER-->
    <!--
    <script type="text/javascript" src="entities/#__PACKAGE_NAME__/#__CLASS_NAME__/js/#__CLASS_NAME__-routes.js"></script>
    <script type="text/javascript" src="entities/#__PACKAGE_NAME__/#__CLASS_NAME__/js/#__CLASS_NAME__-directives.js"></script>
    <script type="text/javascript" src="entities/#__PACKAGE_NAME__/#__CLASS_NAME__/js/#__CLASS_NAME__-services.js"></script>
    <script type="text/javascript" src="entities/#__PACKAGE_NAME__/#__CLASS_NAME__/js/#__CLASS_NAME__-controllers.js"></script>
    -->
    <!--ANGULAR-JS-COMPONENTS-MARKER-ENDS-HERE-->
</head>
<body ng-app="myApp" class="w3-sand">

<div class="wrapper">
    <div class="w3-bar w3-black no-print menus">
        <!--MENU-REGISTRATION-MARKER-->
        <!--
        <a class="w3-bar-item w3-btn" ui-sref="#__CLASS_NAME__.List({})" ui-sref-active="w3-teal">
            <i class="fas fa-users"></i>
            #__CLASS_NAME__
        </a>
        -->
        <a class="w3-bar-item w3-btn w3-right" onclick="window.print();">
            <i class="fas fa-print"></i>
            Print
        </a>
        <!--MENU-END-MARKER-->
    </div>

    <div>
        <ui-view></ui-view>
    </div>

</div>

</body>
</html>
