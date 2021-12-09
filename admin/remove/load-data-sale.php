<!-- DONE BACKUP -->
<?php
require_once('classes/config.php.inc');

// Create connection
$conn = new mysqli(HOSTNAME, DB_USER, DB_PASS, DBNAME);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed : ".str_replace(DB_USER, '********', $conn->connect_error);
    exit();
}

date_default_timezone_set("Asia/Kuala_Lumpur");



if(isset($_POST['dataGrid'])){
	$dataGrid = $_POST['dataGrid'];
	//$dataGrid['id']

    $sqlSelect = " SELECT id, main_id, tab_name FROM tk_sales_sub WHERE id = '".$dataGrid['id']."'  ";
    $resultSelect = $conn->query($sqlSelect);
    if ($resultSelect->num_rows > 0) {
        $rowSelect = $resultSelect->fetch_assoc();
        
            require_once("dbcontroller.php");
            $db_handle = new DBController();
            
            $sql = " SELECT * FROM tk_sales_sub WHERE main_id = '".$rowSelect['main_id']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataGrid['month']."' AND row_no != '0' ORDER BY row_no ASC ";
            $posts = $db_handle->runSelectQuery($sql);
            ?>
            <table class="tbl-qa">
              <thead>
            	<tr>
            	  <th class="table-header" style="font-size:14px;width:30px;" >No</th>
            	  <th class="table-header" style="font-size:14px;width:150px;" >Date Client Paid</th>
            	  <th class="table-header" style="font-size:14px;width:80px;" >Job</th>
            	  
            	  <th class="table-header" style="font-size:14px;width:200px;" >Tutor's Name</th>
            	  <th class="table-header" style="font-size:14px;width:80px;" >Received</th>
            	  <th class="table-header" style="font-size:14px;width:300px;" >Note</th>
            	  <th class="table-header" style="font-size:14px;width:150px;" >Date Tutor Paid</th>
            	  <th class="table-header" style="font-size:14px;width:300px;" >Paid to Tutor/Refund to pr</th>
            	  <th class="table-header" style="font-size:14px;width:80px;" >GST</th>
            	  <th class="table-header" style="font-size:14px;width:130px;" >Gross Profit</th>
            	  <th class="table-header" style="font-size:14px;width:80px;" >Hour</th>
            	  <th class="table-header" style="font-size:14px;width:300px;" >Note</th>
            	  
            	  <th class="table-header" style="font-size:14px;width:130px;" >Actions</th>
            	</tr>
              </thead>
              <tbody id="table-body" style="font-size:14px;">
              <?PHP
              if(!empty($posts)) {
                    foreach($posts as $k=>$v) {
                	  ?>
                	  <tr class="table-row numTable<?php echo $posts[$k]["row_no"]; ?>" id="table-row-<?php echo $posts[$k]["id"]; ?>">
                		<td class="row-data" style="font-size:14px;width:30px;cursor: pointer;"  contenteditable="false" onBlur="saveToDatabase(this,'row_no','<?php echo $posts[$k]["row_no"]; ?>')" onClick="carryForward(this,'row_no','<?php echo $posts[$k]["id"]; ?>','<?php echo $posts[$k]["row_no"]; ?>');"><?php echo $posts[$k]["row_no"]; ?></td>
                		<td class="row-data" style="font-size:14px;width:150px;" contenteditable="true" onBlur="saveToDatabase(this,'no1','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);">
                		    <?php echo $posts[$k]["no1"]; ?>
                		</td>
                		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no2','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php if($posts[$k]["no3"] != 'R.F'){echo $posts[$k]["no2"];} ?></td>
                	
                		<td class="row-data" style="font-size:14px;width:200px;" contenteditable="true" onBlur="saveToDatabase(this,'no3','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[$k]["no3"]; ?></td>
                		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no4','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[$k]["no4"]; ?></td>
                		<td class="row-data" style="font-size:14px;width:300px;" contenteditable="true" onBlur="saveToDatabase(this,'no5','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php if($posts[$k]["no3"] != 'R.F'){echo $posts[$k]["no5"];} ?></td>
                		
                		<td class="row-data" style="font-size:14px;width:150px;" contenteditable="true" onkeyup="changeTutorPaid(this,'no6','<?php echo $posts[$k]["id"]; ?>')" onClick="dateTutorPaid(this,'saveManualno6','<?php echo $posts[$k]["id"]; ?>');"><?php if($posts[$k]["no3"] != 'R.F'){echo $posts[$k]["no6"];} ?></td>
                		<td class="row-data" style="font-size:14px;width:300px;" contenteditable="true" onkeyup="changeTutorPaid(this,'no7','<?php echo $posts[$k]["id"]; ?>')" onClick="dateTutorPaid(this,'saveManualno7','<?php echo $posts[$k]["id"]; ?>');"><?php if($posts[$k]["no3"] != 'R.F'){echo $posts[$k]["no7"];} ?></td>
                		
                		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no8','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php if($posts[$k]["no3"] != 'R.F'){echo $posts[$k]["no8"];} ?></td>
                		<td class="row-data" style="font-size:14px;width:130px;"  contenteditable="true" onBlur="saveToDatabase(this,'no9','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php if($posts[$k]["no3"] != 'R.F'){echo $posts[$k]["no9"];} ?></td>
                		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no10','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php if($posts[$k]["no3"] != 'R.F'){echo $posts[$k]["no10"];} ?></td>
                		<td class="row-data" style="font-size:14px;width:300px;" contenteditable="true" onClick="dateTutorPaid(this,'saveManualno11','<?php echo $posts[$k]["id"]; ?>');"><?php echo $posts[$k]["no11"]; ?></td>
                		
                		<td style="font-size:14px;width:130px;" > <input style="border:none;background:none;color:#28A745;font-weight: bold;" id="saveDateTutorPaid<?php echo $posts[$k]["id"]; ?>" class="ajax-action-links hidden btnSaveEdit" type="button" value="Save" onclick="show(this,'saveManual','<?php echo $posts[$k]["id"]; ?>')" /> 
                		    <a class="ajax-action-links" onclick="deleteRecord(<?php echo $posts[$k]["id"]; ?>);"><span class="glyphicon glyphicon-remove" style="color:#872247"></span></a> 
                		</td>
                	  </tr>
                	  <?php
                    }
              }
              ?>
              </tbody>
              <tfoot id="loadFooterSale" ></tfoot>
            </table>
<?PHP
/*
            require_once("dbcontroller.php");
            $db_handle = new DBController();

            $sql = " SELECT * FROM tk_sales_sub WHERE main_id = '".$rowSelect['main_id']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataGrid['month']."' AND temp != 'Delete' AND row_no != '0' AND cf != ''  ORDER BY cf ASC, id ASC ";
            $posts = $db_handle->runSelectQuery($sql);
            ?>
            <table class="tbl-qa">
              <thead>
            	<tr>
            	  <th class="table-header" style="font-size:14px;width:30px;" >No</th>
            	  <th class="table-header" style="font-size:14px;width:150px;" >Date Client Paid</th>
            	  <th class="table-header" style="font-size:14px;width:80px;" >Job</th>
            	  
            	  <th class="table-header" style="font-size:14px;width:200px;" >Tutor's Name</th>
            	  <th class="table-header" style="font-size:14px;width:80px;" >Received</th>
            	  <th class="table-header" style="font-size:14px;width:300px;" >Note</th>
            	  <th class="table-header" style="font-size:14px;width:150px;" >Date Tutor Paid</th>
            	  <th class="table-header" style="font-size:14px;width:300px;" >Paid to Tutor/Refund to pr</th>
            	  <th class="table-header" style="font-size:14px;width:80px;" >GST</th>
            	  <th class="table-header" style="font-size:14px;width:130px;" >Gross Profit</th>
            	  <th class="table-header" style="font-size:14px;width:80px;" >Hour</th>
            	  <th class="table-header" style="font-size:14px;width:300px;" >Note</th>
            	  
            	  <th class="table-header" style="font-size:14px;width:130px;" >Actions</th>
            	</tr>
              </thead>
              <tbody id="table-body" style="font-size:14px;">
            	<?php
            	$lop == 0;
            	if(!empty($posts)) {
            	foreach($posts as $k=>$v) {
            	  ?>
            	  <tr class="table-row" id="table-row-<?php echo $posts[$k]["id"]; ?>">
            		<td class="row-data" style="font-size:14px;width:30px;cursor: pointer;"  contenteditable="false" onBlur="saveToDatabase(this,'row_no','<?php echo $posts[$k]["row_no"]; ?>')" onClick="carryForward(this,'row_no','<?php echo $posts[$k]["id"]; ?>');"><?php //echo $posts[$k]["row_no"]; ?></td>
            		<td class="row-data" style="font-size:14px;width:150px;" contenteditable="true" onBlur="saveToDatabase(this,'no1','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);">
            		    <?php echo $posts[$k]["no1"]; ?>
            		</td>
            		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no2','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php if($posts[$k]["no3"] != 'R.F'){echo $posts[$k]["no2"];} ?></td>
            	
            		<td class="row-data" style="font-size:14px;width:200px;" contenteditable="true" onBlur="saveToDatabase(this,'no3','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[$k]["no3"]; ?></td>
            		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no4','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[$k]["no4"]; ?></td>
            		<td class="row-data" style="font-size:14px;width:300px;" contenteditable="true" onBlur="saveToDatabase(this,'no5','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php if($posts[$k]["no3"] != 'R.F'){echo $posts[$k]["no5"];} ?></td>
            		
            		<td class="row-data" style="font-size:14px;width:150px;" contenteditable="true" onkeyup="changeTutorPaid(this,'no6','<?php echo $posts[$k]["id"]; ?>')" onClick="dateTutorPaid(this,'saveManualno6','<?php echo $posts[$k]["id"]; ?>');"><?php if($posts[$k]["no3"] != 'R.F'){echo $posts[$k]["no6"];} ?></td>
            		<td class="row-data" style="font-size:14px;width:300px;" contenteditable="true" onkeyup="changeTutorPaid(this,'no7','<?php echo $posts[$k]["id"]; ?>')" onClick="dateTutorPaid(this,'saveManualno7','<?php echo $posts[$k]["id"]; ?>');"><?php if($posts[$k]["no3"] != 'R.F'){echo $posts[$k]["no7"];} ?></td>
            		
            		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no8','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php if($posts[$k]["no3"] != 'R.F'){echo $posts[$k]["no8"];} ?></td>
            		<td class="row-data" style="font-size:14px;width:130px;"  contenteditable="true" onBlur="saveToDatabase(this,'no9','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php if($posts[$k]["no3"] != 'R.F'){echo $posts[$k]["no9"];} ?></td>
            		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no10','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php if($posts[$k]["no3"] != 'R.F'){echo $posts[$k]["no10"];} ?></td>
            		<td class="row-data" style="font-size:14px;width:300px;" contenteditable="true" onClick="dateTutorPaid(this,'saveManualno11','<?php echo $posts[$k]["id"]; ?>');"><?php echo $posts[$k]["no11"]; ?></td>
            		
            		<td style="font-size:14px;width:130px;" > <input style="border:none;background:none;color:#28A745;font-weight: bold;" id="saveDateTutorPaid<?php echo $posts[$k]["id"]; ?>" class="ajax-action-links hidden btnSaveEdit" type="button" value="Save" onclick="show(this,'saveManual','<?php echo $posts[$k]["id"]; ?>')" /> <a class="ajax-action-links" onclick="deleteRecord(<?php echo $posts[$k]["id"]; ?>);"><span class="glyphicon glyphicon-remove" style="color:#872247"></span></a> </td>
            	  </tr>
            	  <?php
            	}
                    	  ?>
                    	  <tr class="table-row" style="height:30px;">
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    	  </tr>
                    	  <?PHP
            	}
            	
                $allSales = array();
                $queryallSales = " SELECT id, main_id, tab_name, month, temp, row_no, cf FROM tk_sales_sub WHERE main_id = '".$rowSelect['main_id']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataGrid['month']."' AND temp != 'Delete' AND row_no != '0' AND cf != ''  ORDER BY cf ASC, id ASC "; 
                $resultallSales = $conn->query($queryallSales); 
                if($resultallSales->num_rows > 0){ 
                    while($rowallSales = $resultallSales->fetch_assoc()){ 
                        $allSales[] = $rowallSales['id'];
                    }     
                }
            	
            	$sql2 = " SELECT * FROM tk_sales_sub WHERE main_id = '".$rowSelect['main_id']."' AND tab_name = '".$rowSelect['tab_name']."' AND month = '".$dataGrid['month']."' AND temp != 'Delete' AND row_no != '0' AND id NOT IN ( '" . implode( "', '" , $allSales ) . "' ) ORDER BY cf DESC, id ASC ";
            	$posts2 = $db_handle->runSelectQuery($sql2);
            	if(!empty($posts2)) { 
            	    $numTable = 1;
            	    foreach($posts2 as $k2=>$v2) {
                	  ?>
                	  <tr class="table-row numTable<?php echo $numTable; ?>" id="table-row-<?php echo $posts2[$k2]["id"]; ?>">
                		<td class="row-data" style="font-size:14px;width:30px;cursor: pointer;"  contenteditable="false" onBlur="saveToDatabase(this,'row_no','<?php echo $posts2[$k2]["row_no"]; ?>')" onClick="carryForward(this,'row_no','<?php echo $posts2[$k2]["id"]; ?>','<?php echo $numTable; ?>');"><?php echo $numTable; ?></td>
                		<td class="row-data" style="font-size:14px;width:150px;" contenteditable="true" onBlur="saveToDatabase(this,'no1','<?php echo $posts2[$k2]["id"]; ?>')" onClick="editRow(this);">
                		    <?php echo $posts2[$k2]["no1"]; ?>
                		</td>
                		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no2','<?php echo $posts2[$k2]["id"]; ?>')" onClick="editRow(this);"><?php if($posts2[$k2]["no3"] != 'R.F'){echo $posts2[$k2]["no2"];} ?></td>
                	
                		<td class="row-data" style="font-size:14px;width:200px;" contenteditable="true" onBlur="saveToDatabase(this,'no3','<?php echo $posts2[$k2]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts2[$k2]["no3"]; ?></td>
                		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no4','<?php echo $posts2[$k2]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts2[$k2]["no4"]; ?></td>
                		<td class="row-data" style="font-size:14px;width:300px;" contenteditable="true" onBlur="saveToDatabase(this,'no5','<?php echo $posts2[$k2]["id"]; ?>')" onClick="editRow(this);"><?php if($posts2[$k2]["no3"] != 'R.F'){echo $posts2[$k2]["no5"];} ?></td>
                		
                		<td class="row-data" style="font-size:14px;width:150px;" contenteditable="true" onkeyup="changeTutorPaid(this,'no6','<?php echo $posts2[$k2]["id"]; ?>')" onClick="dateTutorPaid(this,'saveManualno6','<?php echo $posts2[$k2]["id"]; ?>');"><?php if($posts2[$k2]["no3"] != 'R.F'){echo $posts2[$k2]["no6"];} ?></td>
                		<td class="row-data" style="font-size:14px;width:300px;" contenteditable="true" onkeyup="changeTutorPaid(this,'no7','<?php echo $posts2[$k2]["id"]; ?>')" onClick="dateTutorPaid(this,'saveManualno7','<?php echo $posts2[$k2]["id"]; ?>');"><?php if($posts2[$k2]["no3"] != 'R.F'){echo $posts2[$k2]["no7"];} ?></td>
                		
                		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no8','<?php echo $posts2[$k2]["id"]; ?>')" onClick="editRow(this);"><?php if($posts2[$k2]["no3"] != 'R.F'){echo $posts2[$k2]["no8"];} ?></td>
                		<td class="row-data" style="font-size:14px;width:130px;"  contenteditable="true" onBlur="saveToDatabase(this,'no9','<?php echo $posts2[$k2]["id"]; ?>')" onClick="editRow(this);"><?php if($posts2[$k2]["no3"] != 'R.F'){echo $posts2[$k2]["no9"];} ?></td>
                		<td class="row-data" style="font-size:14px;width:80px;"  contenteditable="true" onBlur="saveToDatabase(this,'no10','<?php echo $posts2[$k2]["id"]; ?>')" onClick="editRow(this);"><?php if($posts2[$k2]["no3"] != 'R.F'){echo $posts2[$k2]["no10"];} ?></td>
                		<td class="row-data" style="font-size:14px;width:300px;" contenteditable="true" onClick="dateTutorPaid(this,'saveManualno11','<?php echo $posts2[$k2]["id"]; ?>');"><?php echo $posts2[$k2]["no11"]; ?></td>
                		
                		<td style="font-size:14px;width:130px;" > <input style="border:none;background:none;color:#28A745;font-weight: bold;" id="saveDateTutorPaid<?php echo $posts2[$k2]["id"]; ?>" class="ajax-action-links hidden btnSaveEdit" type="button" value="Save" onclick="show(this,'saveManual','<?php echo $posts2[$k2]["id"]; ?>')" /> 
                		    <a class="ajax-action-links" onclick="deleteRecord(<?php echo $posts2[$k2]["id"]; ?>);"><span class="glyphicon glyphicon-remove" style="color:#872247"></span></a> 
                		    class="table-row numTable<?php echo $numTable; ?>" id="table-row-<?php echo $posts2[$k2]["id"]; ?>"
                		</td>
                	  </tr>
                	  <?php
            	    $numTable++;
            	    }
            	}
            	
            	
            	
            	?>
              </tbody>

              <tfoot id="loadFooterSale" ></tfoot>

              
            </table>
            <?PHP        
*/
    }else{
        echo 'Error !!';
?>

            <table class="tbl-qa">
              <thead>
            	<tr>
            	  <th class="table-header" style="font-size:14px;width:30px;" >No</th>
            	  <th class="table-header" style="font-size:14px;width:150px;" >Date Client Paid</th>
            	  <th class="table-header" style="font-size:14px;width:80px;" >Job</th>
            	  
            	  <th class="table-header" style="font-size:14px;width:200px;" >Tutor's Name</th>
            	  <th class="table-header" style="font-size:14px;width:80px;" >Received</th>
            	  <th class="table-header" style="font-size:14px;width:300px;" >Note</th>
            	  <th class="table-header" style="font-size:14px;width:150px;" >Date Tutor Paid</th>
            	  <th class="table-header" style="font-size:14px;width:300px;" >Paid to Tutor/Refund to pr</th>
            	  <th class="table-header" style="font-size:14px;width:80px;" >GST</th>
            	  <th class="table-header" style="font-size:14px;width:130px;" >Gross Profit</th>
            	  <th class="table-header" style="font-size:14px;width:80px;" >Hour</th>
            	  <th class="table-header" style="font-size:14px;width:300px;" >Note</th>
            	  
            	  <th class="table-header" style="font-size:14px;width:130px;" >Actions</th>
            	</tr>
              </thead>
              <tbody id="table-body">

              </tbody>
              
            </table>
<?PHP      
        
        
        
    }





 
}


$conn->close();
?>