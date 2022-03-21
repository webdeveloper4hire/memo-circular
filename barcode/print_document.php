<?php require_once('../Connections/connection.php'); ?>
<?php require_once('config.php'); ?>
<?php require_once('access_dats.php'); ?>
<?php date_default_timezone_set("Asia/Hong_Kong"); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_connection, $connection);
$query_rstable1 = "SELECT * FROM table1 WHERE table1_id = '".$_GET['table1_id']."'";
$rstable1 = mysql_query($query_rstable1, $connection) or die(mysql_error());
$row_rstable1 = mysql_fetch_assoc($rstable1);
$totalRows_rstable1 = mysql_num_rows($rstable1);

mysql_select_db($database_connection, $connection);
$query_rstable2 = "SELECT * FROM table2 WHERE tb2_colunm1 = 'Document-Action' AND tb2_colunm2 = '".$_GET['table1_id']."' ORDER BY table2_id ASC";
$rstable2 = mysql_query($query_rstable2, $connection) or die(mysql_error());
$row_rstable2 = mysql_fetch_assoc($rstable2);
$totalRows_rstable2 = mysql_num_rows($rstable2);

mysql_select_db($database_connection, $connection);
$query_rstable2arc = "SELECT * FROM table2 WHERE tb2_colunm1 = 'Document-Archive' AND tb2_colunm2 = '".$_GET['arcno']."'";
$rstable2arc = mysql_query($query_rstable2arc, $connection) or die(mysql_error());
$row_rstable2arc = mysql_fetch_assoc($rstable2arc);
$totalRows_rstable2arc = mysql_num_rows($rstable2arc);
?>
<?php
//Last Record
$lastrecord = $totalRows_rstable2;
 ?>

<?php 
// Elapse time
$time =strtotime ($row_rstable1['tb1_colunm5']);

function humanTiming ($time)
{
    $time = time() - $time; // to get the time since that moment
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );
    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta name="author" content="<?php echo $clientalias ;?>" />
<meta name="copyright" content="<?php echo $clientalias ;?>; 2010" />
<meta name="description" content="<?php echo $clientfullname;?>" />
<meta name="keywords" content="DENR,Environment,Nature,Government,MIMAROPA,Laguna,Calamba,Plants,Philippines,Seeds,Trees,Natural,Farm" />
<title>Routing Slip - <?php echo $clientalias ;?></title>
<script src="../plugins/qrlogo/dist/easy.qrcode.min.js" type="text/javascript" charset="utf-8"></script>

<style type="text/css">
table{counter-reset:section;}
.count:before
{
counter-increment:section;
content:counter(section);
} 

table.jermar th, table.jermar td {
  
  font-size : 12px;
  font-family: 'Arial'; 
        } 
</style>



</head>

<body>
<div align="center">
  <table width="600px" border="0" cellpadding="5" cellspacing="0" class="jermar">
  <tr>
    <td colspan="4">
    
    <table height="50" border="0" cellspacing="1" class="jermar">
      <tr valign="middle">
        <td width="150" align="center">
        <!--<div title="qrlogo" id="container"></div>-->
        <img src="../images/logogrey.jpg" width="50px" /></td>
        <td align="center" >
        <?php echo $clientslogan;?><br/>
        <font color="#009933"><b><?php echo $clientfullname;?></b></font><br/>
        <b><?php echo $clientbranch;?></b><br/><br/>
        <b>Document Routing Slip</b>
        </td>
      </tr>
      </table>
      
      </td>
    </tr>
  <tr <?php
if ($row_rstable2['tb2_colunm10'] == "IN/Yellow Lane") {
    echo "bgcolor=#FFFF00";
}
elseif ($row_rstable2['tb2_colunm10'] == "OUT/Yellow Lane") {
    echo "bgcolor=#FFFF00";
}
elseif ($row_rstable2['tb2_colunm10'] == "IN/URGENT") {
	echo "bgcolor=#FF0000";
}
elseif ($row_rstable2['tb2_colunm10'] == "OUT/URGENT") {
	echo "bgcolor=#FF0000";
}
elseif ($row_rstable2['tb2_colunm10'] == "IN/DUE") {
    echo "bgcolor=#0000FF";
}
elseif ($row_rstable2['tb2_colunm10'] == "OUT/DUE") {
    echo "bgcolor=#0000FF";
}
else {
    echo "";
} ?> >
    </tr>
  <tr>
    <td width="115"><div align="left"><b>Document Number:</b></div></td>
    <td width="150"><div align="left">
