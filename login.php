<?php

        $notif = isset($_GET['notif']) ? $_GET['notif'] : false;

        if ($notif == 'email') {
            echo "<p class='notif'> Email yang anda masukkan tidak terdaftar </p>";
        } else if ($notif == 'password') {
            echo "<p class='notif'> Password yang anda masukkan salah </p>";
        }

        // kembalikan user ke halaman index jika sudah login
        if($user_id) {
            header("Location: ".BASE_URL);
        }

?>

<div>
    <form action="<?php echo BASE_URL.'proses_login.php' ?>" method="POST" class="form-container">
    
    <h1>Login</h1>
    <br>
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Masukkan Email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Masukkan Password" name="psw" required>

    <button type="submit" class="btn">Login</button>
    </form>
</div>  