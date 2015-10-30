var error_MissingValues_array = [];
var NoMissingValues = false;
var noerrors = true;

var today = new Date();
var expiry = new Date(today.getTime() + 30 * 24 * 3600 * 1000); // plus 30 days


$( document ).ready(function() {
	
	/// Inital Hide /////////////////////
	 $( "#addNewFormContain" ).hide();
	 $( "#updateFormContain" ).hide();
	
	
	$( "#showAddFormButton" ).click(function() {
  		$( "#addNewFormContain" ).slideDown();
	});
	
	
	
	
	$(".getRow").click(function() {
	
	//var $row = '';
	//var $tds = '';
	
var formData = [];
   var $row = $(this).closest("tr");    // Find the row
   var $tds = $row.find("td");
    $.each($tds, function() {
        console.log($(this).text());
		formData.push($(this).text()); 
		
    });
	console.log(formData);
	formData = formData.slice(0, 8);
	console.log(formData);
	
	$("#updateForm input[name=fname]").val(formData[0]);
	$("#updateForm input[name=lname]").val(formData[1]);
	$("#updateForm input[name=addr1]").val(formData[2]);
	$("#updateForm input[name=addr2]").val(formData[3]);
	$("#updateForm input[name=hcity]").val(formData[4]);
	$("#updateForm input[name=hstate]").val(formData[5]);
	$("#updateForm input[name=hcountry]").val(formData[7]);
	$("#updateForm input[name=hcode]").val(formData[6]);
	
	
	
});
	
	
});

	function storeValues(addNewForm)
	{
	  setCookie("field1", myform.fname.value);
	  setCookie("field2", myform.lname.value);
	  setCookie("field3", myform.field3.value);
	  setCookie("field4", myform.field4.value);
	  return true;
	}

	function setCookie(name, value)
	{
	  document.cookie=name + "=" + escape(value) + "; path=/; expires=" + expiry.toGMTString();
	}




function scrollAndShakeSucc() {
			$("html, body").animate({scrollTop:$('#content').offset().top}, 800 , function() {
        		$( '.isa_success' ).effect( "shake", {times:1}, 500 );
    		} );
		}

function scrollAndShake() {
			$("html, body").animate({scrollTop:$('#error').offset().top}, 800 , function() {
        		$( '.isa_error' ).effect( "shake", {times:1}, 500 );
    		} );
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



function cancelNewForm () 
{
	$( "#addNewFormContain" ).slideUp();
}

function cancelUpdateForm () 
{
	$( "#updateFormContain" ).slideUp();
}




function UpdateFormShow (shaddrid) 
{
	//alert(shaddrid);
	$( "#updateFormContain" ).slideUp();
	document.getElementById("updateForm").reset();
	$( "#updateFormContain" ).slideDown();
	$("#shaddrID").val(shaddrid);
	
	var $row = $(this).closest("tr"),       // Finds the closest row <tr> 
    $tds = $row.find("td");             // Finds all children <td> elements

		$.each($tds, function() {               // Visits every single <td> element
    	console.log($(this).text());        // Prints out the text within the <td>
});
	 
}

function addformhash(form, fname, lname, addr1, addr2, hcity, hstate, hcountry, hcode) {
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


 if (NoMissingValues && noerrors) {

	// Check the fname

    var re = /^[a-zA-Z]+$/;
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
    re = /^[a-zA-Z" "]+$/;
    if(!re.test(form.hstate.value)) {
		errorBox("State name must contain only letters. Please try again.");
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

 if (noerrors) {
    // Finally submit the form.
    form.submit();
    return true;
 }
}
}

function updateformhash(form, fname, lname, addr1, addr2, hcity, hstate, hcountry, hcode, shaddrID) {
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


 if (noerrors) {

	// Check the fname

    var re = /^[a-zA-Z]+$/;
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
    re = /^[a-zA-Z" "]+$/;
    if(!re.test(form.hstate.value)) {
		errorBox("State name must contain only letters. Please try again.");
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

 if (noerrors) {
    // Finally submit the form.
	alert('User Updated');
    form.submit();
    return true;
 }
}
}

