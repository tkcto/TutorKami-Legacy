$(document).ready(function () {  
	$('.btnDisabled1').on('click', function () {
		if( document.getElementsByName("j_create_date")[0].value != '' && document.getElementsByName("jt_subject[en]")[0].value != '' && document.getElementsByName("j_area")[0].value != ''
			&& document.getElementsByName("j_state_id")[0].value != '' && document.getElementsByName("newCity")[0].value != '' && document.getElementsByName("j_email")[0].value != '' && document.getElementsByName("j_telephone")[0].value != ''
			&& document.getElementsByName("jt_lessons[en]")[0].value != '' && document.getElementsByName("j_preferred_date_time")[0].value != '' && document.getElementsByName("j_duration")[0].value != '' && document.getElementsByName("j_status")[0].value != ''
			&& document.getElementsByName("j_payment_status")[0].value != '' && document.getElementsByName("j_rate")[0].value != '' && document.getElementsByName("j_commission")[0].value != '' ){
				var myForm = $("form#formJob");   
				if (myForm) {      
					document.getElementsByName("save2")[0].click();		
					$(".btnDisabled1").attr("disabled", true);	
					$(".btnDisabled2").attr("disabled", true);	
					$(".btnDisabled3").attr("disabled", true);	
					$(".btnDisabled4").attr("disabled", true);						
				}
		}
	}); 
	$('.btnDisabled2').on('click', function () {
		if( document.getElementsByName("j_create_date")[0].value != '' && document.getElementsByName("jt_subject[en]")[0].value != '' && document.getElementsByName("j_area")[0].value != ''
			&& document.getElementsByName("j_state_id")[0].value != '' && document.getElementsByName("newCity")[0].value != '' && document.getElementsByName("j_email")[0].value != '' && document.getElementsByName("j_telephone")[0].value != ''
			&& document.getElementsByName("jt_lessons[en]")[0].value != '' && document.getElementsByName("j_preferred_date_time")[0].value != '' && document.getElementsByName("j_duration")[0].value != '' && document.getElementsByName("j_status")[0].value != ''
			&& document.getElementsByName("j_payment_status")[0].value != '' && document.getElementsByName("j_rate")[0].value != '' && document.getElementsByName("j_commission")[0].value != '' ){
				var myForm = $("form#formJob");   
				if (myForm) {      
					document.getElementsByName("save_edit2")[0].click();		
					$(".btnDisabled1").attr("disabled", true);	
					$(".btnDisabled2").attr("disabled", true);	
					$(".btnDisabled3").attr("disabled", true);	
					$(".btnDisabled4").attr("disabled", true);						
				}
		}
	}); 

	$('.btnDisabled3').on('click', function () {
		if( document.getElementsByName("j_create_date")[0].value != '' && document.getElementsByName("jt_subject[en]")[0].value != '' && document.getElementsByName("j_area")[0].value != ''
			&& document.getElementsByName("j_state_id")[0].value != '' && document.getElementsByName("newCity")[0].value != '' && document.getElementsByName("j_email")[0].value != '' && document.getElementsByName("j_telephone")[0].value != ''
			&& document.getElementsByName("jt_lessons[en]")[0].value != '' && document.getElementsByName("j_preferred_date_time")[0].value != '' && document.getElementsByName("j_duration")[0].value != '' && document.getElementsByName("j_status")[0].value != ''
			&& document.getElementsByName("j_payment_status")[0].value != '' && document.getElementsByName("j_rate")[0].value != '' && document.getElementsByName("j_commission")[0].value != '' ){
				var myForm = $("form#formJob");   
				if (myForm) {      
					document.getElementsByName("save2")[0].click();		
					$(".btnDisabled1").attr("disabled", true);	
					$(".btnDisabled2").attr("disabled", true);	
					$(".btnDisabled3").attr("disabled", true);	
					$(".btnDisabled4").attr("disabled", true);						
				}
		}
	}); 
	$('.btnDisabled4').on('click', function () {
		if( document.getElementsByName("j_create_date")[0].value != '' && document.getElementsByName("jt_subject[en]")[0].value != '' && document.getElementsByName("j_area")[0].value != ''
			&& document.getElementsByName("j_state_id")[0].value != '' && document.getElementsByName("newCity")[0].value != '' && document.getElementsByName("j_email")[0].value != '' && document.getElementsByName("j_telephone")[0].value != ''
			&& document.getElementsByName("jt_lessons[en]")[0].value != '' && document.getElementsByName("j_preferred_date_time")[0].value != '' && document.getElementsByName("j_duration")[0].value != '' && document.getElementsByName("j_status")[0].value != ''
			&& document.getElementsByName("j_payment_status")[0].value != '' && document.getElementsByName("j_rate")[0].value != '' && document.getElementsByName("j_commission")[0].value != '' ){
				var myForm = $("form#formJob");   
				if (myForm) {      
					document.getElementsByName("save_edit2")[0].click();		
					$(".btnDisabled1").attr("disabled", true);	
					$(".btnDisabled2").attr("disabled", true);		
					$(".btnDisabled3").attr("disabled", true);	
					$(".btnDisabled4").attr("disabled", true);		
				}
		}
	}); 

}); 