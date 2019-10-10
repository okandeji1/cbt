$(document).ready(function() {
	let firstname = $('#firstname').val();
	let lastname = $('#lastname').val();
	let email = $('#email').val();
	var password1 		= $('#password1'); //id of first password field
	var password2		= $('#password2'); //id of second password field
	var passwordsInfo 	= $('#pass-info'); //id of indicator element
	
	validateForm(firstname, lastname, email, password1,password2,passwordsInfo); //call password check function
	
});

// Validate form
function validateForm(firstname, lastname, email, password1, password2, passwordsInfo)
{
	console.log(firstname);
	//Must contain 5 characters or more
	var WeakPass = /(?=.{5,}).*/; 
	//Must contain lower case letters and at least one digit.
	var MediumPass = /^(?=\S*?[a-z])(?=\S*?[0-9])\S{5,}$/; 
	//Must contain at least one upper case letter, one lower case letter and one digit.
	var StrongPass = /^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])\S{5,}$/; 
	//Must contain at least one upper case letter, one lower case letter and one digit.
	var VryStrongPass = /^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])(?=\S*?[^\w\*])\S{5,}$/; 
	
	// Checking for validation
	$('.validate').on('click', (e) => {
		e.preventDefault();
		if(firstname === '' || firstname === 'undefined'){
			document.getElementById('msg').classList.remove('d-none');
			document.getElementById('msg').innerHTML  = 'Please first name is required';
			return false
		}
	
		if(lastname === '' || lastname === 'undefined'){
			document.getElementById('msg').classList.remove('d-none');
			document.getElementById('msg').innerHTML  = 'Please last name is required';
			return false
		}
	
		if(email === '' || email === 'undefined'){
			document.getElementById('msg').classList.remove('d-none');
			document.getElementById('msg').innerHTML  = 'Please email is required';
			return false
		}
	});

	$(password1).on('keyup', function(e) {
		if(VryStrongPass.test(password1.val()))
		{
			passwordsInfo.removeClass().addClass('vrystrongpass').html("Very Strong! (Awesome, please don't forget your password now!)");
		}	
		else if(StrongPass.test(password1.val()))
		{
			passwordsInfo.removeClass().addClass('strongpass').html("Strong! (Enter special chars to make even stronger");
		}	
		else if(MediumPass.test(password1.val()))
		{
			passwordsInfo.removeClass().addClass('goodpass').html("Good! (Enter uppercase letter to make strong)");
		}
		else if(WeakPass.test(password1.val()))
    	{
			passwordsInfo.removeClass().addClass('stillweakpass').html("Still Weak! (Enter digits to make good password)");
    	}
		else
		{
			passwordsInfo.removeClass().addClass('weakpass').html("Very Weak! (Must be 5 or more chars)");
		}
	});
	
	$(password2).on('keyup', function(e) {
		
		if(password1.val() !== password2.val())
		{
			passwordsInfo.removeClass().addClass('weakpass').html("Passwords do not match!");	
		}else{
			passwordsInfo.removeClass().addClass('goodpass').html("Passwords match!");	
		}
			
	});
}