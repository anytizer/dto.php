/**
 * Services
 */

"use strict";

#__CLASS_NAME__App
    .service("#__CLASS_NAME__Service", ["$http", function($http)
    {
        var fetch = function(urlpart, dataJSON)
        {
            //var APIURL = "http://access.example.com:9090/api-v0.0.1";
            var APIURL = "#__ENDPOINT_URL__";
			// "http://localhost/angular/application/access/public_html/v1";
            var url = APIURL+"/#__PACKAGE_NAME__/#__CLASS_NAME__/"+urlpart;

            return $http({
                method: "POST",
                url: url,
                data: dataJSON,
                headers: {
                    "X-Protection-Token": "",
                    "Content-Type": "application/x-www-form-urlencoded",
                }
            });
        };

        return {
            "#__CLASS_NAME__": {
                "search": function (data) {
                    return fetch("search", data);
                },

                "list": function (data) {
                    return fetch("list", data);
                },

                "details": function (data) {
                    return fetch("details", data);
                },

                "add": function (data) {
                    return fetch("add", data);
                },

                "edit": function (data) {
                    return fetch("edit", data);
                },

                "delete": function (data) {
                    return fetch("delete", data);
                },

                "flag": function (data) {
                    return fetch("flag", data);
                },

                #__ANGULAR_SERVICES__
            },
        }
    }]);