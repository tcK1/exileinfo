var app = angular.module("ExileInfo", ['ngRoute']);

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

app.controller('navCtrl', function ($location, $scope, $window) {
  $scope.$on('$viewContentLoaded', function(event) {
    $window.ga('send', 'pageview', { page: $location.url() });
  });
  $scope.currentPage = "legacy";
  $scope.go = function (page) {
    $location.path('/' + page);
  };
});