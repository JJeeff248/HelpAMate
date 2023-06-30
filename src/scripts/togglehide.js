function toggleHide() {
	
	
	var btn = event.target.className;
	var y = document.querySelector(".blurbg");

	if (btn.includes("login")) {
		var x = document.querySelector(".loginpopup");
	} else if (btn.includes("pledge")) {
		var x = document.querySelector(".pledge");
	} else if (btn.includes("delete")) {
		var x = document.querySelector(".deletepopup");
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