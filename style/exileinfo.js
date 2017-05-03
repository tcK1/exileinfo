var app = angular.module("ExileInfo", ['ngRoute']);

app.run(['$rootScope', '$location', '$window',
    function($rootScope, $location, $window) {
      $rootScope.$on('$routeChangeSuccess',
        function(event) {
          if (!$window.ga) {
            return;
          }
          $window.ga('send', 'pageview', {
            page: $location.path()
          });
        });
    }
]);
  
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