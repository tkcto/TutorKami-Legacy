<script src="https://kit.fontawesome.com/13ee0d0c31.js" crossorigin="anonymous"></script>
<div class="row border-bottom">
   <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
      <div class="navbar-header">
         <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
      </div>
      <ul class="nav navbar-top-links navbar-right">
         <li>
            <a href="whatsapp.php"  title="WhatsApp "> <!--<i class="fa fa-whatsapp" style="font-size:16px;color:green;"></i>--> <span style="font-size:14px;" class="badge badge-danger" id="waValue"></span> WhatsApp </a>
         </li>
         <li>
            <a href="<?php echo APP_ROOT;?>blog/wp-login.php" target="_blank" title="Blog Admin"><i class="fa fa-wordpress"></i> Blog Admin</a>
         </li>
         <li>
            <a href="<?php echo APP_ROOT;?>" target="_blank" title="Site"><i class="fa fa-home"></i>Visit Site</a>
         </li>
         <li>
            <span class="m-r-sm text-muted welcome-message">Welcome <?=$_SESSION[DB_PREFIX]['u_first_name']?></span>
         </li>
         <li>
            <a href="logout.php">
            <i class="fa fa-sign-out"></i> Log out
            </a>
         </li>
      </ul>
   </nav>
</div>
<?php 
$current_page = basename($_SERVER['PHP_SELF']);
$current_page = str_replace('php', '', $current_page);
$getbreadcrumb = $instSys->GetBreadCrumb($current_page);
$breadcrumb = $getbreadcrumb->fetch_array(MYSQLI_ASSOC);

$page_name = (isset($_GET) && count($_GET) > 0) ? str_replace('Add', 'Edit', $breadcrumb['m_name']) : $breadcrumb['m_name'];
?>
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-10">
      <h2><?php echo $page_name; ?></h2>
      <ol class="breadcrumb">
         <li>
            <a href="<?php echo ($breadcrumb['parent_url'] != '') ? $breadcrumb['parent_url'] : '#'; ?>"><?php echo ($breadcrumb['parent_name'] != '') ? $breadcrumb['parent_name'] : 'Home'; ?></a>
         </li>
         <li class="active">
            <strong><?php echo $page_name; ?></strong>
            <?PHP if( $page_name == 'Job Edit' ){ echo ' <a href="https://docs.google.com/document/d/1vx3PNzQg5N9MV3-MK7tqzaB_9B-hZgtKeX6x-9FF0Rs/edit" target="_blank" ><i class="glyphicon glyphicon-info-sign" style="color:#262262" ></i></a> '; } ?>
            <?PHP if( $page_name == 'Add User' ){ echo ' <a href="https://docs.google.com/document/d/15Q-jj-Z7l7eSRIEr9ghW6usfYeB2GDkLc_VW68qdHlA/edit" target="_blank" ><i class="glyphicon glyphicon-info-sign" style="color:#262262" ></i></a> '; } ?>
            <?PHP if( $page_name == 'Job Add' ){ echo ' <a href="https://docs.google.com/document/d/15Q-jj-Z7l7eSRIEr9ghW6usfYeB2GDkLc_VW68qdHlA/edit" target="_blank" ><i class="glyphicon glyphicon-info-sign" style="color:#262262" ></i></a> '; } ?>
         </li>
      </ol>
   </div>
</div>
