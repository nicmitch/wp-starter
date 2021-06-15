import StickySidebar from 'sticky-sidebar-v2';
import Foundation from "foundation-sites";

export default function initStickySidebar() {
    const sidebarEL = document.querySelector('.sidebar');
    let topSpace = 0;

    if (sidebarEL) {
        console.log('sticky presence');

        if (Foundation.MediaQuery.is('large only')) {
            topSpace = 30;
            console.log('large');
        }
        if (Foundation.MediaQuery.atLeast('xlarge')) {
            topSpace = 110;
            console.log('xlarge');
        }
        const sidebar = new StickySidebar(sidebarEL, {
            containerSelector: '.sticky-sidebar',
            innerWrapperSelector: '.sidebar__inner',
            topSpacing: topSpace,
            bottomSpacing: 20,
            resizeSensor: false
        });
    }
}