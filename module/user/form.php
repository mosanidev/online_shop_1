<?php
      
    $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : "";
      
	$button = "Update";
	$queryUser = mysqli_query($koneksi, "SELECT * FROM user WHERE user_id='$user_id'");
	 
	$row=mysqli_fetch_array($queryUser);
	  
	$nama = $row["nama"];
	$email = $row["email"];
	$phone = $row["phone"];
	$alamat = $row["alamat"];
	$status = $row["status"];
	$level = $row["level"];
?>
<form action="<?php echo BASE_URL."module/user/action.php?user_id=$user_id"?>" class="form-tambah-data-tabel" method="POST">
	  
	<div class="element-form">
		<label><b>Nama Lengkap</b></label>	
		<input type="text" name="nama" value="<?php echo $nama; ?>" />
	</div>	

	<div class="element-form">
		<label><b>Email</b></label>	
		<input type="text" name="email" value="<?php echo $email; ?>" />
	</div>		

	<div class="element-form">
		<label><b>Phone</b></label>	
		<input type="text" name="phone" value="<?php echo $phone; ?>" />
	</div>	

	<div class="element-form">
		<label><b>Alamat</b></label>	
		<input type="text" name="alamat" value="<?php echo $alamat; ?>" />
	</div>		

	<div class="element-form-level">
		<label><b>Level</b></label>	
		<div class="container-level">
            <div class="level">
                <input type="radio" name="level" value="on" <?php if ($level == 'superadmin' ) { echo "checked"; } ?> checked /> Superadmin
            </div>
            <input type="radio" name="level" value="off" <?php if ($level == 'customer' ) { echo "checked"; } ?>/> Customer
        </div>
	</div>	

	<div class="element-form">
		<label><b>Status</b></label>	
		<div class="container-status">
            <div class="status">
                <input type="radio" name="status" value="on" <?php if ($status == 'on' ) { echo "checked"; } ?> checked /> On
            </div>
            <input type="radio" name="status" value="off" <?php if ($status == 'off' ) { echo "checked"; } ?>/> Off
        </div>
	</div>		
	  
	<div class="element-form">
		<input type="submit" name="button" class="btn" value="<?php echo $button;?>"/>
	</div>	
</form>