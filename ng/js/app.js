/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */




  'use strict';
  angular.module("tk", ['tk.controllers']).config(['$routeProvider' , function($rp){
    $rp.when("/", {
    templateUrl: "tpl/index.html",
    controller: "indexCtrl"
    }).otherwise( {
    templateUrl: "tpl/index.html",
    controller: "indexCtrl"
    });
  
}]);