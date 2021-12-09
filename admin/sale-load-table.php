<style>
/*
.tableFixHead          { overflow-y: auto; max-height: 450px; }
.tableFixHead thead th { position: sticky; top: 0; }

.table-header     { background:#eee; }

https://www.w3schools.com/jsref/tryit.asp?filename=tryjsref_element_scrollleft
*/
thead th { position: sticky; top: 0; }

.table-header     { background:#eee; }
</style>
<style>
#myDIV123 {
  max-height: 450px;
  width: auto;
  overflow: auto;
}

#content123 {
  max-height: 450px;
  width: auto;

}
</style>



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

    require_once("dbcontroller.php");
    $db_handle = new DBController();
    
    $sqlSelect = " SELECT main_id, tab_name, month, row_no FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND tab_name = '".$dataGrid['tab']."' AND month = '".$dataGrid['month']."' AND row_no != '0'  ";
    $resultSelect = $conn->query($sqlSelect);
    if ($resultSelect->num_rows > 0) {
    ?>
    

<div id="myDIV123" onscroll="myFunction123()">
  <div id="content123">
      

                    <table class="tbl-qa">
                      <thead>
                    	<tr>
                    	  <th class="table-header" style="font-size:14px;width:30px;text-align: center;" >No</th>
                    	  <th class="table-header" style="font-size:14px;width:80px;text-align: center;" > <span aria-label="Date Client Paid" data-balloon-pos="down" ><i class="fa fa-calendar" aria-hidden="true"></i></span> </th>
                    	  <th class="table-header" style="font-size:14px;width:50px;text-align: center;" >Job</th>
                    	  
                    	  <th class="table-header" style="font-size:14px;width:150px;text-align: center;" >Tutor Name</th>
                    	  <th class="table-header" style="font-size:14px;width:80px;text-align: center;" > <span aria-label="Amount received from Client" data-balloon-pos="down" ><i class="fa fa-usd" aria-hidden="true"></i></span> </th>
                    	  
                    	  <th class="table-header" style="font-size:14px;width:80px;text-align: center;" >Rate</th>
                    	  
                    	  <th class="table-header" style="font-size:14px;width:250px;text-align: center;border-right: 3px solid black;" >Note</th>
                    	  
                    	  <th class="table-header" style="font-size:14px;width:80px;text-align: center;" > <span aria-label="Date Tutor Paid" data-balloon-pos="down" ><i class="fa fa-calendar" aria-hidden="true"></i></span> </th>
                    	  <th class="table-header" style="font-size:14px;width:80px;text-align: center;" > <span aria-label="Amount paid/Refund to client" data-balloon-pos="down" ><i class="fa fa-money" aria-hidden="true"></i></span> </th>
                    	  

                    	  <th class="table-header" style="font-size:14px;width:80px;text-align: center;" >GP</th>
                    	  <th class="table-header" style="font-size:14px;width:50px;text-align: center;" > <span aria-label="Hours per cycle" data-balloon-pos="down" ><i class="fa fa-clock-o" aria-hidden="true"></i></span> </th>
                    	  <th class="table-header" style="font-size:14px;width:250px;text-align: center;" >Note</th>
                    	  
                    	  <th class="table-header" style="font-size:14px;width:140px;text-align: center;" >Actions</th>
                    	</tr>
                      </thead>
                      <tbody id="table-body" style="font-size:14px;">
                      <?php
                      //$sqlCF = " SELECT * FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND tab_name = '".$dataGrid['tab']."' AND month = '".$dataGrid['month']."' AND row_no != '0' AND cf != ''  ORDER BY cf ASC ";
                      $sqlCF = " SELECT * FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND tab_name = '".$dataGrid['tab']."' AND month = '".$dataGrid['month']."' AND row_no = '999999' ORDER BY cf ASC ";
                      $postsCF = $db_handle->runSelectQuery($sqlCF);
                      if(!empty($postsCF)) {
                          $previousValue = '';
                          foreach($postsCF as $kCF=>$vCF) {
                          ?>
                        	  <tr class="table-row" id="table-row-<?php echo $postsCF[$kCF]["cf"]; ?>">
                        		<td class="row-data" <?PHP if($postsCF[$kCF]["no3"] != 'R.F'){ ?> style="font-size:14px;width:30px;cursor: pointer;" <?PHP } ?> contenteditable="false" onkeyup="saveToDatabase(this,'row_no','<?php echo $postsCF[$kCF]["row_no"]; ?>','table-body')"   <?PHP if($postsCF[$kCF]["no3"] != 'R.F'){ ?> onClick="carryForward2(this,'row_no','<?php echo $postsCF[$kCF]["id"]; ?>','<?php echo $postsCF[$kCF]["cf"]; ?>');" <?PHP } ?>   >    <?php if($postsCF[$kCF]["no3"] != 'R.F'){ echo '+'; }//echo $postsCF[$kCF]["row_no"]; ?> </td>
                        		<td class="row-data" style="font-size:14px;width:80px;"                                 contenteditable="true"  onkeyup="saveToDatabase(this,'no1','<?php echo $postsCF[$kCF]["id"]; ?>','table-body')"         onClick="editRow(this,'remove','table-body');">                                                                                <?php echo $postsCF[$kCF]["no1"]; ?>  </td>
                        		<td class="row-data" style="font-size:14px;width:50px;"                                 contenteditable="true"  onkeyup="saveToDatabase(this,'no2','<?php echo $postsCF[$kCF]["id"]; ?>','table-body')"         onClick="editRow(this,'remove','table-body');">                                                                                <?php echo $postsCF[$kCF]["no2"]; ?>  </td>
                        	
                        		<td class="row-data" style="font-size:14px;width:150px;"                                contenteditable="true"  onkeyup="saveToDatabase(this,'no3','<?php echo $postsCF[$kCF]["id"]; ?>','table-body')"         onClick="editRow(this,'remove','table-body');">                                                                                <?php echo $postsCF[$kCF]["no3"]; ?>  </td>
                        		<td class="row-data" style="font-size:14px;width:80px;text-align: right;"               contenteditable="true"  onkeyup="saveToDatabase(this,'no4','<?php echo $postsCF[$kCF]["id"]; ?>','table-body')"         onClick="editRow(this,'remove','table-body');">                                                                                <?php echo $postsCF[$kCF]["no4"]; ?>  </td>
                        		
                        		<td class="row-data" style="font-size:14px;width:80px;text-align: right;"               contenteditable="true"  onkeyup="saveToDatabase(this,'no8','<?php echo $postsCF[$kCF]["id"]; ?>','table-body')"         onClick="editRow(this,'remove','table-body');">                                                                                <?php echo $postsCF[$kCF]["no8"]; ?>  </td>
                        		
                        		<td class="row-data" style="font-size:14px;width:250px;border-right: 3px solid black;"  contenteditable="true"  onkeyup="saveToDatabase(this,'no5','<?php echo $postsCF[$kCF]["id"]; ?>','table-body')"         onClick="editRow(this,'remove','table-body');">                                                                                <?PHP if( strlen($postsCF[$kCF]["no5"]) > 25 ){ ?><div style="overflow-y: scroll; height:20px;"><?php echo $postsCF[$kCF]["no5"]; ?></div><?PHP }else{ echo $postsCF[$kCF]["no5"]; }  ?>  </td>
<!--
                        		<td class="row-data" style="font-size:14px;width:80px;"                                <?PHP if( $postsCF[$kCF]["no3"] == 'R.F' ){ ?> contenteditable="false" <?PHP }else{ if( $postsCF[$kCF]["no6"] != '' && $postsCF[$kCF]["no7"] != '' ){ ?> contenteditable="true"  onkeyup="changeTutorPaid(this,'no6','<?php echo $postsCF[$kCF]["id"]; ?>','table-body')"         onClick="dateTutorPaidEdit(this,'saveManualno6','<?php echo $postsCF[$kCF]["id"]; ?>','table-body');" <?PHP }else{ ?> contenteditable="true"  onkeyup="changeTutorPaid(this,'no6','<?php echo $postsCF[$kCF]["id"]; ?>','table-body')"        onClick="dateTutorPaid(this,'saveManualno6','<?php echo $postsCF[$kCF]["id"]; ?>','table-body');" <?PHP }  } ?> >       <?php echo $postsCF[$kCF]["no6"]; ?>  </td>
                        		<td class="row-data" style="font-size:14px;width:80px;text-align: right;"              <?PHP if( $postsCF[$kCF]["no3"] == 'R.F' ){ ?> contenteditable="false" <?PHP }else{ if( $postsCF[$kCF]["no6"] != '' && $postsCF[$kCF]["no7"] != '' ){ ?> contenteditable="true"  onkeyup="changeTutorPaid(this,'no7','<?php echo $postsCF[$kCF]["id"]; ?>','table-body')"         onClick="dateTutorPaidEdit(this,'saveManualno7','<?php echo $postsCF[$kCF]["id"]; ?>','table-body');" <?PHP }else{ ?> contenteditable="true"  onkeyup="changeTutorPaid(this,'no7','<?php echo $postsCF[$kCF]["id"]; ?>','table-body')"        onClick="dateTutorPaid(this,'saveManualno7','<?php echo $postsCF[$kCF]["id"]; ?>','table-body');" <?PHP }  } ?> >       <?php echo $postsCF[$kCF]["no7"]; ?>  </td>
-->
                        		<td class="row-data" style="font-size:14px;width:80px;"                                <?PHP if( $postsCF[$kCF]["no3"] == 'R.F' ){ ?> contenteditable="false" <?PHP }else{ if( $postsCF[$kCF]["no6"] != '' && $postsCF[$kCF]["no7"] != '' ){ ?>contenteditable="true"  onkeyup="saveToDatabase(this,'no6','<?php echo $postsCF[$kCF]["id"]; ?>','table-body')"         onClick="editRow(this,'remove','table-body');"<?PHP }else{ ?> contenteditable="true"  onkeyup="changeTutorPaid(this,'no6','<?php echo $postsCF[$kCF]["id"]; ?>','table-body')"        onClick="dateTutorPaid(this,'saveManualno6','<?php echo $postsCF[$kCF]["id"]; ?>','table-body');" <?PHP }  } ?> >       <?php echo $postsCF[$kCF]["no6"]; ?>  </td>
                        		<td class="row-data" style="font-size:14px;width:80px;text-align: right;"              <?PHP if( $postsCF[$kCF]["no3"] == 'R.F' ){ ?> contenteditable="false" <?PHP }else{ if( $postsCF[$kCF]["no6"] != '' && $postsCF[$kCF]["no7"] != '' ){ ?>contenteditable="true"  onkeyup="saveToDatabase(this,'no7','<?php echo $postsCF[$kCF]["id"]; ?>','table-body')"         onClick="editRow(this,'remove','table-body');"<?PHP }else{ ?> contenteditable="true"  onkeyup="changeTutorPaid(this,'no7','<?php echo $postsCF[$kCF]["id"]; ?>','table-body')"        onClick="dateTutorPaid(this,'saveManualno7','<?php echo $postsCF[$kCF]["id"]; ?>','table-body');" <?PHP }  } ?> >       <?php echo $postsCF[$kCF]["no7"]; ?>  </td>
                        		
                        		<!--GP-->
                        		<td class="row-data" style="font-size:14px;width:80px;text-align: right;"               contenteditable="false"  onkeyup="saveToDatabase(this,'no9','<?php echo $postsCF[$kCF]["id"]; ?>','table-body')"          onClick="editRow(this,'remove','table-body');">                                                                           
                        		    <?php if( $postsCF[$kCF]["no4"] !='' &&  $postsCF[$kCF]["no7"] !='' ){
                        		        echo number_format(($postsCF[$kCF]["no4"] - $postsCF[$kCF]["no7"]),2);
                        		        }
                        		        if($postsCF[$kCF]["no3"] =='R.F' ){
                        		            //echo $postsCF[$kCF]["no9"];
                        		            $sqlPre = " SELECT id, no6, no7 FROM tk_sales_sub WHERE id = '".$previousValue."' ";
                        		            $resultPre = $conn->query($sqlPre);
                        		            if ($resultPre->num_rows > 0) {
                        		                $rowPre = $resultPre->fetch_assoc();
                        		                if($rowPre['no6'] != '' && $rowPre['no7'] != ''){
                        		                    echo $postsCF[$kCF]["no9"];
                        		                }
                        		            }
                        		        } ?>
                        		</td>
                        		
                        		
                        		<td class="row-data" style="font-size:14px;width:50px;"                                contenteditable="true"  onkeyup="saveToDatabase(this,'no10','<?php echo $postsCF[$kCF]["id"]; ?>','table-body')"         onClick="editRow(this,'remove','table-body');">                                                                                <?php echo $postsCF[$kCF]["no10"]; ?> </td>
                        		<!--<td class="row-data" style="font-size:14px;width:250px;"                               contenteditable="true"                                                                                                   onClick="dateTutorPaid(this,'saveManualno11','<?php echo $postsCF[$kCF]["id"]; ?>','table-body');">                            <?PHP if( strlen($postsCF[$kCF]["no11"]) > 25 ){ ?><div style="overflow-y: scroll; height:20px;"><?php echo $postsCF[$kCF]["no11"]; ?></div><?PHP }else{ echo $postsCF[$kCF]["no11"]; }  ?> </td>-->
                        		<td class="row-data" style="font-size:14px;width:250px;"                               <?PHP if( $postsCF[$kCF]["no11"] == '' ){ ?>contenteditable="true" onClick="dateTutorPaid(this,'saveManualno11','<?php echo $postsCF[$kCF]["id"]; ?>','table-body');" <?PHP }else{ ?> contenteditable="true" onkeyup="saveToDatabase(this,'no11','<?php echo $postsCF[$kCF]["id"]; ?>','table-body')" onClick="editRow(this,'remove','table-body');"   <?PHP }   ?> >                            <?PHP if( strlen($postsCF[$kCF]["no11"]) > 25 ){ ?><div style="overflow-y: scroll; height:20px;"><?php echo $postsCF[$kCF]["no11"]; ?></div><?PHP }else{ echo $postsCF[$kCF]["no11"]; }  ?> </td>
                        		
                        		<td style="font-size:14px;width:140px;"> 
                        		    <!-- <input style="margin: -1px; padding: 0; border-width: 1px;border:none;background:none;color:#28A745;font-weight: bold;" id="saveDateTutorPaid<?php //echo $postsCF[$kCF]["id"]; ?>" class="ajax-action-links hidden btnSaveEdit" type="button" value="Save" onclick="show(this,'saveManual','<?php //echo $postsCF[$kCF]["id"]; ?>','table-body')" /> -->
                        		    <i style="margin: -1px; padding: 0;" class="fa fa-check ajax-action-links hidden btnSaveEdit" id="saveDateTutorPaid<?php echo $postsCF[$kCF]["id"]; ?>" onclick="show(this,'saveManual','<?php echo $postsCF[$kCF]["id"]; ?>','table-body')" > </i>
                        		    
                        		    <a class="ajax-action-links" onclick="deleteRecordCF(<?php echo $postsCF[$kCF]["id"]; ?>);"><span class="" style="margin-left:5px; color:#872247;float:right;"><b>x</b></span></a> 
                        		</td>
                        	  </tr>
                          <?php
                          $previousValue = $postsCF[$kCF]["id"];
                          }
                    	  ?>
                    	  <tr class="table-row" style="height:35px;">
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td style="font-size:14px;width:250px;border-right: 3px solid black;"></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    		<td></td>
                    	  </tr>
                    	  <?PHP
                      }
                      
?></tbody><tbody id="table-body2" style="font-size:14px;"><?PHP
                      $allSales = array();
                      $queryallSales = " SELECT id, main_id, tab_name, month, row_no, cf FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND tab_name = '".$dataGrid['tab']."' AND month = '".$dataGrid['month']."' AND row_no != '0' AND cf != ''  ORDER BY cf ASC "; 
                      $resultallSales = $conn->query($queryallSales); 
                      if($resultallSales->num_rows > 0){ 
                            while($rowallSales = $resultallSales->fetch_assoc()){ 
                                $allSales[] = $rowallSales['id'];
                            }   
                      }
                
                      //$sql = " SELECT * FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND tab_name = '".$dataGrid['tab']."' AND month = '".$dataGrid['month']."' AND row_no != '0' ORDER BY row_no ASC ";
                      $sql = " SELECT * FROM tk_sales_sub WHERE main_id = '".$dataGrid['mainID']."' AND tab_name = '".$dataGrid['tab']."' AND month = '".$dataGrid['month']."' AND row_no != '0' AND id NOT IN ( '" . implode( "', '" , $allSales ) . "' ) ORDER BY row_no ASC ";
                      $posts = $db_handle->runSelectQuery($sql);
                      if(!empty($posts)) {
                          $i = 0;
                          $len = count($posts);
                          $previousValue = '';
                          foreach($posts as $k=>$v) {
                          ?>
                        	  <tr class="table-row table-rowCount" id="table-rowOri-<?php echo $posts[$k]["row_no"]; ?>">
                        		<!--<td class="row-data" <?PHP /*if ($i != $len - 1) { if($posts[$k]["no3"] != 'R.F'){ ?> style="font-size:14px;width:30px;cursor: pointer;" <?PHP }else{ ?> style="font-size:14px;width:30px;" <?PHP } }else{ ?> style="font-size:14px;width:30px;" <?PHP } ?>   contenteditable="false" onkeyup="saveToDatabase(this,'row_no','<?php echo $posts[$k]["row_no"]; ?>','table-body2')"   <?PHP if ($i != $len - 1) { if($posts[$k]["no3"] != 'R.F'){ ?> onClick="carryForward(this,'row_no','<?php echo $posts[$k]["id"]; ?>','<?php echo $posts[$k]["row_no"]; ?>');" <?PHP } } ?> >    <?php echo $posts[$k]["row_no"]; */ ?> </td>-->
                        		<td class="row-data" style="font-size:14px;width:30px;<?PHP if($posts[$k]["no3"] != 'R.F'){ ?> cursor: pointer; <?PHP } ?>"
                        		
                        		    contenteditable="false" onkeyup="saveToDatabase(this,'row_no','<?php echo $posts[$k]["row_no"]; ?>','table-body2')"   
                        		    
                        		    
                        		    
                        		    <?PHP 
                        		    if($posts[$k]["no3"] != 'R.F'){
                        		        if ($i != $len - 1) {
                        		            ?>onClick="carryForward(this,'row_no','<?php echo $posts[$k]["id"]; ?>','<?php echo $posts[$k]["row_no"]; ?>');"<?PHP
                        		        }else{
                        		            ?>onClick="carryForwardLastRow(this,'row_no','<?php echo $posts[$k]["id"]; ?>','<?php echo $posts[$k]["row_no"]; ?>');"<?PHP
                        		        }
                        		    }
                        		    ?>
                        		    
                        		    
                        		    >
                        		    <?php echo $posts[$k]["row_no"]; ?>
                        		</td>
                        		<td class="row-data" style="font-size:14px;width:80px;"                                 contenteditable="true"  onkeyup="saveToDatabase(this,'no1','<?php echo $posts[$k]["id"]; ?>','table-body2')"          onClick="editRow(this,'remove','table-body2');">                                                                           <?php echo $posts[$k]["no1"]; ?>  </td>
                        		<td class="row-data" style="font-size:14px;width:50px;"                                 contenteditable="true"  onkeyup="saveToDatabase(this,'no2','<?php echo $posts[$k]["id"]; ?>','table-body2')"          onClick="editRow(this,'remove','table-body2');">                                                                           <?php echo $posts[$k]["no2"]; ?>  </td>
                        	
                        		<td class="row-data" style="font-size:14px;width:150px;"                                contenteditable="true"  onkeyup="saveToDatabase(this,'no3','<?php echo $posts[$k]["id"]; ?>','table-body2')"          onClick="editRow(this,'remove','table-body2');">                                                                           <?php echo $posts[$k]["no3"]; ?>  </td>
                        		<td class="row-data" style="font-size:14px;width:80px;text-align: right;"               contenteditable="true"  onkeyup="saveToDatabase(this,'no4','<?php echo $posts[$k]["id"]; ?>','table-body2')"          onClick="editRow(this,'remove','table-body2');">                                                                           <?php echo $posts[$k]["no4"]; ?>  </td>
                        		
                        		<td class="row-data" style="font-size:14px;width:80px;text-align: right;"               contenteditable="true"  onkeyup="saveToDatabase(this,'no8','<?php echo $posts[$k]["id"]; ?>','table-body2')"          onClick="editRow(this,'remove','table-body2');">                                                                           <?php echo $posts[$k]["no8"]; ?>  </td>
                        		
                        		<td class="row-data" style="font-size:14px;width:250px;border-right: 3px solid black;"  contenteditable="true"  onkeyup="saveToDatabase(this,'no5','<?php echo $posts[$k]["id"]; ?>','table-body2')"          onClick="editRow(this,'remove','table-body2');">                                                                           <?PHP if( strlen($posts[$k]["no5"]) > 25 ){ ?><div style="overflow-y: scroll; height:20px;"><?php echo $posts[$k]["no5"]; ?></div><?PHP }else{ echo $posts[$k]["no5"]; }  ?>  </td> 
<!--
                        		<td class="row-data" style="font-size:14px;width:80px;"                                 <?PHP if( $posts[$k]["no3"] == 'R.F' ){ ?> contenteditable="false" <?PHP }else{ if( $posts[$k]["no6"] != '' && $posts[$k]["no7"] != '' ){ ?> contenteditable="true"  onkeyup="changeTutorPaid(this,'no6','<?php echo $posts[$k]["id"]; ?>','table-body2')"         onClick="dateTutorPaidEdit(this,'saveManualno6','<?php echo $posts[$k]["id"]; ?>','table-body2');" <?PHP }else{ ?> contenteditable="true"  onkeyup="changeTutorPaid(this,'no6','<?php echo $posts[$k]["id"]; ?>','table-body2')"         onClick="dateTutorPaid(this,'saveManualno6','<?php echo $posts[$k]["id"]; ?>','table-body2');" <?PHP }  } ?> >     <?php echo $posts[$k]["no6"]; ?>  </td>
                        		<td class="row-data" style="font-size:14px;width:80px;text-align: right;"               <?PHP if( $posts[$k]["no3"] == 'R.F' ){ ?> contenteditable="false" <?PHP }else{ if( $posts[$k]["no6"] != '' && $posts[$k]["no7"] != '' ){ ?> contenteditable="true"  onkeyup="changeTutorPaid(this,'no7','<?php echo $posts[$k]["id"]; ?>','table-body2')"         onClick="dateTutorPaidEdit(this,'saveManualno7','<?php echo $posts[$k]["id"]; ?>','table-body2');" <?PHP }else{ ?> contenteditable="true"  onkeyup="changeTutorPaid(this,'no7','<?php echo $posts[$k]["id"]; ?>','table-body2')"         onClick="dateTutorPaid(this,'saveManualno7','<?php echo $posts[$k]["id"]; ?>','table-body2');" <?PHP }  } ?> >     <?php echo $posts[$k]["no7"]; ?>  </td>
-->
                        		<td class="row-data" style="font-size:14px;width:80px;"                                 <?PHP if( $posts[$k]["no3"] == 'R.F' ){ ?> contenteditable="false" <?PHP }else{ if( $posts[$k]["no6"] != '' && $posts[$k]["no7"] != '' ){ ?>contenteditable="true"  onkeyup="saveToDatabase(this,'no6','<?php echo $posts[$k]["id"]; ?>','table-body2')" onClick="editRow(this,'remove','table-body2');"<?PHP }else{ ?> contenteditable="true"  onkeyup="changeTutorPaid(this,'no6','<?php echo $posts[$k]["id"]; ?>','table-body2')"         onClick="dateTutorPaid(this,'saveManualno6','<?php echo $posts[$k]["id"]; ?>','table-body2');" <?PHP }  } ?> >     <?php echo $posts[$k]["no6"]; ?>  </td>
                        		<td class="row-data" style="font-size:14px;width:80px;text-align: right;"               <?PHP if( $posts[$k]["no3"] == 'R.F' ){ ?> contenteditable="false" <?PHP }else{ if( $posts[$k]["no6"] != '' && $posts[$k]["no7"] != '' ){ ?>contenteditable="true"  onkeyup="saveToDatabase(this,'no7','<?php echo $posts[$k]["id"]; ?>','table-body2')" onClick="editRow(this,'remove','table-body2');"<?PHP }else{ ?> contenteditable="true"  onkeyup="changeTutorPaid(this,'no7','<?php echo $posts[$k]["id"]; ?>','table-body2')"         onClick="dateTutorPaid(this,'saveManualno7','<?php echo $posts[$k]["id"]; ?>','table-body2');" <?PHP }  } ?> >     <?php echo $posts[$k]["no7"]; ?>  </td>


                        		<!--GP-->
                        		<td class="row-data" style="font-size:14px;width:80px;text-align: right;"               contenteditable="false"  onkeyup="saveToDatabase(this,'no9','<?php echo $posts[$k]["id"]; ?>','table-body2')"          onClick="editRow(this,'remove','table-body2');">                                                                           
                        		    <?php if( $posts[$k]["no4"] !='' &&  $posts[$k]["no7"] !='' ){
                        		        echo number_format(($posts[$k]["no4"] - $posts[$k]["no7"]),2);
                        		        }
                        		        if($posts[$k]["no3"] =='R.F' ){
                        		            //echo $posts[$k]["no9"];
                        		            $sqlPre = " SELECT id, no6, no7 FROM tk_sales_sub WHERE id = '".$previousValue."' ";
                        		            $resultPre = $conn->query($sqlPre);
                        		            if ($resultPre->num_rows > 0) {
                        		                $rowPre = $resultPre->fetch_assoc();
                        		                if($rowPre['no6'] != '' && $rowPre['no7'] != ''){
                        		                    echo $posts[$k]["no9"];
                        		                }
                        		            }
                        		        } ?>
                        		</td>
                        		
                        		<td class="row-data" style="font-size:14px;width:50px;"                                 contenteditable="true"  onkeyup="saveToDatabase(this,'no10','<?php echo $posts[$k]["id"]; ?>','table-body2')"         onClick="editRow(this,'remove','table-body2');">                                                                           <?php echo $posts[$k]["no10"]; ?> </td>
                        		<!--<td class="row-data" style="font-size:14px;width:250px;"                                contenteditable="true"                                                                                                onClick="dateTutorPaid(this,'saveManualno11','<?php echo $posts[$k]["id"]; ?>','table-body2');">                           <?PHP if( strlen($posts[$k]["no11"]) > 25 ){ ?><div style="overflow-y: scroll; height:20px;"><?php echo $posts[$k]["no11"]; ?></div><?PHP }else{ echo $posts[$k]["no11"]; }  ?> </td>-->
                        		    <td class="row-data" style="font-size:14px;width:250px;"                                <?PHP if( $posts[$k]["no11"] == '' ){ ?>contenteditable="true" onClick="dateTutorPaid(this,'saveManualno11','<?php echo $posts[$k]["id"]; ?>','table-body2');" <?PHP }else{ ?> contenteditable="true" onkeyup="saveToDatabase(this,'no11','<?php echo $posts[$k]["id"]; ?>','table-body2')" onClick="editRow(this,'remove','table-body2');"   <?PHP }   ?>  >                           <?PHP if( strlen($posts[$k]["no11"]) > 25 ){ ?><div style="overflow-y: scroll; height:20px;"><?php echo $posts[$k]["no11"]; ?></div><?PHP }else{ echo $posts[$k]["no11"]; }  ?> </td>
                        		
                        		<td style="font-size:14px;width:140px;"> 
                        		    <!-- <input style="margin: -1px; padding: 0; border-width: 1px;border:none;background:none;color:#28A745;font-weight: bold;" id="saveDateTutorPaid<?php //echo $posts[$k]["id"]; ?>" class="ajax-action-links hidden btnSaveEdit" type="button" value="Save" onclick="show(this,'saveManual','<?php //echo $posts[$k]["id"]; ?>','table-body2')" /> -->
                        		    <i style="margin: -1px; padding: 0;" class="fa fa-check ajax-action-links hidden btnSaveEdit" id="saveDateTutorPaid<?php echo $posts[$k]["id"]; ?>" onclick="show(this,'saveManual','<?php echo $posts[$k]["id"]; ?>','table-body2')"   > </i>

                        		    <a class="ajax-action-links" onclick="deleteRecord(<?php echo $posts[$k]["id"]; ?>);"><span class="" style="margin-left:5px; color:#872247;float:right;"><b>x</b></span></a> <!-- glyphicon glyphicon-remove -->
                        		</td>
                        	  </tr>
                          <?php
                          $i++;
                          $previousValue = $posts[$k]["id"];
                          }
                      }
                      ?>
                      </tbody>
        
                      <tfoot id="loadFooterSale" ></tfoot>
        
                      
                    </table>      
      </div>
</div>
    
<div class="tableFixHead">
</div>
    <?PHP
    }else{
        echo '
            <table class="tbl-qa">
              <thead>
            	<tr>
            	  <th class="table-header" style="font-size:14px;width:30px;text-align: center;" >No</th>
            	  <th class="table-header" style="font-size:14px;width:80px;text-align: center;" > <span aria-label="Date Client Paid" data-balloon-pos="down" ><i class="fa fa-calendar" aria-hidden="true"></i></span> </th>
            	  <th class="table-header" style="font-size:14px;width:50px;text-align: center;" >Job</th>
            	  
            	  <th class="table-header" style="font-size:14px;width:150px;text-align: center;" >Tutor Name</th>
            	  <th class="table-header" style="font-size:14px;width:80px;text-align: center;" > <span aria-label="Amount received from Client" data-balloon-pos="down" ><i class="fa fa-usd" aria-hidden="true"></i></span> </th>
            	  
            	  <th class="table-header" style="font-size:14px;width:80px;text-align: center;" >Rate</th>
            	  
            	  <th class="table-header" style="font-size:14px;width:250px;text-align: center;border-right: 3px solid black;" >Note</th>
            	  
            	  <th class="table-header" style="font-size:14px;width:80px;text-align: center;" > <span aria-label="Date Tutor Paid" data-balloon-pos="down" ><i class="fa fa-calendar" aria-hidden="true"></i></span> </th>
            	  <th class="table-header" style="font-size:14px;width:80px;text-align: center;" > <span aria-label="Amount paid/Refund to client" data-balloon-pos="down" ><i class="fa fa-money" aria-hidden="true"></i></span> </th>
            	  
            	  
            	  <th class="table-header" style="font-size:14px;width:80px;text-align: center;" >GP</th>
            	  <th class="table-header" style="font-size:14px;width:50px;text-align: center;" > <span aria-label="Hours per cycle" data-balloon-pos="down" ><i class="fa fa-clock-o" aria-hidden="true"></i></span> </th>
            	  <th class="table-header" style="font-size:14px;width:250px;text-align: center;" >Note</th>
            	  
            	  <th class="table-header" style="font-size:14px;width:140px;text-align: center;" >Actions</th>
            	</tr>
              </thead>
              <tbody id="table-body2" style="font-size:14px;">

              </tbody>
              <tfoot>
                <tr style="background-color: white;">
                    <th class="table-header" style="font-size:14px;width:30px;" ></th>
                    <td class="table-header" style="font-size:14px;width:80px;"></td>
                    <td class="table-header" style="font-size:14px;width:50px;"></td>
                    
                    <td class="table-header" style="font-size:14px;width:150px;"></td>
                    <td class="table-header" style="font-size:14px;width:80px;text-align: right;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"> 0.00</td>
                    
                    <td class="table-header" style="font-size:14px;width:80px;text-align: right;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">0.00</td>
                    
                    <td class="table-header" style="font-size:14px;width:250px;border-right: 3px solid black;"></td>
                    
                    <td class="table-header" style="font-size:14px;width:80px;"></td>
                    <td class="table-header" style="font-size:14px;width:80px;text-align: right;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">0.00</td>
                    
                    
                    <td class="table-header" style="font-size:14px;width:80px;text-align: right;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">0.00</td>
                    <td class="table-header" style="font-size:14px;width:50px;border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">0</td>
                    <td class="table-header" style="font-size:14px;width:250px;"></td>
                    
                    <td class="table-header" style="font-size:14px;width:140px;"></td>
                </tr>
              </tfoot>
            </table>';
    }
    
}
$conn->close();
?>