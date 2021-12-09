<?php
require_once('classes/app.class.php');
$instApp = new app;

if(!empty($_POST["country_id"])) {
	$resSt = $instApp->FetchStatesByCountry($_POST["country_id"]);
	$arrCnt = $instApp->GetCountry($_POST["country_id"]);
?>
	
<?php
	while($arrSt = $resSt->fetch_assoc()) {
?>
	<tr class="footable-even" style="display: table-row;">
   <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
     <?php echo $arrCnt['c_name'];?>
	 </td>
	 
	 <td class="footable-visible">
	     <?php echo $arrSt['st_name'];?>
	 </td>

	 <td class="footable-visible">
	     <i class="fa <?=($arrSt['st_status']=='1')?'fa-check':'fa-times'?>  text-navy"></i>
	 </td>

	 <td class="footable-visible footable-last-column">
	   <div class="btn-group">
	     <a href="state-add.php?st=<?php echo $arrSt['st_id'];?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Edit</button></a>
	     <a href="state-list.php?std=<?php echo $arrSt['st_id'];?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Delete</button></a>              
	 </div>
	</td>
	</tr>
<?php
	}
}
?>