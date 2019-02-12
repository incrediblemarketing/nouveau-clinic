;(function ($, window, document, undefined) {
    'use strict';

    $(document).ready( function() {
        $('select').on('change', 'select', function(){
            var familyValue = $(this).val();
            alert('changed');
        });

    });

})(jQuery, window, document);
