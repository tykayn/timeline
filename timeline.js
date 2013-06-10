/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery(document).ready(function($){
  
    boxes = $('.timelinebloc:not(.marqueur)');
    line_height = $('.timelinebloc:first-child').height() / 2 ;
    int = 0;
    box_w = 150;
    /*
     * détection de superposition
     */
    function isOver( box, other){
        
        if( box.left <= other.left && box.w + box.left >= other.left){
            return true;
        }
        else{
        return false;
        }
    }
    function dump(obj) {
    var out = '';
    for (var i in obj) {
        out += i + ": " + obj[i] + "\n";
    }

    console.log(out);
}
    function testOver(obj){
        dump(obj.w)
      //  console.log( ' looooog '+ eval(obj) )
    }
    function disOverlap(){
        // prendre les W et H de toutes les boites
        i=0;
        boxPos= new Array();
        $('.box-frise').each( function(){
         self = $(this);
         self.data('line','1');
            boxPos[i] = self.position();
            boxPos[i].w = self.width();
            boxPos[i].h = self.height();
            i++;
        });
        
        //prendre les W et H de la boite actuelle
        currPos = $(this).position();
        currPos.w = $(this).width();
        currPos.h = $(this).height();
        console.log(currPos);
        //boucler sur chacune pour tester les coordonnées qui se superposent
        testOver( currPos )
       //$(boxPos).each( testOver( $(this) ))
        
        int++;
        $(this).css('margin-top', int*line_height ).css('border','solid 0px');
        $('.timeline-tk').css('height',int*line_height +150 );
     console.log(int);
    }
    //si superposé, bouger la div de une ligne de haut

    $('.box-frise').each(disOverlap);
    $('code, textarea').addClass('prettyprint linenums');
});
