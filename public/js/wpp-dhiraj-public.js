jQuery(document).ready( function() {

	jQuery(".user_details").click( function(event) {
	   event.preventDefault(); 
		user_id = jQuery(this).attr("data-user_id");
		nonce = jQuery(this).attr("data-nonce");
		
	   jQuery.ajax({
		  type : "post",
		  dataType : "json",
		  url : myAjax.ajaxurl,
		  data : {action: "user_details_call", user_id : user_id, nonce: nonce},
		   success: function (response) {	
			   console.log(response);
			 if(response.type == "success") {
				jQuery("#details_modal").html(response.data);
			 }
			 else {
				jQuery("#details_modal").html("User details could not found");
			 }
		  }
	   })   
 
	})
 
 })