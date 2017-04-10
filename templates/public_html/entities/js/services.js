"use strict";

#__CLASSNAME__App
	.service("#__CLASSNAME__Service", ["$http", function($http)
    {
		var fetch = function(urlpart, dataJSON)
		{
			//url = urlpart;
			var APIURL = "http://access.example.com:9090";
			var url = APIURL+"/"+urlpart;

			return $http({
				method: "POST",
				url: url,
				data: dataJSON,
				headers: {
					"X-Protection-Token": "",
					"Content-Type": "account/x-www-form-urlencoded",
				}
			});
		};

		return {
            "#__CLASSNAME__": {
                "list": function (record) {
                    return fetch("#__CLASSNAME__/list", record);
                },
                "details": function (record) {
                    return fetch("#__CLASSNAME__/details", record);
                },
                "add": function (record) {
                    return fetch("#__CLASSNAME__/add", record);
                },
                "edit": function (record) {
                    return fetch("#__CLASSNAME__/edit", record);
                },
                "delete": function (record) {
                    return fetch("#__CLASSNAME__/delete", record);
                },
                "flag": function (record) {
                    return fetch("#__CLASSNAME__/flag", record);
                },
				
				// #__PUBLIC_METHODS__
            },
        }
	}]);