<?php

    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $email = $_POST['email'];
    $psw = $_POST['psw'];

    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$email' AND status='on'");
    
    if (mysqli_num_rows($query) == 0) {

        // kembali ke halaman login jika sql tidak menemukan email yang diinputkan user 
        header("Location: ".BASE_URL."index.php?page=login&notif=email");
        
    } else {
        
        $row = mysqli_fetch_assoc($query);

        // cek input password user dengan password yang ada di DB (yang sudah dienkripsi) jika cocok return 1
        $checkPsw = password_verify($psw, $row['password']);
        
        if ($checkPsw == 1) {
            
            session_start();

            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['level'] = $row['level'];
    
            header("Location: ".BASE_URL."index.php?page=my_profile&module=pesanan&action=list");

        } else {

            // kembali ke halaman login jika password yang dimasukkan tidak cocok dengan yang ada di DB
            header("Location: ".BASE_URL."index.php?page=login&notif=password");
        }

    }

?>