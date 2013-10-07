jQuery(document).ready(function($) {
    /**
     * configs
     */
    boxes = $('.timelinebloc:not(.marqueur)');
    line_gap = 4;
    line_height = $('.timelinebloc:first-child').outerHeight()+line_gap;
    int = 0;
    box_w = 150;

    /**
     * 
     * @param {type} index
     * @param {type} i
     * @returns {unresolved}
     */
    function getbox(index, i) {
        obj = $('.timeline-tk:nth-child(' + index + ')').add('.box-frise:nth-child(' + i + ')')
        obj.left = parseInt(obj.css('left'));
        obj.w = parseInt(obj.width());

        obj.line = parseInt(obj.data('line'));

        return obj;
    }
    /*
     * détection de superposition
     */
    function isOver(box, other) {
        box.addClass('testing');
        other.addClass('testing');
        // console.log('-')


        if (box.left <= other.left && parseInt(box.w + box.left) > other.left && box.line == other.line) {

            // console.log('###########------- YES -------')
            box.removeClass('testing');
            other.removeClass('testing');
            result = true

            return result;
        }
        else {

            box.removeClass('testing');
            other.removeClass('testing');
            result = false
            return result;
        }



    }
    function dump(obj) {
        var out = '';
        for (var i in obj) {
            out += i + ": " + obj[i] + "\n";
        }

        // console.log(out);
    }


    /**
     * dans chaque frise, boucler sur le nombre de boites
     * a chaque fois, si ce n'est pas la dernière, comparer avec toutes les boites précédentes de la frise.
     * 
     * FRISE
     * div class="timeline-tk"
     * data-events="2"
     * data-jours="4015"
     * css width
     * 
     * BOX
     * data-nb="1"
     * data-jours="0"
     * data-line="0"
     * css width
     * css left
     * @returns {undefined}
     */
    function suite(index) {


        self = $(this); // self est une FRISE
        self.before('FRISE ' + index)
        frise = {};
        frise.events = self.data('events');
        frise.jours = self.data('jours');
        frise.width = self.outerWidth();

        for (i = 1; i < frise.events + 1; i++) {
            box0 = getbox(index, i);
            box1 = getbox(index, (i * 1 + 1));
            // si c'est pas la dernière boite, tester superposition avec toutes celles d'avant.

            for (j = 1; j < i; j++) {
                // console.log(' test de frise ' + index + ' box ' + j + ' VS frise ' + index + ' box ' + (i * 1 + 1) + '')

                if (isOver(getbox(index, j), box1)) {
                    // console.log('==========>YES passage a la ligne de ' + box1.line)
                    box1.data('line', (parseInt(box1.line) + 1));
                    box1.line++; //changer aussi la ligne dans l'objet représentant le bloc
                    // console.log('a la ligne ' + box1.data('line'))
                }
            }
            // console.log(' test de frise ' + index + ' box ' + i + ' VS frise ' + index + ' box ' + (i * 1 + 1) + '')

            if (isOver(box0, box1)) {

                // console.log('############## YES passage a la ligne de ' + box1.line)
                box1.data('line', (parseInt(box1.line)) + 1);
                box1.line++; //changer aussi la ligne dans l'objet représentant le bloc
                // console.log('a la ligne ' + box1.data('line'))
            }

        }

    }
    /**
     * ajuste les hauteur de frise selon le nombre de lignes
     * @returns {undefined}
     */
    function hauteurfrise() {

        self = $(this)
        events = self.data('events');
        //trouver la ligne la plus élevée
        max = 0;
        self.add('.box-frise').each(function() {
            // console.log($(this).data('line'));
            if (parseInt($(this).data('line')) > max) {
                max = parseInt($(this).data('line'));
                // console.log(max + '  max');
                
            }
        })
        max += 1; // rajout de une hauteur pour une lecture plus facile
        int = max * line_height;
        self.css('height', int).css('border', '0');
        // console.log(max + ' lignes, hauteur de frise ' + int);
    }
    /**
     * a faire sur toutes les boxes.
     * @returns {undefined}
     */
    function lignage() {
        self = $(this)
        cetteligne = self.data('line');
        plushaut = cetteligne * line_height
        self.css('margin-top', plushaut) // .append('ligne ' + cetteligne);
        // console.log('ligne ' + cetteligne + '  marge top de box ' + plushaut);
    }

    $('.timeline-tk').each(suite);
    $('.box-frise').each(lignage);
    $('.timeline-tk').each(hauteurfrise);
    $('code, textarea').addClass('prettyprint linenums');
});
