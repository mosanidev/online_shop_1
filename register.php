<div id="myForm_register">
    <form action="<?php echo BASE_URL."proses_register.php" ?>" class="form-register" method="POST">
        
        <?php

            // kembalikan user ke halaman index jika sudah login
            if($user_id) {
                header("Location: ".BASE_URL);
            }

            $notif = isset($_GET['notif']) ? $_GET['notif'] : false;
            $nama_lengkap = isset($_GET['nama_lengkap']) ? $_GET['nama_lengkap'] : false;
            $email = isset($_GET['email']) ? $_GET['email'] : false;
            $alamat = isset($_GET['alamat']) ? $_GET['alamat'] : false;
            $phone = isset($_GET['phone']) ? $_GET['phone'] : false;

            if ($notif == 'require') {
                echo "<p class='notif'> Maaf anda harus mengisi form secara lengkap terlebih dahulu </p>";
            } else if ($notif == 'password') {
                echo "<p class='notif'> Maaf password yang anda masukkan ulang salah </p>";
            } else if ($notif == 'email') {
                echo "<p class='notif'> Maaf email yang anda masukkan sudah terdaftar </p>";
            } else if ($notif == 'emailnotvalid') {
                echo "<p class='notif'> Maaf email yang anda masukkan tidak valid </p>";
            } else if ($notif == 'phone') {
                echo "<p class='notif'> Maaf nomor telepon yang anda masukkan sudah terdaftar </p>";
            }

            // ambil file JSON 
            $jsonProvinsi = file_get_contents("function/data_json/provinsi.json");
            $jsonKota = file_get_contents("function/data_json/kota.json");
            $jsonKecamatan = file_get_contents("function/data_json/kecamatan.json");

            // merubah json ke array php
            $arrProvinsi = json_decode($jsonProvinsi, true);

            $arrKota = json_decode($jsonKota, true);
        ?>

        <h1>Register</h1>
        <br>

        <?php

            // looping untuk memasukkan isi provinsi saja ke array baru 
            for($i=0;$i<count($arrProvinsi);$i++) {
                $anArray[] = $arrProvinsi[$i]['province'];
            }

            // menghilangkan isi array yang sama sehingga isinya unik
            $provinsi = array_unique($anArray);

            // mengurutkan isi array secara alfabet a-z
            $provinsi[] = sort($provinsi);

        
        ?>
        <div class="element-form">
            <label for="nama_lengkap"><b>Nama Lengkap</b></label>
            <input type="text" placeholder="Masukkan Nama Lengkap" name="nama_lengkap" value="<?php echo $nama_lengkap ?>" required> <br>
        </div>

        <div class="element-form">
            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Masukkan Email" name="email" value="<?php echo $email ?>" required> <br>
        </div>

        <div class="element-form">
            <label for="phone"><b>No Handphone</b></label>
            <input type="tel" placeholder="Masukkan No Handphone" name="phone" pattern="[0-9]{12}" value="<?php echo $phone ?>" required> <br>
        </div>

        <div class="element-form">
            <label for="PROVINSI"><b>Provinsi</b></label>
            <select name="provinsi" id="provinsi" onchange="generate_city()" required>
                <option value="" disabled selected>Pilih Provinsi</option>
                <?php 
                    // looping untuk memasukkan semua isi array ke opsi di tag select 
                    for ($i=0; $i<count($provinsi)-1 ;$i++) {
                        echo "<option id='optProvinsi' value='$provinsi[$i]'>$provinsi[$i]</option>";
                    }

                ?>
            </select>
        </div>

        <div class="element-form">
            <label for="kota"><b>Kota</b></label>
            <select name="kota" id="kota" onchange="generate_district()" required> 
                <option value="" disabled selected>Pilih Kota</option>
            </select>
        </div>

        <div class="element-form">
            <label for="kecamatan"><b>Kecamatan</b></label>
            <select name="kecamatan" id="kecamatan" required>
                <option value="" disabled selected>Pilih Kecamatan</option>
            </select>
        </div>

        <div class="element-form">
            <label for="alamat"><b>Alamat</b></label> <br>
            <textarea class="text_alamat" rows="4" name="alamat" placeholder="Masukkan Alamat Lengkap" required><?php echo $alamat ?></textarea> <br>
        </div>
             
        <div class="element-form">
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Masukkan Password" name="psw" minlength="8" required> <br>
        </div>

        <div class="element-form">
            <label for="re_psw"><b>Retype Password</b></label>
            <input type="password" placeholder="Konfirmasi Password" name="re_psw" minlength="8" required> <br>
        </div>
             
        <div class="element-form">
            <button type="submit" class="btn">Register</button>
        </div>
    </form>
</div>
