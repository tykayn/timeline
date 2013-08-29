/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery(document).ready(function($){
  
    boxes = $('.timelinebloc:not(.marqueur)');
    line_height = $('.timelinebloc:first-child').height() / 2 ;
    line_height = 50 ;
    int = 0;
    box_w = 150;

    /**
     * détection de superposition
     * @param {type} box
     * @param {type} other
     * @returns {Boolean}
     */
    function isOver( box, other){
        box  = $(box);
        other  = $(other);
        if( box.css('left') <= other.css('left') && box.width() + box.css('left') >= other.css('left') ){
            return true;
        }
        else{
        return false;
        }
    }
    /**
     * 
     * @param {type} obj
     * @returns {undefined}
     */
    function dump(obj) {
    var out = '';
    for (var i in obj) {
        out += i + ": " + obj[i] + "\n";
    }

   //  console.log(out);
}
    /**
     * 
     * @param {type} obj
     * @returns {undefined}
     */
    function testOver(obj){
        dump(obj.w)
      // //  console.log( ' looooog '+ eval(obj) )
    }
    /**
     * 
     * @returns {undefined}
     */
    function disOverlap(){

        //si bloc sort du champ de vision, le décaler a gauche
               
               frisew = $(this).parent().width();
               
            //$('.timeline-tk').first().width();
        
        
        
        i=0;
        boxPos= new Array();
        $('.box-frise').each( function(){
         self = $(this);
         self.data('line','1');
            boxPos[i] = self.position();
            boxPos[i].w = self.width();
            boxPos[i].h = self.height();
            i++;
            leftpos = $(this).position().left;
            diffw = frisew - $(this).width();
            if(  leftpos + self.width() > frisew  ){
               //  console.log( ' position ' + leftpos + ' , '+ diffw );
                self.css('margin-left', '-' + (leftpos + self.width() - frisew) + 'px' );
               //  console.log( 'marge left: ' + self.css('margin-left') )
            }
        });
        
        //prendre les W et H de la boite actuelle
        currPos = $(this).position();
        currPos.w = $(this).width();
        currPos.h = $(this).height();
       //  console.log(currPos);
        //boucler sur chacune pour tester les coordonnées qui se superposent
        testOver( currPos )
       //$(boxPos).each( testOver( $(this) ))
        
        int++;
        $(this).css('margin-top', int*line_height ).css('border','solid 0px');
        $('.timeline-tk').css('height',int*line_height +150 );
    //  console.log(int);
     
     if( self.data('jours') == 0){
        //  console.log('OOOOOOOH')
         self.css('width','100px !important');
        //  console.log( self )
     }
    }
    //si superposé, bouger la div de une ligne de haut
    
    
    i=0
boxes = new Array();
    
    
    
     /**
     * attribuer des data numéro de ligne, numéro de boite et créer un tableau avec ces données
     */
    $('.box-frise').each(function(index){
        
        
    i = index;
    if( boxes === undefined){
       i=0;
       boxes = new Array();
    }
        boxes = new Array();
        self = $(this);
        self.attr('data-line' , 1 );
        self.attr('data-num' , i).prepend(i +' <br/>');
                //.prepend('YEEEEEEE').prepend('IIIIIH');
     //   boxes[i]['w'] = self.width();
      //  boxes[i]['l'] = self.css('left');
      //  boxes[i]['j'] = self.attr('data-jours');
      //  console.log( self.attr('data-num') );
        i++;
        return self , boxes, i ;
    });
    $('.box-frise').each(function(){
        courant = $(this).attr('data-num') * 1;
        sup = courant + 1;
        
        /**
         * comparaison de superposition si les deux boites existent
         */
        if( $('.box-frise')[ sup ] !== undefined ){
            obj1 = $('.box-frise')[ courant ];
       obj2 = $('.box-frise')[ sup ];
        //console.log( obj1 +' '+ obj2 );
        
        if ( isOver(obj1 , obj2) ){
            line = $(obj1).attr('data-line');
            $(obj1).attr('data-line' , (line*1 +1)  ).css('top' , (line*1 +1) * line_height).prepend( ' ligne ' + (line*1 +1)  + 'TRUE');
        }
        
        }
       
    });
    
    
    if( prettyPrint() !== undefined){
       $('code, textarea').addClass('prettyprint linenums');
       $('.prettyprint').prettyPrint(); 
    }
    
});
