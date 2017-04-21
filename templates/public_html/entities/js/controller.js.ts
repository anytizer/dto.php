"use strict";

#__CLASSNAME__App.controller("#__CLASSNAME__Controller", ["$scope", "$state", "#__CLASSNAME__Service", function($scope, $state, #__CLASSNAME__Service)
{
	$scope.#__CLASSNAME__ = {
		"data": null,
		"list": function () {
			#__CLASSNAME__Service.#__CLASSNAME__.list()
				.then(function (response) {
					$scope.data = response.data;
				}, function (response) {
					// error
				});
		},
		"init": function()
		{
			$scope.#__CLASSNAME__.list();
		},
	};

	$scope.#__CLASSNAME__.init();
}]);

#__CLASSNAME__App.controller("#__CLASSNAME__DetailsController", ["$scope", "$stateParams", "$state","#__CLASSNAME__Service", function($scope, $stateParams, $state,  #__CLASSNAME__Service)
{
	var id = $stateParams.id;
	$scope.#__CLASSNAME__ = {
		"record": {},
		"details": function(id){
		#__CLASSNAME__Service.#__CLASSNAME__.details(id)
			.then(function(response){
				$scope.data = response.data;
			}, function(response){
				// error
			});
		},
		"init": function()
		{
			$scope.#__CLASSNAME__.details(id);
		},
	};

	$scope.#__CLASSNAME__.init();
}]);

#__CLASSNAME__App.controller("#__CLASSNAME__AddController", ["$scope", "$state", "#__CLASSNAME__Service", function($scope, $state, #__CLASSNAME__Service)
{
	$scope.#__CLASSNAME__ = {
		"add": function(record){
		#__CLASSNAME__Service.#__CLASSNAME__.add(record)
			.then(function(response){
				$scope.data = response.data;
			}, function(response){
				// error
			});
	},
	};
}]);

#__CLASSNAME__App.controller("#__CLASSNAME__EditController", ["$scope", "#__CLASSNAME__Service", function($scope, #__CLASSNAME__Service)
{
	$scope.#__CLASSNAME__ = {
		"error": "",
		"edit": function (record) {
			#__CLASSNAME__Service.#__CLASSNAME__.edit(record)
				.then(function (response) {
					$scope.data = response.data;
				}, function (response) {
					// error
				});
		},
	};
}]);

#__CLASSNAME__App.controller("#__CLASSNAME__DeleteController", ["$scope", "#__CLASSNAME__Service", function($scope, #__CLASSNAME__Service)
{
	$scope.#__CLASSNAME__ = {
		"error": "",
		"delete": function (record) {
			#__CLASSNAME__Service.#__CLASSNAME__.delete(record)
				.then(function (response) {
					$scope.data = response.data;
				}, function (response) {
					// error
				});
		},
	};
}]);

#__CLASSNAME__App.controller("#__CLASSNAME__FlagController", ["$scope", "#__CLASSNAME__Service", function($scope, #__CLASSNAME__Service)
{
	$scope.#__CLASSNAME__ = {
		"error": "",
		"flag": function (record) {
			#__CLASSNAME__Service.#__CLASSNAME__.flag(record)
				.then(function (response) {
					$scope.data = response.data;
				}, function (response) {
					// error
				});
		},
	};
}]);

signupsApp.controller("WelcomeController", ["$scope", "#__CLASSNAME__Service", function($scope, signupsService)
{
	$scope.#__CLASSNAME__ = {
		"welcome": "",
	};
}]);
// #__PUBLIC_METHODS__
