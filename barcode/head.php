<?php require_once('config.php'); ?>
<?php date_default_timezone_set('Asia/Manila'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">    
<title><?php echo $clientalias ;?> Information System</title>

<link href="../assets/css.css" rel="stylesheet">
<link href="../assets/font-awesome.min.css" rel="stylesheet">
<link href="../assets/extra-css.css" rel="stylesheet">
<link href="../plugins/facebox/src/facebox.css" rel="stylesheet" />
<link href="../plugins/datatables/css/demo_table_jui.css" rel="stylesheet" />
<link href="../plugins/datatables/themes/ui-lightness/jquery-ui-1.8.4.custom.css" rel="stylesheet" />
    
<script src="../assets/modernizr.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../assets/jquery.js"></script>
<script src="../assets/bootstrap.js"></script>
<script src="../plugins/datatables/js/jquery.dataTables.js" type="text/javascript"></script>
<script src="../plugins/facebox/src/facebox.js" type="text/javascript"></script>
<script>
<!--
jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : '../plugins/facebox/src/loading.gif',
        closeImage   : '../plugins/facebox/src/closelabel.png'
      })
    })
//-->
</script>

<script>
  $(document).ready(function(){
    $('#datatables').dataTable({
      "sPaginationType":"full_numbers",
      "aaSorting":[[1, "asc"]],
      "bJQueryUI":true
  });
    $("#datatables_filter input").focus();
  })
</script>

<script>
	function doRefresh()
{
  $("#show").load("notification.php");
  setTimeout(function() {
    doRefresh();
  }, <?php echo rand(300000,305000); ?>);
}

$(document).ready(function () {
  doRefresh(); 
});
</script>

</head>

<body>

    <div class="navbar-inverse navbar-fixed-top">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <div class="navbar-brand">
                <a href="#" class="denr-logo"></a>
            </div>

            <div class="navbar-brand">
                <a href="#" class="denr-system-name"><?php echo $clientalias ;?> - Information Systems</a>
            </div>
        </div>

        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                    <li id="show"></li>
                    <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        
        <div class="navbar-default submenu">
                
                      <span><a class="submenu" href="home.php?tb1_colunm1=Document-Tracking">Home</a>&nbsp;|</span>
                      <span><a class="submenu" href="../barcode/list_document_barcode.php">Document Barcoding</a>&nbsp;|</span>
                      <span><a class="submenu" href="../dats/list_documents.php?tb1_colunm1=Document-Tracking">Document Tracking</a>&nbsp;|</span>
                      <span><a class="submenu" href="../support/list_tech-assist.php?tb1_colunm1=Tech-Assist">Request for Technical Assistance</a>&nbsp;|</span>
                      <span><a class="submenu" href="../so/list_so.php?tb1_colunm1=Special-Order&type=advance">Special Order</a>&nbsp;|</span>
                      <span><a class="submenu" href="../mo/list_mo.php?tb1_colunm1=Memorandum-Order&type=advance">Memo Order</a>&nbsp;|</span>
                      <span><a class="submenu" href="../mc/list_mc.php?tb1_colunm1=Memorandum-Circular&type=advance">Memo Circular</a>&nbsp;|</span>
                      <span><a class="submenu" href="../memo/list_memo.php?tb1_colunm1=Memorandum&type=advance">Memorandum</a>&nbsp;|</span>
                      <span><a class="submenu" href="../co/list_co.php?tb1_colunm1=Central-Office&type=advance">Central Office</a>&nbsp;|</span>
                      <span><a class="submenu" href="../oo/list_oo.php?tb1_colunm1=Office-Order&type=advance">Office Order</a>&nbsp;|</span>
                      <span><a class="submenu" href="../to/list_to.php?tb1_colunm1=Travel-Order&type=advance">Travel Order</a>&nbsp;|</span>
                      <span><a class="submenu" href="/denr/cal" target="_blank">Zoom Scheduling</a>&nbsp;|</span>
                      <span><a class="submenu" href="/denr/eis" target="_blank">Online Attendance</a>&nbsp;|</span>
                      
                <span class="dropdown"><a class="btn-default dropdown-toggle submenu" type="button" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                	<span>More</span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="../voucher/list_vouchers.php?tb1_colunm1=Vouchers&type=advance">Vouchers</a></li>
                      <li><a href="../engp/list_engp.php?tb1_colunm1=engp&type=advance">E-NGP</a></li>
                      <li><a href="../files/list_files.php?tb1_colunm1=Files&type=advance">Records Files</a></li>
                      <li><a href="../employee/select_payment_date.php?tb1_colunm1=employee">Employee Payslip</a></li>
                      <li><a href="http://gssproperty/denreis/system/home.php" target="_blank">Property Management</a></li>
                      <li><a href="https://203.160.181.242:5001/" target="_blank">File Archive</a></li>
                      <li><a href="http://203.160.181.242:81/denr-eservices" target="_blank">Frontline Services</a></li>
                      <li><a href="../../phpmyadmin/sql.php?db=database&table=users_tb" target="_blank">Users</a></li>
                      <li><a href="../../phpmyadmin/server_import.php">Restore Data</a></li>
                      <li><a href="../database/backupdb.php">Backup Data</a></li>
                    </ul>
                </span>
                
                <!--<span><a class="submenu" href="bugreport.php" target="_blank">Bug Reporting System</a></span>
                
                <span><a class="submenu" href="about.php">About</a></span>-->
                                
        </div>
    
    </div>

    <div class="body-content">