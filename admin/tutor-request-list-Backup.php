<?php 
require_once('includes/head.php');

require_once('classes/app.class.php');
require_once('classes/user.class.php');
$instApp = new app;
$instUser = new user;
if(isset($_REQUEST['tr'])){
 $arrRequest = $instApp->GetTutorRequest($_REQUEST['tr']);

 if(isset($_REQUEST['tr-save'])){

 $data = $instApp->RealEscape($_REQUEST);
 $res =  $instApp->UpdateTutorRequest($data);
 
 header('Location:tutor-request-list.php');
 exit();
}
}
else{
if(isset($_REQUEST['trd'])){
  $res = $instApp->DeleteTutorRequest($_REQUEST['trd']);
}
$resRequest = $instApp->FetchTutorRequest(); 
} 
?>
<!DOCTYPE html>
<html>

<head>

 <?php 
   $title = 'Tutor Request List | Tutorkami';
   require_once('includes/html_head.php'); 
 ?>

    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
    <style>
        .my-input-class {
            padding: 3px 6px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .my-confirm-class {
            padding: 3px 6px;
            font-size: 12px;
            color: white;
            text-align: center;
            vertical-align: middle;
            border-radius: 4px;
            background-color: #337ab7;
            text-decoration: none;
        }
        .my-cancel-class {
            padding: 3px 6px;
            font-size: 12px;
            color: white;
            text-align: center;
            vertical-align: middle;
            border-radius: 4px;
            background-color: #a94442;
            text-decoration: none;
        }
        .error {
            border: solid 1px;
            border-color: #a94442;
        }
        .destroy-button{
            padding:5px 10px 5px 10px;
            border: 1px blue solid;
            background-color:lightgray;
        }
    </style>

</head>
<body>
    <div id="wrapper">
        <?php include_once('includes/sidebar.php'); ?>

        <div id="page-wrapper" class="gray-bg">
            <?php include_once('includes/header.php'); ?>
            
            <div class="wrapper wrapper-content animated fadeInRight">
             <div class="row">
              <div class="col-lg-12">
               <div class="ibox float-e-margins">
                <div class="ibox-title">
                 <h5>Tutor Requests</h5>
                 <div class="el-right">
                  </div>
          </div>
          <div class="ibox-content">
          <?php if(isset($_REQUEST['tr'])){?>
   <form class="form-horizontal" action="" method="post">    <input type="hidden" name="tr_id" id="tr_id" value="<?php echo isset($_REQUEST['tr']) ? $arrRequest['tr_id'] : ''; ?>">                           
          <div class="form-group"><label class="col-lg-3 control-label">Request Status:</label>
            
            <div class="col-lg-7"><select class="form-control" name="tr_status">
              <option value="Active">Select Request Status</option>
              <option value="pending" <?php if(isset($_REQUEST['tr'])) echo $arrRequest['tr_status']=="pending"?'selected':''?>>Pending</option>
              <option value="accepted" <?php if(isset($_REQUEST['tr'])) echo $arrRequest['tr_status']=="accepted"?'selected':''?>>Accepted</option>
              <option value="rejected" <?php if(isset($_REQUEST['tr'])) echo $arrRequest['tr_status']=="rejected"?'selected':''?>>Rejected</option>
            </select></div>
          </div>
          <div class="form-group"><label class="col-lg-3 control-label">Managed by:</label>
            
            <div class="col-lg-7"><select class="form-control" name="tr_managed_by">
              <option value="">Select Managed by</option>
              <option value="C1" <?php if(isset($_REQUEST['tr'])) echo $arrRequest['tr_managed_by']=="coordinator@tutorkami.com"?'selected':''?>>coordinator@tutorkami.com</option>
              <option value="C2" <?php if(isset($_REQUEST['tr'])) echo $arrRequest['tr_managed_by']=="coordinator2@tutorkami.com"?'selected':''?>>coordinator2@tutorkami.com</option>
              <option value="C3" <?php if(isset($_REQUEST['tr'])) echo $arrRequest['tr_managed_by']=="coordinator3@tutorkami.com"?'selected':''?>>coordinator3@tutorkami.com</option>
            </select></div>
          </div>                                                                                                                          
          <div class="form-group">
            <div class="col-lg-offset-3 col-lg-9">
             <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="submit" name="tr-save">Save</button>
             

           </div>
         </div>

       </form>
<?php } else {?>

             <div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
              
<div class="row">

   <div class="col-sm-12">
   
    <table id="myAdvancedTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No </th>
                <th>Name </th>
                <th>Location </th>
                <th>Phone Number </th>
                <th>Subject </th>
                <th>Additional Comment </th>
                <th>Status </th>
                <th>Requested On </th>
                <th>Managed By </th>
				
            </tr>
        </thead>
</table>
   
   
   
   
   
   
   
   
   
<!--
    <table class="footable table table-stripped toggle-arrow-tiny default no-paging footable-loaded" data-page-size="15" id="dataTables">
     <thead>
      <tr>
        <th></th>
       <th class="footable-visible footable-first-column footable-sortable">Name<span class="footable-sort-indicator"></span></th>
       <th class="footable-visible footable-first-column footable-sortable">Location<span class="footable-sort-indicator"></span></th>
       <th data-hide="phone" class="footable-visible footable-sortable">Phone Number<span class="footable-sort-indicator"></span></th>
       <th data-hide="phone,tablet" class="footable-visible footable-sortable">Subject<span class="footable-sort-indicator"></span></th>
       <th data-hide="phone,tablet" class="footable-visible footable-sortable">Additional Comment<span class="footable-sort-indicator"></span></th>
       <th data-hide="phone,tablet" class="footable-visible footable-sortable">Status<span class="footable-sort-indicator"></span></th>
       <th data-hide="phone,tablet" class="footable-visible footable-sortable">Requested on<span class="footable-sort-indicator"></span></th>
       <th data-hide="phone,tablet" class="footable-visible footable-sortable">Managed by<span class="footable-sort-indicator"></span></th>
       <th data-hide="phone" class="footable-visible footable-sortable">Action<span class="footable-sort-indicator"></span></th>

   </tr>
</thead>
<tbody>
  <?php while($arrRequst = $resRequest->fetch_assoc()) { ?>
  <tr class="footable-even" style="display: table-row;">
   <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
     
    <?php echo $arrRequst['tr_id']; ?>
   </td>
   <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
     
    <?php echo $arrRequst['tr_name']; ?>
   </td>
   <td class="footable-visible">
     <?php echo $arrRequst['tr_location'];?>
   </td>
   <td class="footable-visible">
     <?php echo $arrRequst['tr_phone_number'];?>
   </td>

   <td class="footable-visible">
    <?php echo $arrRequst['tr_subject'];?>
     
   </td>
   <td class="footable-visible">
    <?php echo $arrRequst['tr_additional_comment'];?>
     
   </td>
   <td class="footable-visible">
    <?php echo $arrRequst['tr_status'];?>
     
   </td>
   <td class="footable-visible">
    <?php echo date('d/m/Y', strtotime($arrRequst['tr_create_date']));?>
     
   </td>

   <td class="footable-visible">
    <?php echo $arrRequst['tr_managed_by'];?>
     
   </td>

   <td class="footable-visible">
     <?php //echo $arrRequst['tr_status'];?> 
     
   </td>
   
  <td class="footable-visible footable-last-column">
   <div class="btn-group">
     <a href="tutor-request-list.php?tr=<?php echo $arrRequst['tr_id'];?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Edit</button></a>
     <a href="tutor-request-list.php?trd=<?php echo $arrRequst['tr_id'];?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Delete</button></a>              
 </div>
 </td>
</tr>
<?php } ?>


</tbody>

</table>-->

</div>

</div>                  
</div>
<?php } ?>
</div>
</div>
</div>
</div>
</div>

<?php include_once('includes/footer.php'); ?>

</div> 

</div>
<!-- Mainly scripts -->
<!--<script src="https://code.jquery.com/jquery-1.12.2.min.js"></script>-->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="http://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script>
jQuery.fn.dataTable.Api.register('MakeCellsEditable()', function (settings) {
    var table = this.table();

    jQuery.fn.extend({
        // UPDATE
        updateEditableCell: function (callingElement) {
            // Need to redeclare table here for situations where we have more than one datatable on the page. See issue6 on github
            var table = $(callingElement).closest("table").DataTable().table();
            var row = table.row($(callingElement).parents('tr'));
            var cell = table.cell($(callingElement).parents('td, th'));
            var columnIndex = cell.index().column;
            var inputField =getInputField(callingElement);

            // Update
            var newValue = inputField.val();
            if (!newValue && ((settings.allowNulls) && settings.allowNulls != true)) {
                // If columns specified
                if (settings.allowNulls.columns) {
                    // If current column allows nulls
                    if (settings.allowNulls.columns.indexOf(columnIndex) > -1) {
                        _update(newValue);
                    } else {
                        _addValidationCss();
                    }
                    // No columns allow null
                } else if (!newValue) {
                    _addValidationCss();
                }
                //All columns allow null
            } else if (newValue && settings.onValidate) {
                if (settings.onValidate(cell, row, newValue)) {
                    _update(newValue);
                } else {
                    _addValidationCss();
                }
            }
            else {
                _update(newValue);
            }
            function _addValidationCss() {
                // Show validation error
                if (settings.allowNulls.errorClass) {
                    $(inputField).addClass(settings.allowNulls.errorClass);
                } else {
                    $(inputField).css({ "border": "red solid 1px" });
                }
            }
            function _update(newValue) {
                var oldValue = cell.data();
                cell.data(newValue);
                //Return cell & row.
                settings.onUpdate(cell, row, oldValue);
            }
            // Get current page
            var currentPageIndex = table.page.info().page;

            //Redraw table
            table.page(currentPageIndex).draw(false);
        },
        // CANCEL
        cancelEditableCell: function (callingElement) {
            var table = $(callingElement.closest("table")).DataTable().table();
            var cell = table.cell($(callingElement).parents('td, th'));
            // Set cell to it's original value
            cell.data(cell.data());

            // Redraw table
            table.draw();
        }
    });

    // Destroy
    if (settings === "destroy") {
        $(table.body()).off("click", "td");
        table = null;
    }

    if (table != null) {
        // On cell click
        $(table.body()).on('click', 'td', function () {

            var currentColumnIndex = table.cell(this).index().column;

            // DETERMINE WHAT COLUMNS CAN BE EDITED
            if ((settings.columns && settings.columns.indexOf(currentColumnIndex) > -1) || (!settings.columns)) {
                var row = table.row($(this).parents('tr'));
                editableCellsRow = row;

                var cell = table.cell(this).node();
                var oldValue = table.cell(this).data();
                // Sanitize value
                oldValue = sanitizeCellValue(oldValue);

                // Show input
                if (!$(cell).find('input').length && !$(cell).find('select').length && !$(cell).find('textarea').length) {
                    // Input CSS
                    var input = getInputHtml(currentColumnIndex, settings, oldValue);
                    $(cell).html(input.html);
                    if (input.focus) {
                        $('#ejbeatycelledit').focus();
                    }
                }
            }
        });
    }

});

function getInputHtml(currentColumnIndex, settings, oldValue) {
    var inputSetting, inputType, input, inputCss, confirmCss, cancelCss, startWrapperHtml = '', endWrapperHtml = '', listenToKeys = false;

    input = {"focus":true,"html":null};

    if(settings.inputTypes){
		$.each(settings.inputTypes, function (index, setting) {
			if (setting.column == currentColumnIndex) {
				inputSetting = setting;
				inputType = inputSetting.type.toLowerCase();
			}
		});
	}

    if (settings.inputCss) { inputCss = settings.inputCss; }
    if (settings.wrapperHtml) {
        var elements = settings.wrapperHtml.split('{content}');
        if (elements.length === 2) {
            startWrapperHtml = elements[0];
            endWrapperHtml = elements[1];
        }
    }
    
    if (settings.confirmationButton) {
        if (settings.confirmationButton.listenToKeys) { listenToKeys = settings.confirmationButton.listenToKeys; }
        confirmCss = settings.confirmationButton.confirmCss;
        cancelCss = settings.confirmationButton.cancelCss;
        inputType = inputType + "-confirm";
    }
    switch (inputType) {
        case "list":
            input.html = startWrapperHtml + "<select class='" + inputCss + "' onchange='$(this).updateEditableCell(this);'>";
            $.each(inputSetting.options, function (index, option) {
                if (oldValue == option.value) {
                   input.html = input.html + "<option value='" + option.value + "' selected>" + option.display + "</option>"
                } else {
                   input.html = input.html + "<option value='" + option.value + "' >" + option.display + "</option>"
                }
            });
            input.html = input.html + "</select>" + endWrapperHtml;
            input.focus = false;
            break;
        case "list-confirm": // List w/ confirm
            input.html = startWrapperHtml + "<select class='" + inputCss + "'>";
            $.each(inputSetting.options, function (index, option) {
                if (oldValue == option.value) {
                   input.html = input.html + "<option value='" + option.value + "' selected>" + option.display + "</option>"
                } else {
                   input.html = input.html + "<option value='" + option.value + "' >" + option.display + "</option>"
                }
            });
            input.html = input.html + "</select>&nbsp;<a href='javascript:void(0);' class='" + confirmCss + "' onclick='$(this).updateEditableCell(this);'>Confirm</a> <a href='javascript:void(0);' class='" + cancelCss + "' onclick='$(this).cancelEditableCell(this)'>Cancel</a>" + endWrapperHtml;
            input.focus = false;
            break;
        case "datepicker": //Both datepicker options work best when confirming the values
        case "datepicker-confirm":
            // Makesure jQuery UI is loaded on the page
            if (typeof jQuery.ui == 'undefined') {
                alert("jQuery UI is required for the DatePicker control but it is not loaded on the page!");
                break;
            }
	        jQuery(".datepick").datepicker("destroy");
	        input.html = startWrapperHtml + "<input id='ejbeatycelledit' type='text' name='date' class='datepick " + inputCss + "'   value='" + oldValue + "'></input> &nbsp;<a href='javascript:void(0);' class='" + confirmCss + "' onclick='$(this).updateEditableCell(this)'>Confirm</a> <a href='javascript:void(0);' class='" + cancelCss + "' onclick='$(this).cancelEditableCell(this)'>Cancel</a>" + endWrapperHtml;
	        setTimeout(function () { //Set timeout to allow the script to write the input.html before triggering the datepicker
	            var icon = "http://jqueryui.com/resources/demos/datepicker/images/calendar.gif";
                // Allow the user to provide icon
	            if (typeof inputSetting.options !== 'undefined' && typeof inputSetting.options.icon !== 'undefined') {
	                icon = inputSetting.options.icon;
	            }
	            var self = jQuery('.datepick').datepicker(
                    {
                        showOn: "button",
                        buttonImage: icon,
                        buttonImageOnly: true,
                        buttonText: "Select date"
                    });
	        },100);
	        break;
        case "text-confirm": // text input w/ confirm
            input.html = startWrapperHtml + "<input id='ejbeatycelledit' class='" + inputCss + "' value='"+oldValue+"'" + (listenToKeys ? " onkeyup='if(event.keyCode==13) {$(this).updateEditableCell(this);} else if (event.keyCode===27) {$(this).cancelEditableCell(this);}'" : "") + "></input>&nbsp;<a href='javascript:void(0);' class='" + confirmCss + "' onclick='$(this).updateEditableCell(this)'>Confirm</a> <a href='javascript:void(0);' class='" + cancelCss + "' onclick='$(this).cancelEditableCell(this)'>Cancel</a>" + endWrapperHtml;
            break;
        case "undefined-confirm": // text input w/ confirm
            input.html = startWrapperHtml + "<input id='ejbeatycelledit' class='" + inputCss + "' value='" + oldValue + "'" + (listenToKeys ? " onkeyup='if(event.keyCode==13) {$(this).updateEditableCell(this);} else if (event.keyCode===27) {$(this).cancelEditableCell(this);}'" : "") + "></input>&nbsp;<a href='javascript:void(0);' class='" + confirmCss + "' onclick='$(this).updateEditableCell(this)'>Confirm</a> <a href='javascript:void(0);' class='" + cancelCss + "' onclick='$(this).cancelEditableCell(this)'>Cancel</a>" + endWrapperHtml;
            break;
        case "textarea":
        case "textarea-confirm":
            input.html = startWrapperHtml + "<textarea id='ejbeatycelledit' class='" + inputCss + "'>"+oldValue+"</textarea><a href='javascript:void(0);' class='" + confirmCss + "' onclick='$(this).updateEditableCell(this)'>Confirm</a> <a href='javascript:void(0);' class='" + cancelCss + "' onclick='$(this).cancelEditableCell(this)'>Cancel</a>" + endWrapperHtml;
            break;
        default: // text input
            input.html = startWrapperHtml + "<input id='ejbeatycelledit' class='" + inputCss + "' onfocusout='$(this).updateEditableCell(this)' value='" + oldValue + "'></input>" + endWrapperHtml;
            break;
    }
    return input;
}

function getInputField(callingElement) {
    // Update datatables cell value
    var inputField;
    switch ($(callingElement).prop('nodeName').toLowerCase()) {
        case 'a': // This means they're using confirmation buttons
            if ($(callingElement).siblings('input').length > 0) {
                inputField = $(callingElement).siblings('input');
            }
            if ($(callingElement).siblings('select').length > 0) {
                inputField = $(callingElement).siblings('select');
            }
            if ($(callingElement).siblings('textarea').length > 0) {
                inputField = $(callingElement).siblings('textarea');
            }
        break;
        default:
            inputField = $(callingElement);
    }
    return inputField;
}

function sanitizeCellValue(cellValue) {
    if (typeof (cellValue) === 'undefined' || cellValue === null || cellValue.length < 1) {
        return "";
    }

    // If not a number
    if (isNaN(cellValue)) {
        // escape single quote
        cellValue = cellValue.replace(/'/g, "&#39;");
    }
    return cellValue;
}




var table;
$(document).ready(function () {
	
fill_datatable();
		function fill_datatable(id = ''){
			var table = $('#myAdvancedTable').DataTable({
				"processing" : true,
				"serverSide" : true,
				"columnDefs": [
					{
						"targets": [ 0,6 ],
						"visible": false,
						"searchable": false
					}
				],
				"searching" : false,
				"ordering": false,
				"ajax" : {
					url:"tutor-request-list-proses.php",
					type:"POST",
					data:{
						id:id
					}
				}
			});
			
			

    table.MakeCellsEditable({
        "onUpdate": myCallbackFunction,
        "inputCss":'my-input-class',
		"columns": [6,8],
        /*"columns": [0,1,2,3],
        "allowNulls": {
            "columns": [3],
            "errorClass": 'error'
        },*/
        "confirmationButton": { // could also be true
            "confirmCss": 'my-confirm-class',
            "cancelCss": 'my-cancel-class'
        },
		"inputTypes": [
            {
                "column":6, 
                "type": "list",
                "options":[
                    { "value": "pending", "display": "Pending" },
                    { "value": "accepted", "display": "accepted" },
                    { "value": "rejected", "display": "Rejected" }
                ]
            },
            {
                "column":8, 
                "type": "list",
                "options":[
                    { "value": "C1", "display": "C1" },
                    { "value": "C2", "display": "C2" },
                    { "value": "C3", "display": "C3" }
                ]
            }
		]
		/*
        "inputTypes": [
            {
                "column": 0,
                "type": "text",
                "options": null
            },
            {
                "column":1, 
                "type": "list",
                "options":[
                    { "value": "1", "display": "Beaty" },
                    { "value": "2", "display": "Doe" },
                    { "value": "3", "display": "Dirt" }
                ]
            },
            {
                "column": 2,
                "type": "datepicker", 
                "options": {
                    "icon": "http://jqueryui.com/resources/demos/datepicker/images/calendar.gif" // Optional
                }
            }
             // Nothing specified for column 3 so it will default to text
            
        ] */
    });

			
			
		}
	
	

});

function myCallbackFunction (updatedCell, updatedRow, oldValue) {
    //alert("The new value for the cell is: " + updatedCell.data());
    //alert("The old value for that cell was: " + oldValue);
    //alert("The values for each cell in that row are: " + updatedRow.data());
    $.ajax({
		type: "POST",
		data: {insert: updatedRow.data()},
		url: "tutor-request-list-proses.php",
		success: function(result){
			//alert("= " + result);
		}
    });
	
}

function destroyTable() {
    if ($.fn.DataTable.isDataTable('#myAdvancedTable')) {
        table.destroy();
        table.MakeCellsEditable("destroy");
    }
}
</script>
</body>
</html>
