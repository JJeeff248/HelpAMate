function toggleHide(element) {
    
    let btn = element.className;
    let y = document.querySelector(".blurbg");
    let x;

    if (btn.includes("login")) {
        x = document.querySelector(".loginpopup");
    } else if (btn.includes("pledge")) {
        x = document.querySelector(".pledge");
    } else if (btn.includes("delete")) {
        x = document.querySelector(".deletepopup");
    }
    
    if (x.style.display == '') {
        x.style.display = "none";
        y.style.display = "none";
    }
    
    if (x.style.display === "none") {
        x.style.display = "block";
        y.style.display = "block";
    } else if (x.style.display === "block") {
        x.style.display = "none";
        y.style.display = "none";
    }
}