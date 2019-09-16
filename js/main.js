function myFunction() {
	var x = document.getElementById("navBar"); //GETS THE NAVBAR LINK.
	if (x.className.indexOf("w3-show") == -1) { //CHECKS TO SEE IF "w3-show" IS PRESENT IN THE CLASSES.
		x.className += " w3-show"; //ADDS IT IF IT'S NOT THERE.
	} else { 
		x.className = x.className.replace(" w3-show", ""); //REMOVES IT IF IT'S THERE.
	}
}

function thanos(){
	var res = Math.floor(Math.random()*2);
	
	if(res === 0){
		document.getElementById("result").innerHTML = "You SURVIVED!";
	}else{
		document.getElementById("result").innerHTML = "You're DUST!";
	}
}

function displayPanel(){
	var x = document.getElementById("newPanel"); //GETS THE NAVBAR LINK.
	if (x.className.indexOf("w3-show") == -1) { //CHECKS TO SEE IF "w3-show" IS PRESENT IN THE CLASSES.
		x.className += " w3-show"; //ADDS IT IF IT'S NOT THERE.
	} else { 
		x.className = x.className.replace(" w3-show", ""); //REMOVES IT IF IT'S THERE.
	}
}

//THIS IS FOR DISPLAYING THE DELETE BUTTONS ON THE CARDS.
function displayDel(){
	for(var i = 0; i < 100; i++){
		var x = document.getElementById("del"+i);
	
	
        if(x.style.display == "block"){
            x.style.display = "none";
        }else{
            x.style.display = "block";
        }
	}
}
