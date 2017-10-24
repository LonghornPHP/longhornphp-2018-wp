import Popper from 'popper.js/dist/umd/popper.js';
window.Popper = Popper;
import 'bootstrap';

jQuery(document).ready(function($){
    if (typeof Tito !== "undefined") {
        Tito.on('event:landing', function(data){
            $('.tito-discount-code-field').val('');
        })
    }
});