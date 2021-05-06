<?php

    include_once("function/helper.php");
    include_once("function/koneksi.php");

    $level = "customer";
    $status = "on";
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $alamat = $_POST['alamat'];
    $psw = $_POST['psw'];
    $re_psw = $_POST['re_psw'];
    $provinsi = $_POST['provinsi'];
    $kota = $_POST['kota'];
    $kecamatan = $_POST['kecamatan'];

    unset($_POST['psw']);
    unset($_POST['re_psw']);

    // untuk sementara ini di unset dulu
    unset($_POST['provinsi']);
    unset($_POST['kota']);
    unset($_POST['kecamatan']);

    $dataForm = http_build_query($_POST);

    $query_email = mysqli_query($koneksi,"SELECT * FROM user where email='$email'");
    $query_phone = mysqli_query($koneksi,"SELECT * FROM user where phone='$phone'");

    if (empty($nama_lengkap) || empty($email) || empty($phone ) || empty($alamat) || empty($psw)) {
        header("Location: ".BASE_URL."index.php?page=register&notif=require&$dataForm");
    } else if ($psw != $re_psw) {
        header("Location: ".BASE_URL."index.php?page=register&notif=password&$dataForm");
    } else if (mysqli_num_rows($query_email) == 1) {
        header("Location: ".BASE_URL."index.php?page=register&notif=email&$dataForm");
    } else if (mysqli_num_rows($query_phone) == 1) {
        header("Location: ".BASE_URL."index.php?page=register&notif=phone&$dataForm");
    } else if (strpos($email, '@') === false) { //tidak mengandung simbol @
        header("Location: ".BASE_URL."index.php?page=register&notif=emailnotvalid&$dataForm");
    } else {
        $psw = password_hash($psw, PASSWORD_DEFAULT);
        $result = mysqli_query($koneksi, "INSERT INTO user (nama, email, alamat, phone, password, status, level, kota, provinsi, kecamatan)
                                            VALUES('$nama_lengkap','$email','$alamat','$phone','$psw', '$status', '$level', '$kota', '$provinsi', '$kecamatan')");
        
        if ($result === false) {
            $message = 'Invalid query '.mysqli_error($koneksi);
            echo $message;
        } else {
            header("Location: ".BASE_URL."index.php?page=login");
        }

    }
?>