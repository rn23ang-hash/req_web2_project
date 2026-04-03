let currentPage = 0;

showPage(currentPage);

function showPage(n) {
    //getelemclassname creates an array apparently
    let pages = document.getElementsByClassName("localfunc-signup-page");
    pages[n].style.display = "block";

    if (n === 0) {
        
    }
}