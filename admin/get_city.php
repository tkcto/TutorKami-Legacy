<?php
require_once('classes/app.class.php');
$instApp = new app;

if(!empty($_POST["state_id"])) {
	$resCt = $instApp->FetchCitiesByState($_POST["state_id"]);
	$arrSt = $instApp->GetState($_POST["state_id"]);
?>
	
<?php
	while($arrCt = $resCt->fetch_assoc()) {
?>
	<tr class="footable-even" style="display: table-row;">
   <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
     <?php echo $arrSt['st_name'];?>
	 </td>
	 
	 <td class="footable-visible">
	     <?php echo $arrCt['city_name'];?>
	 </td>

	 <td class="footable-visible">
	     <i class="fa <?=($arrCt['city_status']=='1')?'fa-check':'fa-times'?>  text-navy"></i>
	 </td>

	 <td class="footable-visible footable-last-column">
	   <div class="btn-group">
	     <a href="city-add.php?ct=<?php echo $arrCt['city_id'];?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Edit</button></a>
	     <a href="city-list.php?ctd=<?php echo $arrCt['city_id'];?>" class="gray-text"><button class="btn-white btn edt-btn btn-xs">Delete</button></a>              
	 </div>
	</td>
	</tr>
<?php
	}
}
?>