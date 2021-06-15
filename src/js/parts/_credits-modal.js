import $ from "jquery";

$(document).ready(function() {
    const creditsLinks = document.querySelectorAll('.credits-modal > a, .credits-link');
    for (let el of Array.from(creditsLinks)) {
        // add Foundation reveal attribute (init in main.js -> document.ready)
        el.setAttribute('data-open', 'credits-modal');
    }
});