<b><?php if ($row_rstable1['tb1_colunm2'] != "0") {  ?><?php echo $row_rstable1['tb1_colunm2']; ?>-<?php } ?><?php echo $row_rstable1['tb1_colunm3']; ?>-<?php if ($row_rstable1['tb1_colunm3'] <= "2017") {
  echo $row_rstable1['tb1_colunm17'];
} else {
  echo $row_rstable1['table1_id'];
}
?></b></div></td>
    <td align="right"><div align="left"><b>Date Endocded:</b>
<?php if ($row_rstable1['tb1_colunm21'] == NULL) {
  echo date("d-M-Y", strtotime($row_rstable1['tb1_colunm5']));
}
else {
  echo date("d-M-Y", strtotime($row_rstable1['tb1_colunm21']));
} ?>
<br />
<?php //echo humanTiming($time);?>
<?php //echo date("h:i A");?>
    </div>
</td>
    </tr>
  <tr>
    <td><div align="left"><b>Sender:</b></div></td>
    <td colspan="2"><div align="left">
	<?php if ($row_rstable1['tb1_colunm6'] == NULL) {
		echo $row_rstable1['tb1_colunm18'];
	} else {
		echo $row_rstable1['tb1_colunm6'];
	}
	?></div></td>
  </tr>
    <tr>
    <td><div align="left"><b>Address:</b></div></td>
    <td colspan="2"><div align="left"><?php echo $row_rstable1['tb1_colunm18']; ?></div></td>
    </tr>
  <tr valign="top">
    <td><div align="left"><b>Subject:</b></div></td>
    <td colspan="2"><div align="left"><?php echo nl2br($row_rstable1['tb1_colunm7']); ?></div></td>
    </tr>
  <tr>
    <td><div align="left"><b>Addressee:</b></div></td>
    <td colspan="2"><div align="left"><?php echo $row_rstable1['tb1_colunm8']; ?></div></td>
    </tr>
  <tr>
    <td><div align="left"><b>Attachment(s):<b></div></td>
    <td colspan="2"><div align="left"><?php echo $row_rstable1['tb1_colunm9']; ?>; <?php echo nl2br($row_rstable1['tb1_colunm10']); ?></div></td>
    </tr>
    <tr>
    <td><div align="left"><b>Urgent:</b></div></td>
    <td colspan="2"><div><?php echo $row_rstable1['tb1_colunm12']; ?>; <span style="align-content: right">
    received by <?php //echo $row_rstable1['tb1_colunm17']; ?>
    
<?php if ($row_rstable1['tb1_colunm14']== NULL) {
  echo $row_rstable1['tb1_colunm11'];
}
else {
  echo $row_rstable1['tb1_colunm14'];
} ?>
</span>
</div>
</td>
    </tr>
    <tr>
    <td><div align="left"><b>Date Received:</b></div></td>
    <td><div align="left"><?php if ($row_rstable1['tb1_colunm5'] == NULL) { 
		echo "N/A";
	}
  	else {
   		echo $newDate = date("d-M-Y", strtotime($row_rstable1['tb1_colunm5']));
	}
	?>
	
    <!--Elapsed Time --></div></td>
    <td align="right">
    <a href="add_document-action.php?table1_id=<?php echo $row_rstable1['table1_id']; ?>&amp;tb2_colunm1=Document-Action"><img src="../images/b_plus.png" title="ADD NEW ACTION" alt="ADD NEW ACTION" /></a>
&nbsp;&nbsp;

<a <?php
if ($row_rstable1['tb1_colunm11'] == $_SESSION['MM_Username']) { ?>  
href="edit_document.php?table1_id=<?php echo $row_rstable1['table1_id']; ?>"
<?php } else {}?>
 target="_blank"><img src="../images/b_edit.png" title="UPDATE" alt="UP" /></a>
