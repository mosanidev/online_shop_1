<?php
       
    $banner_id = isset($_GET['banner_id']) ? $_GET['banner_id'] : "";
       
    $banner = "";
    $link = "";
    $gambar = "";
	$keterangan_gambar = "";
    $status = "";
       
    $button = "Add";
       
    if($banner_id != "")
    {
        $button = "Update";
		
        $queryBanner = mysqli_query($koneksi, "SELECT * FROM banner WHERE banner_id='$banner_id'");
        $row=mysqli_fetch_array($queryBanner);
           
		$banner = $row["banner"];
		$link = $row["link"];
		$gambar = "<img src='". BASE_URL."images/slide/$row[gambar]' style='width: 200px;vertical-align: middle;' />";
		$keterangan_gambar = "(klik 'Pilih Gambar' hanya jika tidak ingin mengganti gambar)";
		$status = $row["status"];
    }   
?>

<form action="<?php echo BASE_URL."module/banner/action.php?banner_id=$banner_id"?>" method="post" class="form-tambah-data-tabel" enctype="multipart/form-data">
	
	<div class="element-form">
		<label><b>Banner</b></label>	
		<input type="text" name="banner" value="<?php echo $banner; ?>" />
	</div>	

	<div class="element-form">
		<label><b>Link</b></label>	
		<input type="text" name="link" value="<?php echo $link; ?>" />
	</div>	   

	<div class="element-form">
		<label><b>Gambar Banner</b></label>
		<p class="keterangan-gambar"><?php echo $keterangan_gambar; ?></p>	
		<input type="file" name="file" /><?php echo $gambar; ?>
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