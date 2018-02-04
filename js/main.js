import Popper from 'popper.js/dist/umd/popper.js';
window.Popper = Popper;
import 'bootstrap';
var jQuery = require('jquery');

jQuery(document).ready(function($){
    if (typeof Tito !== "undefined") {
        Tito.on('event:landing', function(data){
            $('.tito-discount-code-field').val('');
        })
    }

    if ($('.page-template-sessions').length && window.location.hash != '') {
        let talk_id = window.location.hash + '-description';
        if ($(talk_id).length) {
            $(talk_id).collapse('show');
        }
    }

    if ($('.page-template-venue').length) {
        $('.page-template-venue').scrollspy({ target: '#venue-nav', offset: 50 });
    }
});