&nbsp;&nbsp;

<a href="upload_form.php?table1_id=<?php echo $row_rstable1['table1_id']; ?>&tb1_colunm1=Document-Action"><img src="../images/drive_upload.png" title="UPLOAD" alt="UP" /></a>
&nbsp;&nbsp;

<a href="javascript:window.print()"><img src="../images/b_print.png" title="PRINT" alt="PR" /></a>
&nbsp;&nbsp;

<a href="add_document-action.php?table1_id=<?php echo $row_rstable1['table1_id']; ?>&tb2_colunm1=Document-Action&barcoding=yes"><img src="../images/b_sbrowse.png" title="ADD NEW BARCODE" alt="ADD NEW BARCODE" /></a>
&nbsp;&nbsp;

<!--<a href="print_barcode.php?table1_id=DENR4B-<?php echo date('y'); ?>-<?php echo $row_rstable1['table1_id']; ?>" target="_blank"><img src="../images/b_sbrowse.png" title="PRINT Barcode" alt="PR" /></a>
&nbsp;&nbsp;-->

<a href="javascript:history.back(-1)"><img src="../images/bd_prevpage.png" title="BACK" alt="BA" /></a>
&nbsp;&nbsp;

<a href="home.php"><img src="../images/b_home.png" title="HOME" alt="HOME" /></a>
    </td>
    </tr>
</table>
<table width="600px" border="1" cellspacing="0" cellpadding="5" class="jermar">
  <tr>
    <th colspan="5" align="center">ROUTING AND ACTION INFORMATION</th>
  </tr>
  <tr>
    <th>FROM<?php $i=1; ?></th>
    <th>DATE RECEIVED</th>
    <th>FOR/TO</th>
    <th>DATE RELEASED</th>
    <th width="300px">ACCEPTANCE REMARKS/ACTION REQUIRED/TAKEN REMARKS/STATUS</th>
  </tr>
  <?php if ($row_rstable1['tb1_colunm16'] == 'RECORDS' OR $row_rstable1['tb1_colunm16'] == 'RICTU') { ?>
  <tr valign="top">
    <td><div class="style16"><?php echo $row_rstable1['tb1_colunm16']; ?></div></td>
    <td><?php echo $row_rstable1['tb1_colunm5']; ?></td>
    <td><div class="style16"><?php if ($row_rstable1['tb1_colunm23'] == NULL) {
  echo $row_rstable1['tb1_colunm8'];
} else {
  echo $row_rstable1['tb1_colunm23'];
}
?></div></td>
    <td><?php echo $row_rstable1['tb1_colunm21']; ?></td>
    <td><div class="style16">
Date: <?php echo $row_rstable1['tb1_colunm21']; ?><br/>
Status: OUT<br/>
From:  <?php echo $row_rstable1['tb1_colunm11']; ?><br/>
Message: <?php echo $row_rstable1['tb1_colunm9']; ?> forwarded for your information and appropriate action</div></td>
  </tr>
  <?php } else { ?>
  <?php } ?>
  <?php if ($row_rstable1['tb1_colunm3'] <= "2017") { ?>
  <?php do { ?>
  <tr valign="top">
    <td><div align="left" class="style16"><?php echo $row_rstable2arc['tb2_colunm3']; ?></div></td>
    <td><?php echo $row_rstable2arc['tb2_colunm4']; ?></td>
    <td><div align="left" class="style16">
        <?php echo $row_rstable2arc['tb2_colunm6']; ?> <?php echo $row_rstable2arc['tb2_colunm15']; ?> <?php echo $row_rstable2arc['tb2_colunm16']; ?> <?php echo $row_rstable2arc['tb2_colunm17']; ?> / <?php echo $row_rstable2arc['tb2_colunm8']; ?></div></td>
    <td><?php echo $row_rstable2arc['tb2_colunm7']; ?></td>
    <td><div align="left" class="style16">
Date: <?php echo $row_rstable2arc['tb2_colunm13']; ?><br />
Status: <?php echo $row_rstable2arc['tb2_colunm10'] ?><br />
From:  <?php echo $row_rstable2arc['tb2_colunm11']; ?><br />
Message:<?php echo nl2br($row_rstable2arc['tb2_colunm9']); ?><br />
<?php echo $row_rstable2arc['tb2_colunm14']; ?>
</div></td>
  </tr>
    <?php } while ($row_rstable2arc = mysql_fetch_assoc($rstable2arc)); ?>
<?php } else { ?>
<?php } ?>
  <?php do { ?>
  <tr valign="top">
  <?php if ($totalRows_rstable2 > 0) { // Show if recordset not empty ?>
    <td><div align="left" class="style16"><?php echo $row_rstable2['tb2_colunm3']; ?></div></td>
    <td><?php echo $row_rstable2['tb2_colunm4']; ?> <?php echo $row_rstable2['tb2_colunm5']; ?></td>
    <td><div align="left" class="style16">
          <?php echo $row_rstable2['tb2_colunm6']; ?> <?php echo $row_rstable2['tb2_colunm15']; ?> <?php echo $row_rstable2['tb2_colunm16']; ?> <?php echo $row_rstable2['tb2_colunm17']; ?> <?php echo $row_rstable2['tb2_colunm8']; ?></div></td>
    <td><?php echo $row_rstable2['tb2_colunm7']; ?></td>
    <td><div align="left" class="style16">
Date: <?php echo $row_rstable2['tb2_colunm13']; ?><br/>
Status: <?php echo $row_rstable2['tb2_colunm10'] ?><br/>
From: <?php echo $row_rstable2['tb2_colunm11']; ?><br/>
Message: <?php echo nl2br($row_rstable2['tb2_colunm9']); ?> 
<?php echo $row_rstable2['tb2_colunm20']; ?> 
<?php echo $row_rstable2['tb2_colunm14']; ?>
</div></td>
<?php } // Show if recordset not empty ?>
  </tr>
  <!-- if Outgoing to CO -->
<?php if ($row_rstable2['tb2_colunm6'] == 'Records Section' && $row_rstable2['tb2_colunm10'] == 'OUTGOING') { ?>
  <tr valign="top">
    <td><?php echo $row_rstable2['tb2_colunm6']; ?></td>
    <td><?php echo $row_rstable1['tb1_colunm5']; ?></td>
    <td>Central Office</td>
    <td><?php echo $row_rstable1['tb1_colunm21']; ?></td>
    <td>
Date: <?php echo $row_rstable1['tb1_colunm21']; ?><br/>
Status: <?php echo $row_rstable2['tb2_colunm10']; ?><br/>
From: <?php echo $row_rstable2['tb2_colunm6']; ?><br/>
Message: Sent to CO with Attachments</td>
  </tr>
<?php } ?>
  <?php } while ($row_rstable2 = mysql_fetch_assoc($rstable2)); ?>
  <tr>
    <td height="450"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
