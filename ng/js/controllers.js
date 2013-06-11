 angular.module("tk.controllers", []).controller('indexCtrl',['$scope' , function($scope){
    console.log("yeoooooo");
    d = new Date()
    $scope.ans = 0
    $scope.futur = d.getFullYear() + $scope.ans 
    
    $scope.calcul =     function(obj,brutannuel){
     
      var netannuel = brutannuel * 0.77  ;
      var netmensuel = netannuel/12  ;
      var nethoraire = netmensuel / 151;
      var result =   obj / netmensuel; 
        console.log("brutannuel " + obj + " netmensuel " + netmensuel);
      console.log(obj + "€ = result " + result+' mois');
      console.log(obj + "€ = result " + result*31 +' jours');
        if( result < 0.5){
         var h = result *151;
            return h.toFixed(2)  + ' heures';
        }
        else
        if( result < 1){
         var jours = result *31;
            return jours.toFixed(2)  + ' jours';
        }
        else if( result < 12){
            return result.toFixed(2)  + ' mois';
        }
        else if(result > 11){
             var ans = result / 12 ;
         $scope.futur =  parseFloat(d.getFullYear()) + parseFloat(ans.toFixed(1));
            return ans.toFixed(1) + ' ans';
            
        }
        else{
            return 'meeeh';
        }
    }
    
    $scope.millions = function(nombre){
        if( nombre*12*0.77 > 100000){
            var pognon = nombre*12*0.77 / 1000000
            return 'soit '+ pognon.toFixed(2)  + ' millions d\'€' ;
        }
    }
    $scope.profil = 1398.37;
    $scope.test = 'hello le test';
    $scope.brutannuel = 38000;
    $scope.prixObjet = 100;
    $scope.objets = 20;
}])
