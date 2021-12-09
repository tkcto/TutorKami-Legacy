<?php 
require_once('includes/head.php');

require_once('classes/app.class.php');
require_once('classes/user.class.php');
$instApp = new app;
$instUser = new user;

if($_SESSION[DB_PREFIX]['u_first_name'] == 'temporary staff'){
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>

 <?php 
   $title = 'Tutor Request List | Tutorkami';
   require_once('includes/html_head.php'); 
 ?>
<!--<link rel="stylesheet" href="../files/datatableserverside_makecellseditable/dataTables.bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="../files/datatableserverside_makecellseditable/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="../files/datatableserverside_makecellseditable/jquery-ui.css" />
-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
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

<?php 
$sessionIDLogin = $_SESSION[DB_PREFIX]['u_id'];
$thisPage = $breadcrumb['m_name'].' Page';
/*$dbCon = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);
if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
} */
$updateLastPage = " UPDATE tk_user SET last_page='".$thisPage."' WHERE u_id='".$sessionIDLogin."' ";
if ( $conDB->query($updateLastPage) === TRUE ) {
    //echo "Update Is Successful";
}
//$dbCon->close();
?>
            
			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
					<div class="col-lg-12">
						<div class="ibox float-e-margins">
							<div class="ibox-title">
								<h5>Tutor Requests</h5>
								<div class="el-right"></div>
							</div>
							<div class="ibox-content">

								<div id="editable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
									<div class="row">
										<div class="col-sm-12">
   
										<table id="myAdvancedTable" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th width="1%">No </th>
													<th width="5%">Name </th>
													<th width="10%">Location<font style="opacity: 0;">Subject</font> </th>
													<th width="5%">Phone Number </th>
													<th width="10%">Subject<font style="opacity: 0;">Location</font> </th>
													<th width="50%">Additional Comment <font style="opacity: 0;">AdditionalCommentAdditionalComment</font></th>
													<th width="9%">Status </th>
													<th width="5%">Requested On </th>
													<th width="5%">Managed By </th>
												</tr>
											</thead>
										</table>

										</div>
									</div>                  
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>

			<?php include_once('includes/footer.php'); ?>
        </div> 
</div>

<script src="js/plugins/dataTables/datatables.min.js"></script>
<!--<script src="../files/datatableserverside_makecellseditable/jquery-ui.min.js"></script>
<script src="../files/datatableserverside_makecellseditable/jquery.dataTables.min.js"></script>-->
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
$(document).ready(function(){
		

fill_datatable();
		function fill_datatable(id = ''){
			var table = $('#myAdvancedTable').DataTable({
                "scrollX": true,
				"processing" : true,
				"serverSide" : true,
				"columnDefs": [
					{
						"targets": [ 0,6 ],
						"visible": false,
						"searchable": false
					}
				],
				"searching" : true,
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
                    { "value": "C3", "display": "C3" },
                    { "value": "MM", "display": "MM" }
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
    /*alert("The new value for the cell is: " + updatedCell.data());
    alert("The old value for that cell was: " + oldValue);
    alert("The values for each cell in that row are: " + updatedRow.data());*/
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
