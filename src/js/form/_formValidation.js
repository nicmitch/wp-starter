import $ from "jquery";
import foundation from "foundation-sites";
//import whatInput from 'what-input';

export default function formValidation() {
    let formAction;
    let formIsAjax;
    let formHideAfterDone;

    /*
        Form with foundation abide: invalid form
    */
    $(document).on("forminvalid.zf.abide", function(ev, frm) {

        // Scroll to alert callout
        var target = frm.find('.alert.callout');
        if (target.length > 0) {
            $('html, body').animate({ scrollTop: target.offset().top - 20 }, 600);
        }
    });

    /*
        Form with foundation abide: valid form
    */
    $(document).on("formvalid.zf.abide", function(ev, frm) {

        // Disable form and show loading/processing effect
        frm.addClass('submitting');

        // Disable submit button
        frm.find('[type="submit"]').attr('disabled', 'disabled');

        // Get vars from form

        formIsAjax = frm.find('.form_is_ajax').val();
        formHideAfterDone = frm.find('#hide_after_done-field').val() ? frm.find('#hide_after_done-field').val() : 'yes';
        formHideAfterDone = formHideAfterDone === 'no' ? false : true;

        //Check Honeypot
        let x = document.forms["contact_form"]["HNome"].value;
        if (x == "" || x == null) {
            //If you are not a bot
            formAction = frm.find('.form_action').val();
        } else {
            //if you are a bot
            alert('Messaggio inviato');
            return false;
        }

        if (formIsAjax == "1") {
            formIsAjax = true;
        } else {
            formIsAjax = false;
        }

        if (formIsAjax) {
            /*
                Handle ajax form with jquery
            */
            $.ajax({
                type: "POST",
                url: formAction,
                data: frm.serialize(),
                dataType: 'json',

                success: function(returnData, status, request) {
                    console.log(returnData);
                    /*
                        Ajax called successfully: check data retuned by server
                    */
                    if (returnData.success) {
                        /*
                            Server response ok:
                            - remove submitting class
                            - enable button
                            - fadeout form fields
                            - show ok message and scroll to it
                            - send ga event?
                        */
                        console.log('Form sending');

                        frm.removeClass('submitting');
                        frm.find('[type="submit"]').removeAttr('disabled');

                        if (formHideAfterDone === true) {
                            frm.find('.form-fields').fadeOut(500);
                        }

                        frm.find('.mail-message-ok').fadeIn(300, function() {
                            $('html, body').animate({
                                scrollTop: frm.find('.mail-message-ok').offset().top - 60
                            }, 600);
                        });

                        /*
                            Google Analytics Event Tracking: choose either one between ga and gtag
                        */
                        // analyticsEventsTracking: ga
                        if (typeof window.ga === 'function') {
                            console.log("[analyticsEventsTracking-ga] Form submit");
                            ga('send', 'event', 'Goal', 'Richiesta informazioni');
                        }
                        /*
                        // analyticsEventsTracking: gtag
                        if (typeof window.gtag === 'function') {
                            window.gtag('event', 'Richiesta informazioni', {
                                'event_category': 'Goal',
                                'event_label': '',
                                'value': ''
                            });
                        }
                        */
                    } else {
                        /*
                            Server response not ok:
                            - re-enable form
                            - show error message
                        */
                        console.log(returnData);
                        frm.removeClass('submitting');
                        frm.find('[type="submit"]').removeAttr('disabled');

                        frm.find('.mail-message-error p:first-child').append(": " + returnData.errormsg);
                        frm.find('.mail-message-error').delay(500).fadeIn(300, function() {
                            $('html, body').animate({
                                scrollTop: frm.find('.mail-message-error').offset().top - 60
                            }, 600);
                        });
                    }
                },

                error: function(request, status, errorThrown) {
                    /*
                        Ajax call error
                    */
                    console.log(errorThrown);
                    frm.removeClass('submitting');
                    frm.find('[type="submit"]').removeAttr('disabled');
                    frm.find('.mail-message-error').delay(500).fadeIn(300, function() {
                        $('html, body').animate({
                            scrollTop: frm.find('.mail-message-error').offset().top - 60
                        }, 600);
                    });
                }
            });
        } else {
            /*
                Handle non ajax form with standard form action
            */
            // console.log("formAction: " + formAction);
            frm.attr('action', formAction);
            //frm.submit();
        }
    });



    /*
        Form with foundation abide: on submit
    */
    $(document).on("submit", function(ev) {
        if (formIsAjax) {
            ev.preventDefault();
        }
    });



    /*
        Handle form-reload
    */
    $('#form-reload').click(function(event) {
        event.preventDefault();
        let frm = document.getElementsByName('contact_form')[0];
        frm.reset();
        $('.mail-message-ok').fadeOut(500);
        $('.form-fields').delay(500).fadeIn(500);
    });
}