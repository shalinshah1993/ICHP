//This function is used to validate the Email Address entered.
function validateEmail(email){
	var regexString = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return regexString.test(email);
}

//This is the helper function to validate the Email entered. 
function validate(){
	var emaildAddress = document.getElementById("indexPageEmailId").value;
	var validText = document.getElementById("indexPageValidateText");
	var styledString = "";

	if(emaildAddress === ""){
		styledString.fontcolor("black");
		styledString = "";
		validText.innerHTML = styledString;
		return;
	}

	if(validateEmail(emaildAddress)){
		styledString = "Valid Email";
		validText.innerHTML = styledString.fontcolor("green");
	}else{
		styledString = "Invalid Email";
		validText.innerHTML = styledString.fontcolor("red");
	}
	return;
}

//This is the function to clear all the fields of the sign-up form.
function resetFields(){
	//document.write("asfdasfa");
	document.getElementById("indexPageEmailId").value = "";
	document.getElementById("indexPageName").value = "";
	document.getElementById("indexPageValidateText").innerHTML = "";
	document.getElementById("indexPageRememberCheck").checked = false;
}

//This is the function to check if all the fields are selected or not.
function checkFields(){
	if(document.getElementById("indexPageEmailId").value === "" || document.getElementById("indexPageName").value === ""){
		alert("Please fill all the form fields correctly or make sure that you have filled all the fields");
		return false;
	}
	
	// window.location.href='test.html';
	return true;
}