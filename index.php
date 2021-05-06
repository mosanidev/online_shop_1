<?php

    session_start();

    // menambahkan file php dengan include_once, agar dapat memanggil variabel di dalamnya
    include_once("function/helper.php");

    include_once("function/koneksi.php");

    // mengecek apakah page ada di url bar atau tidak menggunakan fungsi ternary
    $page = isset($_GET['page']) ? $_GET['page'] : false;
    $kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id'] : false;

    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
    $level = isset($_SESSION['level']) ? $_SESSION['level'] : false;
    $nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : false;
    $keranjang = isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : false;
    $totalBarang = count($keranjang);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/banner.css">
    <title> | | Online Shop | | </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="<?php echo BASE_URL."script/slidesjs/source/jquery.slides.min.js"; ?>"></script>

    <script>
      $(function() {
        $('#slides').slidesjs({
          height: 350,
          play: { auto : true,
                  interval: 3000
                },
          navigation: false
        });
      });
    </script>
</head>
<body>
    <header>
        <div id="menu-container">
            <a href="<?php echo BASE_URL."index.php" ?>"><img src="<?php echo BASE_URL."images/logo.png"; ?>"></a>
            <div id="menu-cart">
              <a href='<?php echo BASE_URL."index.php?page=keranjang"; ?>' class='cart'>Cart <?php if ($totalBarang != 0) { echo "<span class='total-barang'><p> + $totalBarang</p></span>"; } ?></a>
            </div>
            <?php 
                
                if ($user_id) {
                    echo "<div id='menu-after-login'>
                          Hi <b>$nama</b>
                            <a href='".BASE_URL."index.php?page=my_profile&module=pesanan&action=list'>My Profile</a>
                            <a href='".BASE_URL."logout.php'>Logout</a>
                          </div>";
                } else {
                    echo "<div id='menu'>
                            <a href='".BASE_URL."index.php?page=login'>Login</a>
                            <a href='".BASE_URL."index.php?page=register'>Register</a>
                          </div>";
                }
            ?>
        </div> 
    </header>
    <main>
        <div id="content">
            
            <?php

                // buat variable nama file
                $filename = "$page.php";
                
                // cek apakah file ada di path folder projek
                if (file_exists($filename)) {
                  include_once($filename);
                } else {
                  include_once("main.php");
                }

            ?>

        </div>
    </main>
    <footer>
        <p>copyright 2020</p>
    </footer>
    <script src="script/script.js"></script>
    <script>
        var kota;

        $.post('get_json.php', { url: 'function/data_json/kota.json' }, function(data) {
            kota = data;        
        });

        var select_province = document.getElementById("provinsi");

        function generate_city() {
            var select_city = document.getElementById("kota");
            var select_district = document.getElementById("kecamatan");
            var opt = document.createElement('option');
            
            var str = "";
            str += "<option value='' disabled selected>Pilih Kota</option>";
            var objKota = JSON.parse(kota);

            for (var i=0; i<objKota.length; i++) {
             if (select_province.value == objKota[i].province) {
                var city = objKota[i].type + " " + objKota[i].city_name;
                str += "<option value='" + city  + "'>" + city + "</option>";
                select_city.innerHTML = str;
                
              }
            } 

            var strKec = "<option value='' disabled selected>Pilih Kecamatan</option>";
            select_district.innerHTML = strKec;
           
        } 

        var kecamatan;

        $.post('get_json.php', { url: 'function/data_json/kecamatan.json' }, function(data) {
            kecamatan = data;        
        });

        function generate_district() {
            var select_city = document.getElementById("kota");
            var select_district = document.getElementById("kecamatan");

            var str = "";
            str += "<option value='' disabled selected>Pilih Kecamatan</option>";
            var objKecamatan = JSON.parse(kecamatan);

            for (var i=0; i<objKecamatan.length; i++) {
              if (select_city.value == objKecamatan[i].type+ " " + objKecamatan[i].city) {
                var district = objKecamatan[i].subdistrict_name;
                str += "<option value='" + district + "'>" + district + "</option>";
                select_district.innerHTML = str;
              }
            }
        }

        $(".update-quantity").on("input", function(e){

          var barang_id = $(this).attr("name");
          var value = $(this).val();

          $.ajax({
              method: "POST",
              url: "update_keranjang.php",
              data: "barang_id="+barang_id+"&value="+value
          })
          .done(function(data){
              var json = $.parseJSON(data);
              if(json.status == true){
                  location.reload();
              }else{
                  alert(json.pesan);
                  location.reload();
              }
          });
        });
        
        // jika url mengandung nilai provinsi di dalamnya 
        // method bawaan includes tidak dapat dijalankan di internet explorer
        // if (document.URL.includes("provinsi=")){
        //     document.getElementById('provinsi').selectedIndex = 1;
        //     for (var i =0; i < select_province.options.length; i++) {
        //       if ()
        //     }
        // }


        // NANTI kapan kapan dibenerin aja deh
        // Tugas belum selesai : cari index keberapa value yang ada di url, lalu ubah nilai option berdasarkan index yang sudah ketemu

   
    </script>
</body>
</html>