var container;
var label;
var input;

function captchaClickHandler(el, container_id) {
	
	container		= document.getElementById(container_id);
		
	var t			= setTimeout('testIfChecked()', .25);
	
}

function testIfChecked() {
	var labels		= container.getElementsByTagName('label');
	
	for(var i = 0; i < labels.length; ++i) {
		
		var input			= document.getElementById(labels[i].getAttribute('for'));
		
		if(input.checked == true) {
			labels[i].style.opacity		= .25;
		}
		else {
			labels[i].style.opacity		= 1;
		}
	}
	
}

function captchaCheckboxLoadHandler(el) {
	
	var input_id 	= el.getAttribute('rel');
	var input		= document.getElementById(input_id);
	
	if(input.checked == true) {
		input.checked = false;
	}
	
}