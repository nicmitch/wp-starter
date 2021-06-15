import $ from "jquery";
import Foundation from "foundation-sites";

let privacyModal = $('#openPrivacy');
let privacyModalObj = null;

function init() {

    // Fix modale bug
    $(document).on("closed.zf.reveal", function(modale) {
        //$("body, html").classList.remove("is-reveal-open");
        let target_id = modale.target.dataset.yetiBox;
        let target = document.getElementById(target_id);
        target.parentNode.classList.remove("open");

    });

    //$(document).on('open.zf.reveal', function(modale) {
    $(document).on("open.zf.reveal", function(modale) {
        let target_id = modale.target.dataset.yetiBox;
        let target = document.getElementById(target_id);
        target.parentNode.classList.add("open");
    });

    //privacyModal.parents('.reveal-overlay').addClass('open');
    //privacyModal.addClass('open');

    //var privacyModalObj = new Foundation.Reveal( privacyModal );
    privacyModalObj = !privacyModalObj ? new Foundation.Reveal(privacyModal) : null;
    var privacyModalContent = $('#openPrivacy .content');
    var privacyAlreadyLoad = false;

    $('.privacy-link').on('click', function(e) {
        e.preventDefault();

        console.log('privacy-link');

        privacyModal.foundation('open');

        if (privacyAlreadyLoad) {
            // Se la privacy è già stata caricata nel contenuto del modale evito di ricaricarla
            //privacyModal.foundation('open');
        } else {
            /*
            Load privacy page content from WordPress by id using:
            - privacy_page js variable in footer
            - ajax url js variable in footer
            */
            var privacyPageId = window.privacy_page;
            var ajaxUrl = window.ajaxUrl;

            if (privacyPageId != undefined) {
                $.ajax({
                    type: 'POST',
                    url: ajaxUrl,
                    data: {
                        'post_id': privacyPageId,
                        'action': 'get_post_content_by_ajax', // this is the name of the AJAX method called in WordPress
                    },
                    success: function(result) {
                        if (result) {
                            result = JSON.parse(result);
                            var modalContent = "<div class=\"modalDynContent\" style=\"display:none;\">";
                            modalContent += "<h1>" + result.post_title + "</h1>";
                            modalContent += result.post_content;
                            modalContent += "</div>";

                            privacyModalContent.find('.loader-icon').fadeOut(400, function() {
                                privacyModalContent.html(modalContent);
                                privacyModalContent.find('.modalDynContent').slideDown(1000);
                            });
                            //privacyModal.foundation('open');

                            privacyAlreadyLoad = true;

                        }
                    },

                    error: function(jqXHR, textStatus, errorThrow) {
                        console.log(jqXHR, textStatus, errorThrow);
                    },
                });
            }
        }
    });

}

function destroy() {}

export { init, destroy };