/*  
    global angular 
    global ActiveXObject
    global hljs
*/
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


function makeHttpObject() {
    try {return new XMLHttpRequest();}
    catch (error) {}
    try {return new ActiveXObject("Msxml2.XMLHTTP");}
    catch (error) {}
    try {return new ActiveXObject("Microsoft.XMLHTTP");}
    catch (error) {}
    
    throw new Error("Could not create HTTP request object.");
}

function getCode(div, page){
    var request = makeHttpObject();
    request.open("GET", page, true);
    request.send(null);
    request.onreadystatechange = function() {
      if (request.readyState == 4) {
          var string = hljs.highlight("html", request.responseText);
          document.getElementById(div).innerHTML = string.value;
      }
    };

}