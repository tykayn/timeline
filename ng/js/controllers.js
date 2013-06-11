 angular.module("tk.controllers", []).controller('indexCtrl',['$scope' , function($scope){
    console.log("yeoooooo");
    $scope.calcul = function(obj){
       var result =  obj / $scope.brutannuel / 12 * 0.77  // mois
        if( result < 12){
            return result + ' mois';
        }
        else if(result > 11){
            return (result / 12) + ' ans';
        }
        else{
            return 'meeeh'
        }
    }
    $scope.test = 'hello le test';
    $scope.brutannuel = 40000;
    $scope.prixObjet = 100;
    $scope.objets = 20;
}])
