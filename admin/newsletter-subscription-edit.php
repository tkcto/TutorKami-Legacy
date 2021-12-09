
      <div class="wrapper wrapper-content animated fadeInRight">
       <div class="row">
        <div class="col-lg-12">
         <div class="ibox float-e-margins">
          <div class="ibox-title">
           <h5>Newsletter Edit</h5>

         </div>
         <div class="ibox-content">
          <form class="form-horizontal" action="" method="post"> 
            <input type="hidden" name="news_id" id="news_id" value="<?php echo isset($_REQUEST['nw']) ? $arrNews['news_id'] : ''; ?>">                              
            <div class="form-group"><label class="col-lg-3 control-label">Email:</label>

              <div class="col-lg-7"><input type="text" class="form-control" name="news_email" value="<?php echo isset($_REQUEST['nw']) ? $arrNews['news_email'] : ''; ?>" required> 
              </div>
            </div>
            
           <div class="form-group"><label class="col-lg-3 control-label">Status:</label>

            <div class="col-lg-7"><select class="form-control" name="news_status">
              <option value="A" <?php if(isset($_REQUEST['nw'])) echo $arrNews['news_status']=="A"?'selected':''?>>Active</option>
              <option value="D" <?php if(isset($_REQUEST['nw'])) echo $arrNews['news_status']=="D"?'selected':''?>>Inactive</option>
            </select></div>
          </div>                                                             
          <div class="form-group">
            <div class="col-lg-offset-3 col-lg-9">
             <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="submit" name="n-save">Save</button>
             <!-- <button class="btn btn-sm btn-primary sign-btn-box mrg-right-15" type="submit">Save and Continue Edit</button> -->

           </div>
         </div>

       </form>
     </div>
   </div>
 </div>
</div>
</div>

