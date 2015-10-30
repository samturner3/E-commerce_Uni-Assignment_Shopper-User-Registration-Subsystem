var error_MissingValues_array = [];
var NoMissingValues = false;
var noerrors = true;
// JavaScript Document


var today = new Date();
var expiry = new Date(today.getTime() + 30 * 24 * 3600 * 1000); // plus 30 days

	function setCookie(name, value)
	{
	  document.cookie=name + "=" + escape(value) + "; path=/; expires=" + expiry.toGMTString();
	}



function storeValues(myform)
{
  setCookie("field1", myform.fname.value);
  setCookie("field2", myform.lname.value);
  setCookie("field3", myform.field3.value);
  setCookie("field4", myform.field4.value);
  return true;
}

function scrollAndShake() {
			$("html, body").animate({scrollTop:$('#error').offset().top}, 800 , function() {
        		$( '.isa_error' ).effect( "shake", {times:1}, 500 );
    		} );
		}

function formhash(form, password) {
    // Create a new element input, this will be our hashed password field.
    /*var p = document.createElement("input");

    // Add the new element to our form.
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);

    // Make sure the plaintext password doesn't get sent.
    password.value = "";

    // Finally submit the form.*/
    form.submit();
}

function errorBoxMissing() {
	//document.getElementById(one).style.display = 'block';
    //document.getElementById("error").innerHTML = message;
	if (error_MissingValues_array.length > 0) {

		$("#error").empty();
		$("#error").append("<div class=\"isa_error\"><i class=\"fa fa-times-circle\"></i>");
		$(".isa_error").append("Please ensure you provide all fields. The following values are missing: <br>");
		for (var i = 0; i < error_MissingValues_array.length; i++) {
			console.log(error_MissingValues_array[i] + " Is missing>");
			$(".isa_error").append(error_MissingValues_array[i] + "<br>");
			}
			$("#error").append("</div>");
			scrollAndShake();
			return false;
			error_MissingValues_array = [];
			$(".isa_error").empty();
    // the array is defined and has at least one element
	}

}

function errorBox(message) {
	if (message !== '') {
		$("#error").empty();
		$("#error").append("<div class=\"isa_error\"><i class=\"fa fa-times-circle\"></i>");
		$(".isa_error").append(message);
		$("#error").append("</div>");
		scrollAndShake();
		noerrors = false;
		return false;
		message = '';
}

}

			//<div class=\"isa_warning\">

