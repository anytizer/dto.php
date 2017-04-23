/**
 * routes.js __CLASS_NAME__
 */
"use strict";
#__CLASS_NAME__App.config(function($stateProvider, $urlRouterProvider)
{
	var template = function _template(path)
	{
		var TEMPLATES_URL = "http://localhost/angular/libraries/dto.php/dev/output/public_html/entities";
		return TEMPLATES_URL+"/"+path+".html";
	};

	$urlRouterProvider.otherwise("/welcome");

	$stateProvider
		.state("#__CLASS_NAME__", {
			url: "/welcome",
			templateUrl: template("#__CLASS_NAME__/templates/welcome"),
			controller: "#__CLASS_NAME__WelcomeController",
		})
		.state("#__CLASS_NAME__.list", {
			url: "/list",
			templateUrl: template("#__CLASS_NAME__/templates/list"),
			controller: "#__CLASS_NAME__ListController",
		})
		.state("#__CLASS_NAME__.details", {
			url: "/details",
			templateUrl: template("#__CLASS_NAME__/templates/details"),
			controller: "#__CLASS_NAME__DetailsController",
		})
		.state("#__CLASS_NAME__.add", {
			url: "/add",
			templateUrl: template("#__CLASS_NAME__/templates/add"),
			controller: "#__CLASS_NAME__AddController",
		})
		.state("#__CLASS_NAME__.edit", {
			url: "/edit",
			templateUrl: template("#__CLASS_NAME__/templates/edit"),
			controller: "#__CLASS_NAME__EditController",
		})
		.state("#__CLASS_NAME__.delete", {
			url: "/delete",
			templateUrl: template("#__CLASS_NAME__/templates/delete"),
			controller: "#__CLASS_NAME__DeleteController",
		})
		.state("#__CLASS_NAME__.flag", {
			url: "/flag",
			templateUrl: template("#__CLASS_NAME__/templates/flag"),
			controller: "#__CLASS_NAME__FlagController",
		})

        #__PUBLIC_METHODS__
	;
});