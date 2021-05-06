<?php

    // cek apakah ada kategori_id
    $kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id'] : false;

    $kategori = "";
    $status = "";
    $button = "Add";

    if ($kategori_id) {

        $queryKategori = mysqli_query($koneksi, "SELECT kategori, status FROM kategori WHERE kategori_id='$kategori_id'");
        $row = mysqli_fetch_assoc($queryKategori);

        $kategori = $row['kategori'];
        $status = $row['status'];
        $button = "Update";

    }

?>

<form action="<?php echo BASE_URL."module/kategori/action.php?kategori_id='$kategori_id'"; ?>" class="form-tambah-data-tabel" method="POST">

    <div class="element-form">
        <label for="kategori"><b>Kategori</b></label>
        <input type="text" placeholder="Masukkan nama kategori" name="kategori" value="<?php echo $kategori ?>" required>
    </div>

    <div class="element-form">
        <label for="status" class="label-status"><b>Status</b></label>
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