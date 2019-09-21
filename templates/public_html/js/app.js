var myApp = angular.module("myApp", ["ui.router"]);

myApp.config(function ($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise("/Users");
});

myApp.service("APIService", ["$http", function ($http) {
    const api = "/api";
    return {
        "missing_save": function (data) {
            return $http({
                method: "POST",
                url: api + "/missing/save",
                data: data
            });
        },
    };
}]);

myApp.filter("default", function () {
    return function (input, defaultValue = "-") {
        if (angular.isUndefined(input) || input === null || input === "") {
            return defaultValue;
        }

        return input;
    }
});
