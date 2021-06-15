/*
    html native lazy loading => add class "lazy-loaded" when loaded
*/
for (const imgEl of Array.from(document.querySelectorAll('img[loading]'))) {
    imgEl.addEventListener('load', () => {
        console.log("image lazy loaded");
        // imgEl.classList.add("lazy-loaded");
    });
}
