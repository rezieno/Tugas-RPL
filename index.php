<?php  
error_reporting(0);
session_start();
include_once 'include/class.php';

// instance objek db dan user
$user = new User();
$db = new Database();

// koneksi ke MySQL via method
$db->connectMySQL();

// cek apakah user login atau tidak via method
if($user->get_sesi()) {
  header("location:admin.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $login=$user->cek_login($_POST['username'], $_POST['passwd']);
  if($login) {
    // login sukses, arahkan ke file admin.php
    header("location:admin.php");
  }
  else {
  // login gagal, beri peringatan dan kembali ke file index.php
  ?>
  <script language="javascript">
		alert("Maaf, User Atau Password Anda salah!!");
		document.location="index.php";
	</script>
  <?php  
  }
}
?>

<html>
<head>
<title>Login</title>
<link href="css/login-box.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div style="padding: 70px 0 0 50px;">
<div class="container">
<div id="login-box">
<div class="header">
<H3>  Welcome to KK Cosmetic</H3>
<br></br>
<div class="sep"></div>
<form method="post" name="login" >
<div class="inputs">
<div id="login-box-name"></div> 
<div id="login-box-field" >
<input name="username" type="normal" title="username" placeholder="Username" value="" /></div>

<div id="login-box-name"></div>
<div id="login-box-field"><input name="passwd" type="password" class="form-login" title="Password" placeholder="Password"value="" /></div><br />

<input type="image" src="images/login-btn1.png" width="180" height="42" style="margin-left:90px";>
</form>
</div>
</div>
</div>
</body>
</html>
