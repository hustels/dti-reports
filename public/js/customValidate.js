$(document).ready(function(){



		$('#myModalLabel').validate({
	    rules: {

	       date: {
	       	required: true,
	      	
	      },
	       db: {
	       	required: true,
	      	minlength: 2
	      },
	      host: {
	       	required: true,
	      	minlength: 3
	      },
	      type: {
	      	minlength: 4,
	        required: true
	      }
	    },
			success: function(element) {
				element
				.text('OK!').css('color', 'green').addClass('valid');
			}
	  });




});