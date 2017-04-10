// routes.js
"use strict";

var template = function _template(path)
{
	var TEMPLATES_URL = "http://localhost/angular/libraries/dto.php/dev/output/public_html/entities";
	return TEMPLATES_URL+"/"+path+".html";
};

// #__CLASSNAME__
#__CLASSNAME__App.config(function($stateProvider, $urlRouterProvider){
	
	//
	$urlRouterProvider.otherwise("/");

	$stateProvider
		.state("#__CLASSNAME__", {
			url: "/",
			templateUrl: template("#__CLASSNAME__/templates/welcome"),
			controller: "#__CLASSNAME__Controller",
		})
		.state("#__CLASSNAME__.list", {
			url: "/list",
			templateUrl: template("#__CLASSNAME__/templates/list"),
			controller: "#__CLASSNAME__ListController",
		})
		.state("#__CLASSNAME__.details", {
			url: "/details",
			templateUrl: template("#__CLASSNAME__/templates/details"),
			controller: "#__CLASSNAME__DetailsController",
		})
		.state("#__CLASSNAME__.add", {
			url: "/add",
			templateUrl: template("#__CLASSNAME__/templates/add"),
			controller: "#__CLASSNAME__AddController",
		})
		.state("#__CLASSNAME__.edit", {
			url: "/edit",
			templateUrl: template("#__CLASSNAME__/templates/edit"),
			controller: "#__CLASSNAME__EditController",
		})
		.state("#__CLASSNAME__.delete", {
			url: "/delete",
			templateUrl: template("#__CLASSNAME__/templates/delete"),
			controller: "#__CLASSNAME__DeleteController",
		})
		.state("#__CLASSNAME__.flag", {
			url: "/flag",
			templateUrl: template("#__CLASSNAME__/templates/flag"),
			controller: "#__CLASSNAME__FlagController",
		})
	;
});