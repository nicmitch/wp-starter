//import Foundation from "foundation-sites";
//import "foundation-sites";
//import { Accordion } from 'foundation-sites';
//import { Accordion, DropdownMenu, Reveal } from 'foundation-sites';
//import $ from "jquery";
//const $ = window.jQuery;

import $ from "jquery";
import "foundation-sites";

const init = () => {

    // Globally
    $(document).foundation();

    /*
    $(window).on('load', function(){
        console.log('ok');

        let ofAge = window.localStorage.getItem('bot-checkIsOk');
        
        if($('#age-control').length && ofAge != 'yes'){
            $('#age-control').foundation('open');
        }
    });


    if (typeof window !== 'undefined') {
        window.localStorage.setItem('bot-checkIsOk', 'yes');
    }

    $(document).on('open.zf.reveal', function(event) {
		$('body, html').addClass('is-reveal-open');

    $(event.target).addClass('open');
		$(event.target).parents('.reveal-overlay').addClass('open');
	});

    $(document).on('closed.zf.reveal', function(event) {
		$('body, html').removeClass('is-reveal-open');

    $(event.target).removeClass('open');
		$(event.target).parents('.reveal-overlay').removeClass('open');
	});
*/


    /*
    const $accordion = new Accordion($('[data-accordion]'));
    const $dropdownmenu = new DropdownMenu($('[data-dropdown-menu]'));
    const $reveal = new Reveal($('#exampleModal1'));

    console.log($reveal);

    $reveal.isActive = true;
    */

    /*

    // Or Manually
    var forms = [];
    $('form[data-abide]').each(function(){

    var elem = new Foundation.Abide( $(this) );

    forms.push(elem);
    });

    var menus = [];
    menus.push( new Foundation.ResponsiveMenu($('.menu')) );
    */

    /*
    if( document.getElementById("sidebar-sticky") ){

    var elem = new Foundation.Sticky(
    $('#sidebar-sticky'),
    {
    'anchor' : 'sidebar',
    'sticky-on' : 'large'
    }
    );

    }
    */
};

export default { init };
