<?php require_once('head.php'); ?>
<div>

<div class="navbar-fixed-top body-title">    
	<h3 class="col-lg-10"><?php echo $clientalias ;?> Information System</h3>
</div>

<div>
<p>Welcome to DENR IS</p>     
     <ul>
        <li><a href="../../phpmyadmin/sql.php?db=database&table=users_tb" target="_blank">Users</a></li>
        <li><a href="../../phpmyadmin/server_import.php">Restore Data</a></li>
        <li><a href="../database/backupdb.php">Backup Data</a></li>
     </ul>
</div>
     
</div>
<?php require_once('footer.php'); ?>       