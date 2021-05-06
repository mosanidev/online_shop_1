<?php

    // cek apakah ada kategori_id
    $barang_id = isset($_GET['barang_id']) ? $_GET['barang_id'] : false;

    $nama_barang = "";
    $kategori_id = "";
    $spesifikasi = "";
    $gambar = "";
    $stok = "";
    $harga = "";
    $gambar = "";
    $status = "";
    $keterangan_gambar = "";

    $button = "Add";

    if ($barang_id) {

        $query = mysqli_query($koneksi, "SELECT * FROM barang WHERE barang_id=$barang_id");
        $row = mysqli_fetch_assoc($query);

        $nama_barang = $row['nama_barang'];
        $kategori_id = $row['kategori_id'];
        $spesifikasi = $row['spesifikasi'];
        $gambar = $row['gambar'];
        $stok = $row['stok'];
        $harga = $row['harga'];
        $status = $row['status'];

        $keterangan_gambar = "(Klik pilih gambar jika ingin mengganti gambar dibawah ini)";
        $gambar = "<img src='".BASE_URL."images/barang/".$gambar."' style='width: 200px; vertical-align: middle;'/>";

        $button = "Update";

    }

?>

<script src="<?php echo BASE_URL."script/ckeditor/ckeditor.js"; ?>"></script>

<form action="<?php echo BASE_URL."module/barang/action.php?barang_id='$barang_id'"; ?>" class="form-tambah-data-tabel" method="POST" enctype="multipart/form-data">

    <div class="element-form">
        <label for="kategori"><b>Kategori</b></label>

        <select name="kategori_id">
            <?php
                $query = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY kategori ASC");
                while($row=mysqli_fetch_assoc($query)) {
                    if ($kategori_id == $row["kategori_id"])
                    {
                        echo "<option value='$row[kategori_id]' selected='true'>$row[kategori]</option>";

                    } else {
                        echo "<option value='$row[kategori_id]'>$row[kategori]</option>";
                    }
                }
 
            ?>
        </select>

    </div>

    <div class="element-form">
        <label for="nama_barang"><b>Nama barang</b></label>
        <input type="text" placeholder="Masukkan nama barang" name="nama_barang" value="<?php echo $nama_barang; ?>" required>
    </div>

    <div style="margin-bottom: 10px;">
        <label for="spesifikasi"><b>Spesifikasi</b></label>
        <textarea name="spesifikasi" rows="5" placeholder="Masukkan spesifikasi barang" id="editor"><?php echo $spesifikasi; ?></textarea>
    </div>

    <div class="element-form">
        <label for="stok"><b>Stok</b></label>
        <input type="text" placeholder="Masukkan stok" name="stok" value="<?php echo $stok; ?>" required>
    </div>

    <div class="element-form">
        <label for="harga_jual"><b>Harga</b></label>
        <input type="text" placeholder="Masukkan harga" name="harga" value="<?php echo $harga; ?>" required>
    </div>

    <div class="element-form">
        <label for="image"><b>Gambar Produk</b></label>
        <p class="keterangan-gambar"><?php echo $keterangan_gambar; ?></p>
        <input type="file" name="file" accept="image/*" id="file">
        <?php echo $gambar ?>
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

<script>
    CKEDITOR.replace("editor");
</script>