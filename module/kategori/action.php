<?php

    include_once("../../function/helper.php");
    include_once("../../function/koneksi.php");

    $kategori = $_POST['kategori'];
    $status = $_POST['status'];
    $button = $_POST['button'];

    if ($button == "Add") {
        $query = mysqli_query($koneksi, "INSERT INTO kategori (kategori, status) VALUES ('$kategori','$status')");
    } else if ($button == "Update") {
        $kategori_id = $_GET['kategori_id'];
        $query = mysqli_query($koneksi, "UPDATE kategori SET kategori='$kategori', status='$status' WHERE kategori_id=$kategori_id ");
    }

    header("Location: ".BASE_URL."index.php?page=my_profile&module=kategori&action=list");
    
?>