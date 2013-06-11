angular.filter('monnaie', function(input, curSymbol, decPlaces, thouSep, decSep) {
    var curSymbol = curSymbol || "€";
    var decPlaces = decPlaces || 2;
    var thouSep = thouSep || " ";
    var decSep = decSep || ",";

  // Check for invalid inputs
  var out = isNaN(input) || input === '' || input === null ? 0.0 : input;

  //Deal with the minus (negative numbers)
  var minus = input < 0;
  out = Math.abs(out);
  out = angular.filter.number(out, decPlaces);

  // Replace the thousand and decimal separators.  
  // This is a two step process to avoid overlaps between the two
  if(thouSep != ",") out = out.replace(/\,/g, "T");
  if(decSep != ".") out = out.replace(/\./g, "D");
  out = out.replace(/T/g, thouSep);
  out = out.replace(/D/g, decSep);


  // Add the minus and the symbol
  if(minus){
    return "-" + out + ' ' + curSymbol;
  }else{
    return  out + ' ' + curSymbol;
  }

});