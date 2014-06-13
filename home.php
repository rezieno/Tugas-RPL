<?php 
include_once 'include/class.php';
$user = new User();
if (!$user->get_sesi())
{
header("location:index.php");
}
 ?>
<div class="subtitle" align="left">
	<p> Welcome to <br>
	<br />
	<b>Inventory Administration Page </b>  
	<br /><br />
	
	</p></div><br>

