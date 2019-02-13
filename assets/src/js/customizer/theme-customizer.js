(function($, window, document, undefined) {
    'use strict';

    $(document).ready(function() {
        var gFamilies = [
            'im_fonts_body',
            'im_fonts_h1',
            'im_fonts_h2',
            'im_fonts_h3',
            'im_fonts_h4',
            'im_fonts_h5',
            'im_fonts_h6',

        ];

        for (var i in gFamilies) {

            customizerSelect(gFamilies[i]);
        }

        function customizerSelect(gFamily) {
            wp.customize(gFamily + '_family', function(value) {
                var weightSelect = 'li#customize-control-' + gFamily + '_weight';
                value.bind(function(fontfamily) {
                    $.ajax({
                        url: INCRED.ajax_url,
                        type: 'get',
                        data: {
                            action: 'get_font_weights',
                            fontfamily: fontfamily,
                            weightSelect: weightSelect
                        },
                        success: function(response) {
                            // alert(weightSelect);
                            $(weightSelect).find('select').empty().append(response).trigger('change');
                        }
                    });
                });
            });
        }
        $(window).on('load', function(){
            $('input.input_size').parent('li').append('<em style="display:inline-block;">px</em>');
        });
        

    });

})(jQuery, window, document);