</div>
</body>
<script type="text/template" id="qrcodeTpl">
			<div class="imgblock">
				<div class="title">{title}</div>
				<div class="qr" id="qrcode_{i}"></div>
			</div>
		</script>
		<script type="text/javascript">
			var demoParams = [
				
				{
					title: "",
					config: {
						text: "http://203.160.181.242:84/r/doc.php?no=<?php echo $row_rstable1['table1_id'];?>",
				
						width: 90,
						height: 90,
						colorDark: "#000000",
				
						PI: '#f55066',
				
						correctLevel: QRCode.CorrectLevel.H, // L, M, Q, H
				
						backgroundImage: '../images/logo3.jpg',
						autoColor: true,
						
						
						dotScale: 0.5
					}

				}

			]

			var qrcodeTpl = document.getElementById("qrcodeTpl").innerHTML;
			var container = document.getElementById('container');

			for (var i = 0; i < demoParams.length; i++) {
				var qrcodeHTML = qrcodeTpl.replace(/\{title\}/, demoParams[i].title).replace(/{i}/, i);
				container.innerHTML+=qrcodeHTML;
			}
			for (var i = 0; i < demoParams.length; i++) {
				 var t=new QRCode(document.getElementById("qrcode_"+i), demoParams[i].config);
			}
		</script>
</html>
<?php
mysql_free_result($rstable1);

mysql_free_result($rstable2);
?>