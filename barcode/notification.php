<?php require_once('../Connections/connection.php'); ?>
<?php require_once('config.php'); ?>
<?php require_once('access_global.php'); ?>
<?php date_default_timezone_set('Asia/Manila'); ?>
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
$query_rsusers = "SELECT * FROM users_tb WHERE username = '".$_SESSION['MM_Username']."'";
$rsusers = mysql_query($query_rsusers, $connection) or die(mysql_error());
$row_rsusers = mysql_fetch_assoc($rsusers);
$totalRows_rsusers = mysql_num_rows($rsusers);

mysql_select_db($database_connection, $connection);
$query_rsnotice = "SELECT * FROM table2 WHERE (tb2_colunm6 = '".$row_rsusers['division']."' OR tb2_colunm15 = '".$row_rsusers['username']."') AND tb2_colunm24 = 'ONGOING'";
$rsnotice = mysql_query($query_rsnotice, $connection) or die(mysql_error());
$row_rsnotice = mysql_fetch_assoc($rsnotice);
$totalRows_rsnotice = mysql_num_rows($rsnotice);
?>
<?php if ($totalRows_rsnotice != "0") { ?>
<a href="/denr/chat/chat.php?other_division=<?php echo $row_rsnotice['tb2_colunm3']; ?>&other_username=<?php echo $row_rsnotice['tb2_colunm11']; ?>&my_username=<?php echo $row_rsusers['username']; ?>&my_division=<?php echo $row_rsusers['division']; ?>&status=ONGOING" target="_blank" title="View your notifications!">
<img src="../assets/alert.gif" width="20px" />
<span class="badge"><?php //echo $totalRows_rsnotice ?></span>
</a>
<?php } else { ?>
<a href="/denr/chat/chat/chat.php?my_username=<?php echo $row_rsusers['username']; ?>&my_division=<?php echo $row_rsusers['division']; ?>" target="_blank" title="See chats">
<img src="../assets/black.png" width="20px" />
</a>
<?php } ?>