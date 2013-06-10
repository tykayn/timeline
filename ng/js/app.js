/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */




  'use strict';
angular.module('tk', []).config(['$routeProvider' , function($rp){
    $rp.when("/", {
    template: "<h2>scope App version: {{ scopedAppVersion }}</h2>",
    controller: "View1Ctrl"
    });
  
}]);

