 var app = angular.module("myApp",[],function($interpolateProvider){
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
    });

	var books = [];
    var users = [];
    var maxRow = 5;
    var currentPage;
    var maxPageUser = 1;
    var maxPageBook = 1;
