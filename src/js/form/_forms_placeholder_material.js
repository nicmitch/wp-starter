/*
    Handle placeholder material forms
*/
import $ from "jquery";

function init() {

    // Change textarea height
    /*var textarea = document.getElementById('field-richiesta');

    textarea.addEventListener('keydown', autosize);

    function autosize() {
        var el = this;

        setTimeout(function() {
            el.style.cssText = 'height:auto;';
            el.style.cssText = 'height:' + el.scrollHeight + 'px';
        }, 1);

    }*/


    // comportamento finti placeholder
    $('input, select, textarea').on('focus', function() {
            $(this).parents('.input-wrapper').addClass('inputEntered');
            $(this).parents('.input-wrapper').addClass('inputEnteredActive');
        })
        .on('focusout', function() {

            $(this).parents('.input-wrapper').removeClass('inputEnteredActive');

            if (!$(this).val()) {
                $(this).parents('.input-wrapper').removeClass('inputEntered');
            }

        });



    function checkCheckbox(checkbox) {

        var icon = $(checkbox).siblings('i');

        if (checkbox.checked) {
            $(icon).addClass('active');
        } else {
            $(icon).removeClass('active');
        }

    }

    if ($('.checkbox-container .la-check')) {

        $('.checkbox-container input').each(function() {

            checkCheckbox(this);

        });

        $('.checkbox-container input').on('change', function() {

            checkCheckbox(this);

        });

    }

}

function destroy() {

    // Remove Event listener
    $('input, select, textarea').off('focus', 'focusout');

}

export { init, destroy };