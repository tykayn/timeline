 angular.module("tk.controllers", []).controller('indexCtrl',['$scope' , function($scope){
    console.log("yeoooooo");
    d = new Date()
    $scope.ans = 0
    $scope.futur = d.getFullYear() + $scope.ans 
    
    $scope.calcul =     function(obj,brutannuel){
            console.log("brutannuel" + brutannuel);
      var result =   obj / brutannuel * 0.77  ; // convertir le brut annuel en net
      
      console.log("result " + result+' mois');
      console.log("result " + result*31 +' jours');
        if( result < 0.5){
         var h = result *5*31*7
            return h.toFixed(2)  + ' heures';
        }
        else
        if( result < 1){
         var jours = result *31
            return jours.toFixed(2)  + ' jours';
        }
        else if( result < 12){
            return result.toFixed(2)  + ' mois';
        }
        else if(result > 11){
             var ans = result / 12 
         $scope.futur =  parseFloat(d.getFullYear()) + parseFloat(ans.toFixed(1))
            return ans.toFixed(1) + ' ans';
            
        }
        else{
            return 'meeeh'
        }
        return 'heh'
    }
    
    
    $scope.profil = 1398.37;
    $scope.test = 'hello le test';
    $scope.brutannuel = 38000;
    $scope.prixObjet = 100;
    $scope.objets = 20;
}])
