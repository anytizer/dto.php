/**
 * routes.js #__CLASS_NAME__
 */
"use strict";
#__CLASS_NAME__App.config(function($stateProvider, $urlRouterProvider)
{
	var template = function _template(path)
	{
		var TEMPLATES_URL = "#__PUBLIC_URL__/entities/#__PACKAGE_NAME__/#__CLASS_NAME__/html/"+path;
		console.log("Loading: "+TEMPLATES_URL);
		return TEMPLATES_URL;
	};

	$urlRouterProvider.otherwise("/#__CLASS_NAME__");

	$stateProvider
		.state("#__CLASS_NAME__", {
			url: "/#__CLASS_NAME__",
			templateUrl: template("welcome.html"),
		})
		.state("#__CLASS_NAME__.list", {
			url: "/list",
			templateUrl: template("list.html"),
			controller: "#__CLASS_NAME__ListController",
		})
		.state("#__CLASS_NAME__.details", {
			url: "/details",
			templateUrl: template("details.html"),
			controller: "#__CLASS_NAME__DetailsController",
		})
		.state("#__CLASS_NAME__.add", {
			url: "/add",
			templateUrl: template("add.html"),
			controller: "#__CLASS_NAME__AddController",
		})
		.state("#__CLASS_NAME__.edit", {
			url: "/edit",
			templateUrl: template("edit.html"),
			controller: "#__CLASS_NAME__EditController",
		})
		.state("#__CLASS_NAME__.delete", {
			url: "/delete",
			templateUrl: template("delete.html"),
			controller: "#__CLASS_NAME__DeleteController",
		})
		.state("#__CLASS_NAME__.flag", {
			url: "/flag",
			templateUrl: template("flag.html"),
			controller: "#__CLASS_NAME__FlagController",
		})

        #__ANGULAR_ROUTES__
	;
	
	// $locationProvider.html5Mode(true); //Remove the '#' from URL.
});