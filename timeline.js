/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery(document).ready(function($){
  
    boxes = $('.timelinebloc:not(.marqueur)');
    line_height = $('.timelinebloc:first-child').height() / 2 ;
    int = 0;
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
    function testOver(){
        console.log( ' looooog '+this.w )
    }
    function disOverlap(){
        // prendre les W et H de toutes les boites
        i=0;
        boxPos= new Array();
        $('.box-frise').each( function(){
            boxPos[i] = $(this).position();
            boxPos[i].w = $(this).width();
            boxPos[i].h = $(this).height();
            i++;
        });
        
        //prendre les W et H de la boite actuelle
        currPos = $(this).position();
        currPos.w = $(this).width();
        currPos.h = $(this).height();
        console.log(currPos);
        //boucler sur chacune pour tester les coordonnées qui se superposent
        $(boxPos).each( testOver)
        
        int++;
        $(this).css('margin-top', int*line_height ).css('border','solid 0px');
        $('.timeline-tk').css('height',int*line_height +150 );
     console.log(int);
    }
    //si superposé, bouger la div de une ligne de haut

    $('.box-frise').each(disOverlap);
});
