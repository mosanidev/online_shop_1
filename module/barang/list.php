<div id="form-tambah">

    <a href="<?php echo BASE_URL."index.php?page=my_profile&module=barang&action=form"; ?>" class="tombol-action">Tambah Barang</a>

</div>

<?php

    $queryBarang = mysqli_query($koneksi, "SELECT b.*, k.kategori FROM barang b INNER JOIN kategori k ON b.kategori_id=k.kategori_id ORDER BY b.nama_barang ASC");

    if (mysqli_num_rows($queryBarang) == 0) {

        echo "Saat ini belum ada data barang di dalam tabel barang";

    } else {

        echo "<table class='table-list'>
                <tbody>
                    <tr class='baris-title'>
                        <th class='kolom-nomor'>No</th>
                        <th class='kiri'>Barang</th>
                        <th class='kiri'>Kategori</th>
                        <th class='tengah'>Harga</th>
                        <th class='tengah'>Status</th>
                        <th class='tengah'>Action</th>
                    </tr>";
               
        
        $no=1;
        while($row=mysqli_fetch_assoc($queryBarang)) {

            echo "<tr>
                    <td class='kolom-nomor'>$no</td>
                    <td class='kiri'>$row[nama_barang]</td>
                    <td class='kiri'>$row[kategori]</td>
                    <td class='tengah'>".rupiah($row["harga"])."</td>
                    <td class='tengah'>$row[status]</td>
                    <td class='tengah'>
                        <a class='tombol-action' href='".BASE_URL."index.php?page=my_profile&module=barang&action=form&barang_id=$row[barang_id]'>Edit</a>
                    </td>
                 </tr>";

            $no++;
        }
        
        echo "</tbody>
              </table>";

    }

?>