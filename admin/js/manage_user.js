function checkAll(ele, id) {
   var checkboxes = document.getElementsByTagName('input');
   var patt1 = /[^0-9]/g;
   $('[name^="'+id+'"]').parents('.showHide').toggle();
   $(ele).parent('.checkbox').find('.dropPop').toggle();
  /*if (ele.checked) {
      // $('[name^="'+id+'"]').prop('checked', true);
      $('[name^="'+id+'"]').parents('.showHide').show();
      $(ele).parent('.checkbox').find('.dropPop').show();
  } else {
      // $('[name^="'+id+'"]').prop('checked', false);
      $('[name^="'+id+'"]').parents('.showHide').hide();
      $(ele).parent('.checkbox').find('.dropPop').hide();
  }*/
}
function zeroPad(num) {
	  return num.toString().padStart(7, "0");
	}

//	var numbers = [1310, 120, 10, 7];
//
//	numbers.forEach(
//	  function(num) {        
//	    var paddedNum = zeroPad(num);
//
//	    console.log(paddedNum);
//	  }
//	);
function getBaseUrl() {
	var re = new RegExp(/^.*\//);
	return re.exec(window.location.href);
}
function tickAll(pid, id) {
   $('#'+pid).prop('checked', true);
   $('[name^="'+id+'"]').prop('checked', true);
}

function untickAll(pid, id) {
   $('#'+pid).prop('checked', false);
   $('[name^="'+id+'"]').prop('checked', false);
}

function tickAllClass(cl) {
   $(cl).prop('checked', true);
}

function untickAllClass(cl) {
   $(cl).prop('checked', false);
}

function check_parent(ele) {

   var parentID = $(ele).data('pid');
   var parentName = $(ele).data('pname');
   var childName = $(ele).data('cname');
   var otherName = $(ele).data('oname');
   var checkboxes = document.getElementsByTagName('input');

   if (ele.checked) {
     for (var i = 0; i < checkboxes.length; i++) {
          if (checkboxes[i].type == 'checkbox' && checkboxes[i].id == parentName+parentID){
            checkboxes[i].checked = true;
          }
      }
   } else {
     for (var i = 0; i < checkboxes.length; i++) {                
         if (checkboxes[i].type == 'checkbox' && checkboxes[i].id == parentName+parentID) {
            if ($('input[name^="'+childName+parentID+'"]:checked').length == 0 && $('input[name^="'+otherName+parentID+'"]:checked').length == 0) {
               checkboxes[i].checked = false;
            }
            
         }
      }
   }
}

function toggleOther(ele, id) {
   check_parent(ele);
   if (ele.checked) {
       $('[name^="'+id+'"]').parent('.col-md-12').show();
   } else {
       $('[name^="'+id+'"]').parent('.col-md-12').hide();
   }
}

$(document).ready(function(){

   $('.toggleShowHide').click(function(){
      $(this).parent('.checkbox').find('.showHide').toggle();
      $(this).parent('.checkbox').find('.dropPop').toggle();
   });

   /*$('body').on('click', '#selectAll', function () {
      if ($(this).hasClass('allChecked')) {
         $('input[type="checkbox"]', allPages).prop('checked', false);
      } else {
         $('input[type="checkbox"]', allPages).prop('checked', true);
      }
      $(this).toggleClass('allChecked');
   })*/
/// "dom": '<"top"f>rt<"bottom"ilp><"clear">'
   var table = $('.user-listing').DataTable({
     dom: '<"html5buttons"B>lTfgitp',
     //"dom":"l<'row'<'col-sm-6'l><'col-sm-6'f>>",
	//   "dom": 'l<f<t><"#df"<"pull-left" i><"pull-right"p><"pull-right"l>>>',
	  lengthChange: true,
	  lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
	  buttons: [
		  'copy','pdf','excel','print','colvis','pageLength'
		  ],
      columnDefs: [
         {
            'targets': 0,
            'checkboxes': {
               'selectRow': true
            }
         }
      ],
    //  buttons: [
     //    {extend: 'excel', text: 'Export All'}         
    //  ],
      select: {
         style : "multi"
      },
      order: [[ 10, "desc" ]],
      
   });

   // Handle form submission event 
   $('#frm-user-listing').on('submit', function(e){
      var form = this;
      
      var rows_selected = table.column(0).checkboxes.selected();
      if(rows_selected.length <= 0){
         getStickyNote ('error', 'Please select atleast one row and try again.');
         return false;
      }
      // Remove previously appended IDs
      $(form).find('.selected_ids').remove();
      // Iterate over all selected checkboxes
      $.each(rows_selected, function(index, rowId){
         // Create a hidden element 
         $(form).append(
             $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'id[]')
                .attr('class', 'selected_ids')
                .val(rowId)
         );
      });
   }); 

   $('form#filter_user').submit(function(e) {
      e.preventDefault();
      
      $('#hider, #loadermodaldiv').show();
      var formData = new FormData(this);
      
      $.ajax({
         url: "ajax/ajax_call.php",
         type: "POST",
         data: formData, 
         contentType: false,
         dataType: "json",
         cache: false,
         processData:false,
         success: function(resultData) {
            // Remove previously selected checkbox
            table.column(0).checkboxes.deselectAll();
            table.clear().draw();
            var urole="LALA";
            for (i = 0; i < resultData.length; i++) {
               
               var count = parseInt(i) + 1;
               //tutor
               switch( resultData[i].u_role) {
               case "2": urole = "Admin"; break;
               case "3": urole = "Tutor"; break;
               case "4": urole = "Client"; break;
                         }
               console.log(urole);
               //
               $('.user-listing').DataTable().row.add([
                  resultData[i].u_id,
                  resultData[i].u_displayid,
             //     (resultData[i].u_profile_pic!='x') ? '<img data-action="zoom" height=200 width=100 src="/images/profile/'+ zeroPad(resultData[i].u_profile_pic)+'_0.jpg" alt="profile_pic" class="img-thumbnail">' : '<img src="/images/tutor_ma.png" alt="profile_pic" class="img-thumbnail">',
                  '<a target=_blank href="manage_user.php?action=edit&u_id='+ resultData[i].u_displayid +'">'+ resultData[i].u_email +'</a>',
                  resultData[i].ud_first_name,
                 // resultData[i].ud_last_name,
                  resultData[i].u_displayname,
                  (resultData[i].u_status != 'A') ? '<i class="fa fa-times text-red"></i>' : '<i class="fa fa-check text-green"></i>',
                  resultData[i].age,
                  resultData[i].ud_address,
                  resultData[i].ud_phone_number,
                  urole,
                  resultData[i].u_create_date,
                  resultData[i].u_modified_date,
                  '<div class="btn-group">'+
                     '<a href="manage_user.php?action=edit&u_id='+ resultData[i].u_id +'" title="Edit" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>&nbsp;'+
                     '<a href="javascript:void(0);" title="Delete" onClick="if(confirm(\'Are you sure, you want to remove the user?\'))document.location.href=\'manage_user.php?action=delete_user&u_id='+ resultData[i].u_id +'\'" class="btn btn-primary btn-sm"><i class="fa fa-trash"></i></a>'+
                  '</div>'
               ]).draw();
            }

            $('#hider, #loadermodaldiv').hide();
         },
         error:function(msg){
            $('#hider, #loadermodaldiv').hide();
            getStickyNote ('error', 'Unknown error, try again later.');            
         }
      });

      return false;
   });

   $('#is_tutor').on('change', function(){
      var v = $(this).val();
      
      $('.for-tutors, .for-non-tutors, .for-admins').hide();
      document.getElementById('filter_user').reset();
      
      if (v == 'Yes') {
         $('.for-tutors').show();
         $('#is_tutor option[value=Yes]').prop('selected', true);
      } 
      else if (v == 'No') {
         $('.for-non-tutors').show();         
         $('#is_tutor option[value=No]').prop('selected', true);
      }
      else if (v == 'Admin') {
         $('.for-admins').show();
         $('#is_tutor option[value=Admin]').prop('selected', true);
      }
      
      else{
           $("#withpic").show();
      }

   });

   $('#state_drop').on('change', function(){
      $('#hider, #loadermodaldiv').show();
      var StateId = $(this).val();
      $.ajax({
         url: "ajax/ajax_call.php",
         method: "POST",
         data: {action: 'get_cities', state_id: StateId}, 
         success: function(result){
            if (result == '') {
               $('.city_check_uncheck_area').hide();
            } else{
               $('.city_check_uncheck_area').show();
            }
            
            $('.city-area').html(result);
            $('.showHide, .showHide .dropPop').show();
            $('#hider, #loadermodaldiv').hide();
         }
      });
   });

   $('#level_drop').on('change', function(){
      $('#hider, #loadermodaldiv').show();
      var LevelId = $(this).val();
      $.ajax({
         url: "ajax/ajax_call.php",
         method: "POST",
         data: {action: 'get_subjects', level_id: LevelId}, 
         success: function(result){
            if (result == '') {
               $('.subject_check_uncheck_area').hide();
            } else{
               $('.subject_check_uncheck_area').show();
            }
            $('.subject-area').html(result);
            $('.levelShowHide, .levelShowHide .dropPop').show();
            $('#hider, #loadermodaldiv').hide();
         }
      });
   });
   
   $(".dropbox").click(function(){
      $(this).next('.dropPop').stop();
      $(this).next('.dropPop').slideToggle("slow");
   });

   /* Add/Edit User */

   $('form#frmMain').submit(function(){
      var error = 0;
      var errEl = '';
      var reg_number = /^[0-9]+$/;
      var reg_email = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

      var elem = document.getElementById('frmMain').elements;
      for(var i = 0; i < elem.length; i++) {
         if (elem[i].hasAttribute("data-required")) {
            if (elem[i].type == 'radio' || elem[i].type == 'checkbox') {
               var elemName = document.getElementsByName(elem[i].name);
               var r_err = 0;
               for(var k = 0; k < elemName.length; k++) {
                  // alert(k+'='+elemName[k].checked)
                  if (elemName[k].checked == false) {
                     r_err++;
                  }  
               }
               // alert(r_err+'='+elemName.length)
               if (r_err == elemName.length) {
                  if (elemName != errEl) {
                     error++;
                     errEl = elemName;
                     var field_name  = elem[i].name;
                     var filed_label = field_name.substring(field_name.indexOf("_") + 1);
                         filed_label = filed_label.split('_').join(' ');
                         filed_label = filed_label.charAt(0).toUpperCase() + filed_label.slice(1);

                     getStickyNote ('error', filed_label + ' is required');   
                  }
                  
               }

            } else if(elem[i].value == '') {
               error++;
               var field_name  = elem[i].name;
               var filed_label = field_name.substring(field_name.indexOf("_") + 1);
                   filed_label = filed_label.split('_').join(' ');
                   filed_label = filed_label.charAt(0).toUpperCase() + filed_label.slice(1);

               getStickyNote ('error', filed_label + ' is required');
            }
         }

         if(elem[i].hasAttribute("data-numeric") && !elem[i].value.match(reg_number)) {
            error++;
            var field_name  = elem[i].name;
            var filed_label = field_name.substring(field_name.indexOf("_") + 1);
                filed_label = filed_label.split('_').join(' ');
                filed_label = filed_label.charAt(0).toUpperCase() + filed_label.slice(1);

            getStickyNote ('error', filed_label + ' must be numeric');
         }

         if(elem[i].hasAttribute("data-email") && !elem[i].value.match(reg_email)) {
            error++;
            var field_name  = elem[i].name;
            var filed_label = field_name.substring(field_name.indexOf("_") + 1);
                filed_label = filed_label.split('_').join(' ');
                filed_label = filed_label.charAt(0).toUpperCase() + filed_label.slice(1);

            getStickyNote ('error', filed_label + ' must be valid email');
         }
      }

      if (error > 0) {
         return false;  
      }
   });

   $('select[name=ud_current_occupation]').on('change', function(){
      if($(this).val() == 'Other') {
         $('input[name=ud_current_occupation_other]').show();
      } else {
         $('input[name=ud_current_occupation_other]').hide();
      }
   });

   function raceOther() {
      var v = $('input[name=ud_race]:checked').val();
      if (v == 'Others') {
         $('#other_race_wrap').html('<textarea name="ud_race" class="form-control"></textarea>');
      } else {
         $('#other_race_wrap').html('');
      }
   }

   function nationalityOther() {
      var n = $('input[name=ud_nationality]:checked').val();
      if (n == 'Non Malaysian') {
         $('#other_nationality_wrap').html('<textarea name="ud_nationality" class="form-control"></textarea>');
      } else {
         $('#other_nationality_wrap').html('');
      }
   }

   $('.udradio').on('click', function(){
      var ele = $(this).find('input[type=radio]').attr('name');
      if(ele == 'ud_race'){
         raceOther();
      }

      if(ele == 'ud_nationality'){
         nationalityOther();
      }
      
   });

   $('.iCheck-helper').on('click', function(){
      var ele = $(this).prev('input[type=radio]').attr('name');
      if(ele == 'ud_race'){
         raceOther();
      }

      if(ele == 'ud_nationality'){
         nationalityOther();
      }
      
   });

   $('#dob .input-group.date').datepicker({
      startView: 2,
      format: "dd/mm/yyyy",
      constrainInput: false
   });

});