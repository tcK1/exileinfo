var app = angular.module("ExileInfo", ['ngRoute', 'angulartics', 'angulartics.google.analytics']);

app.config(function($routeProvider, $locationProvider){
    $routeProvider
        .when('/legacy', {
            templateUrl: "leagues/legacy.html"
        })
        .when('/hclegacy', {
            templateUrl: "leagues/hclegacy.html"
        })
        .otherwise({ redirectTo: '/legacy' });
    // Remove comment when htacces is right
    // $locationProvider.html5Mode(true);
});

app.controller('navCtrl', function ($location, $scope) {
  $scope.currentPage = "legacy";
  $scope.go = function (page) {
    $location.path('/' + page);
  };
});