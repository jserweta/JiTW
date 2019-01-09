window.onload = showHideChat();

function showHideChat(){
    if(document.getElementById('isChatActive').checked){   
		document.getElementById('chatWindow').style.display="block";
		receive();
    }
    else{
        document.getElementById('chatWindow').style.display="none";
		
    }
}

function receive() {
	var isChatActive = document.getElementById("isChatActive");
	if(isChatActive.checked) {
		var messageRequest = new XMLHttpRequest();
			messageRequest.onreadystatechange = function() {
	            	if (this.readyState == 4 && this.status == 200) {
    	        		document.getElementById("messageArea").innerHTML = this.responseText;
						receive();
            		}
    		};
        	messageRequest.open("GET", "receive.php", true);
	    	messageRequest.send();
	} else {
		document.getElementById("messageArea").innerHTML = "";
	}

}


function send() {
	var nickINPUT = document.getElementById("nickINPUT").value;
	var messageINPUT = document.getElementById("messageINPUT");
	
	if (messageINPUT.value.length == 0 || nickINPUT.length ==0) { 
        	alert("Uzupełnij dane!");
	        return;
	
	}else if(messageINPUT.value.length > 100){
		alert("Twoja wiadomość jest za długa!");
		return;
	} else {
        	var newMessage = new XMLHttpRequest();
        	newMessage.onreadystatechange = function() {
	            if (this.readyState == 4 && this.status == 200) {
			if(this.response == "failure")
				alert("Wysyłanie niepowiodoło się!");
				//messageINPUT.value = "Wpisz wiadomość...";
	            }
        	};
	        newMessage.open("GET", "send.php?nickINPUT=" + nickINPUT + "&messageINPUT=" + messageINPUT.value, true);
        	newMessage.send();
	}

}