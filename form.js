$(document).ready(function(){  
	$("#submit").click(function(){

	// Returns successful data submission message when the entered information is stored in database.
	var dataString = $("#customerForm").serialize();

		//AJAX code to submit form.
		$.ajax({
			type: $("#customerForm").attr("method"),
			url: $("#customerForm").attr("action"),
			data: dataString,
			cache: false,
			success: function(result){
				// Success message
	            $('#success').html(result);
	            //clear all fields
	            $("#customerForm").trigger("reset");
			}
		});
	return false;
	});
});