function regformhash(form, fname, lname, addr1, addr2, hcity, hstate, hcountry, hcode, uid, email, ccard, ccexpmonth, ccexpyear, password, conf) {
     // Check each field has a value

var form_values_array = [];

NoMissingValues = true;
noerrors = true;


form_values_array.push(["First Name", fname.value]);
form_values_array.push(["Last Name", lname.value]);
form_values_array.push(["Address Line 1", addr1.value]);
form_values_array.push(["City/Suburb", hcity.value]);
form_values_array.push(["State", hstate.value]);
form_values_array.push(["Country", hcountry.value]);
form_values_array.push(["Post Code", hcode.value]);
form_values_array.push(["Username", uid.value]);
form_values_array.push(["Email", email.value]);
form_values_array.push(["Credit Card", ccard.value]);
form_values_array.push(["Credit Card Expiry Month", ccexpmonth.value]);
form_values_array.push(["Credit Card Expiry Year", ccexpyear.value]);
form_values_array.push(["Password", password.value]);
form_values_array.push(["Confirm Password", conf.value]);


for (var i = 0; i < form_values_array.length; i++) {
	console.log(form_values_array[i][0] + form_values_array[0][i]);
	if (form_values_array[i][1] === ''){
		//console.log(form_values_array[i][0] + " is empty!");
		error_MissingValues_array.push(form_values_array[i][0]);
		//errorBox("Please ensure you have filled out all fields: " + form_values_array[i][0] + " is empty!");
	}


}
if (error_MissingValues_array.length > 0) {
	errorBoxMissing();
	error_MissingValues_array = [];
	NoMissingValues = false;
}
else {
	NoMissingValues = true;
}

/*form_values_array.forEach(function(entry) {
    console.log(entry);
});*/

   /* if (
		  fname.value == ''     ||
		  lname.value == ''     ||
		  hname.value == ''     ||
	  	  hcity.value == ''     ||
		  hstate.value == ''    ||
		  hcode.value == ''     ||
		  sClass.value == ''    ||
		  uid.value == ''       ||
          email.value == ''     ||
		  ccard.value == ''     ||
          password.value == ''  ||
          conf.value == '') {

		//alert("Stuff missing.");
		//errorBox("<div class=\"isa_error\"><i class=\"fa fa-times-circle\"></i>Stuff missing.</div>");
		errorBox("Please ensure you have filled out all fields.");
		//document.getElementById("error").innerHTML = "Stuff missing.";
        return false;
    }*/

 if (NoMissingValues && noerrors) {

	// Check the fname

    re = /^[a-zA-Z]+$/;
    if(!re.test(form.fname.value)) {
	errorBox("First name must contain only letters. Please ensure you have no spaces and try again.");
		form.fname.focus();
    }

	if (noerrors) {
	// Check the lname

    re = /^[a-zA-Z]+$/;
    if(!re.test(form.lname.value)) {
		errorBox("Last name must contain only letters. Please ensure you have no spaces and try again.");
        form.lname.focus();
        return false;
    }
	}

	if (noerrors) {
	// Check the hname (Address)

    re = /^[a-zA-Z0-9" "\/]+$/;
    if(!re.test(form.addr1.value)) {
		errorBox("Address Line 1 must contain only letters or numbers.");
        form.hname.focus();
        return false;
    }
	}
	
	
	if (noerrors) {
	// Check the hcity

    re = /^[a-zA-Z" "]+$/;
    if(!re.test(form.hcity.value)) {
		errorBox("City / suburb name must contain only letters. Please ensure you have no spaces and try again.");
        form.hcity.focus();
        return false;
    }
	}

		// Check the hstate

 if (noerrors) {
    re = /^[a-zA-Z]+$/;
    if(!re.test(form.hstate.value)) {
		errorBox("State name must contain only letters. Please ensure you have no spaces and try again.");
        form.hstate.focus();
        return false;
    }
    }
	
	 if (noerrors) {
    re = /^[a-zA-Z" "]+$/;
    if(!re.test(form.hcountry.value)) {
		errorBox("Country name must contain only letters.");
        form.hcountry.focus();
        return false;
    }
    }

		// Check the hcode
 if (noerrors) {
    re = /^[" "a-zA-Z0-9_-]{3,16}$/;
    if(!re.test(form.hcode.value)) {
		errorBox("Post code must contain only numbers and/or letters, and be between 3 and 6 digits long.");
        form.hcode.focus();
        return false;
    }
 }

    // Check the username
 if (noerrors) {
    re = /^[a-zA-Z0-9_-]{3,16}$/;
    if(!re.test(form.username.value)) {
		errorBox("Username must contain only letters, numbers and underscores (no spaces), and be between 3 and 16 characters long. Please try again.");
        form.username.focus();
        return false;
    }
 }

	if (noerrors) {
	// check email
	 // re = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;

	  re = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;

    if(!re.test(form.email.value)) {
		errorBox("The email address you entered is not valid. Please Try Again.");
		form.email.focus();
        return false;
    }
	}
		// Check the ccard
 if (noerrors) {
    re = /^([0-9]){10}$/;
    if(!re.test(form.ccard.value)) {
		errorBox("Credit Card must contain only numbers, and be 10 digits long. Please ensure you have no spaces and try again.");
        form.ccard.focus();
        return false;
    }
 }



    // At least 2 number, one lowercase and one uppercase letter
    // At least 8 characters

 if (noerrors) {

    var re = /((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20})/;
    if (!re.test(password.value)) {
		errorBox("Passwords must contain must contains one digit from 0-9, one lowercase character, one uppercase character,one special symbols in the list \"@#$%\", length at least 6 characters and maximum of 20.  Please try again.");
        return false;
    }
 } //12aA123Asdee$

 if (noerrors) {
    // Check password and confirmation are the same
    if (password.value != conf.value) {
		errorBox("Your password and confirmation do not match. Please try again.");
        form.password.focus();
        return false;
    }
 }

    //double hashing not needed
    /*var p = document.createElement("input");

    // Add the new element to our form.
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);

    // Make sure the plaintext password doesn't get sent.
    password.value = "";
    conf.value = "";*/
 if (noerrors) {
    // Finally submit the form.
    form.submit();
    return true;
 }
}
}
