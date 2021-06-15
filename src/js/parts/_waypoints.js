!function(){
    if (document.querySelector("#scroll-to-top")){
        let scrollTopElem = document.querySelector("#scroll-to-top");

        document.addEventListener("scroll", function(){
            if (window.pageYOffset >= 200){
                scrollTopElem.classList.add("show");
            } else {
                scrollTopElem.classList.remove("show");
            }
        });
    }
}();
