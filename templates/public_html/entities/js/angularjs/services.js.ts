/**
 * Services
 */

"use strict";

#__CLASS_NAME__App
    .service("#__CLASS_NAME__Service", ["$http", function($http)
    {
        let fetch = function(urlpart, dataJSON)
        {
            /**
             * Link to api.php project's src/ path
             */
            const APIURL = "#__ENDPOINT_URL__"; // "../api.php/src"
            const url = APIURL+"/#__PACKAGE_NAME__/#__CLASS_NAME__/"+urlpart;

            return $http({
                method: "POST",
                url: url,
                data: dataJSON,
                headers: {
                    "X-Protection-Token": "",
                    "Content-Type": "application/json", // x-www-form-urlencoded
                }
            });
        };

        return {
            "#__CLASS_NAME__": {
                #__ANGULAR_SERVICES__
            },
        }
    }]);
