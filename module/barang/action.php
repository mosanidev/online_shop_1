<?php 

    include_once("../../function/helper.php");
    include_once("../../function/koneksi.php");

    extract($_POST);
    $update_gambar = "";

    if (!empty($_FILES["file"]["name"]))
    {
        $nama_file = $_FILES["file"]["name"];
        move_uploaded_file($_FILES["file"]["tmp_name"], "../../images/barang/".$nama_file);

        $update_gambar = ", gambar='$nama_file'";
    }

    if ($button == "Add") {

        $query = mysqli_query($koneksi, "INSERT INTO barang (kategori_id, nama_barang, gambar, harga, stok, status, spesifikasi) VALUES('$kategori_id', '$nama_barang', '$nama_file', '$harga', '$stok', '$status', '$spesifikasi')");

    } 
    else if ($button == "Update") {

        $barang_id = $_GET['barang_id'];

        $query = mysqli_query($koneksi, "UPDATE barang set kategori_id=$kategori_id, nama_barang='$nama_barang', harga='$harga', status='$status', spesifikasi='$spesifikasi', stok='$stok' $update_gambar WHERE barang_id=$barang_id");

    }

    header("Location: ".BASE_URL."index.php?page=my_profile&module=barang&action=list");


?>