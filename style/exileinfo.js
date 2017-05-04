var app = angular.module("ExileInfo", ['ngRoute', 'angulartics', 'angulartics.google.analytics']);

app.config(function($routeProvider, $locationProvider){
    $routeProvider
        .when('/legacy', {
            templateUrl: "leagues/legacy.html"
        })
        .when('/hclegacy', {
            templateUrl: "leagues/hclegacy.html"
        })
        .when('/info', {
            templateUrl: "info.html"
        })
        .when('/docs', {
            templateUrl: "docs.html"
        })
        .otherwise({ redirectTo: '/legacy' });
    $locationProvider.html5Mode(true);
});

app.controller('navCtrl', function ($location, $scope) {
    $scope.currentPage = "legacy";
    $scope.go = function (page) {
        $location.path('/' + page);
    };
});