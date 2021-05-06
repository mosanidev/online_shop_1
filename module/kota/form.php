<?php

	$kota_id = isset($_GET['kota_id']) ? $_GET['kota_id'] : false;
	
	$kota = "";
	$tarif = "";
	$status = "";
	$button = "Add";

	if($kota_id){
		$queryKota = mysqli_query($koneksi, "SELECT * FROM kota WHERE kota_id='$kota_id'");
		$row=mysqli_fetch_assoc($queryKota);
		
		$kota = $row['kota'];
		$tarif = $row['tarif'];
		$status = $row['status'];
		
		$button = "Update";
	}
		
?>		
<form action="<?php echo BASE_URL."module/kota/action.php?kota_id=$kota_id"?>" class="form-tambah-data-tabel" method="post">

	<div class="element-form">
		<label><b>Kota</b></label>	
		<input type="text" placeholder="Masukkan nama kota" name="kota" value="<?php echo $kota; ?>" />
	</div>		

	<div class="element-form">
		<label><b>Tarif</b></label>	
		<input type="text" placeholder="Masukkan tarif" name="tarif" value="<?php echo $tarif; ?>" /></span>
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