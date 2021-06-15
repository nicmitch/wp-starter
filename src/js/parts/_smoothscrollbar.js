import Scrollbar from 'smooth-scrollbar';

function init(){
    let scrollContainer = document.querySelector('#scrollbar-container');
    let isTouch = "ontouchstart" in document.documentElement ? true : false;

    if (scrollContainer && !isTouch) {
        Scrollbar.init(scrollContainer);
    }
}

function destroy(){

}

export { init, destroy };
