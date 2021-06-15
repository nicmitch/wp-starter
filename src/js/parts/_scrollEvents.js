! function() {

    var sdlastScrollTop = 0;
    var sdScrollOffset = 150;
    let body = document.querySelector('body');
    let topCheckpoint = 200;

    window.addEventListener("scroll", function() {

        var st = window.pageYOffset || document.documentElement.scrollTop;

        // Scroll Direction
        if (st > (sdlastScrollTop + sdScrollOffset)) {
            body.classList.remove('isScroll--up');
            body.classList.add('isScroll--down');
            sdlastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
        } else if (st < (sdlastScrollTop - sdScrollOffset)) {
            body.classList.remove('isScroll--down');
            body.classList.add('isScroll--up');
            sdlastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
        }


        // Top Checkpoint
        if (window.pageYOffset > topCheckpoint) {
            body.classList.add('topCheckpoint');
        } else {
            body.classList.remove('topCheckpoint');
        }
    }, false);
}();