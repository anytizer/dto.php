/**
 * Services
 */

"use strict";

#__CLASS_NAME__App
    .service("#__CLASS_NAME__Service", ["$http", function($http)
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
            "#__CLASS_NAME__": {
                "search": function (record) {
                    return fetch("#__CLASS_NAME__/search", record);
                },

                "list": function (record) {
                    return fetch("#__CLASS_NAME__/list", record);
                },

                "details": function (record) {
                    return fetch("#__CLASS_NAME__/details", record);
                },

                "add": function (record) {
                    return fetch("#__CLASS_NAME__/add", record);
                },

                "edit": function (record) {
                    return fetch("#__CLASS_NAME__/edit", record);
                },

                "delete": function (record) {
                    return fetch("#__CLASS_NAME__/delete", record);
                },

                "flag": function (record) {
                    return fetch("#__CLASS_NAME__/flag", record);
                },

                // #__PUBLIC_METHODS__
            },
        }
    }]);