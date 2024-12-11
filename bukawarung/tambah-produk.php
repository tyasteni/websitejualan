<?php 
    include ('inckoneksi.php');

    session_start();
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }

   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <link rel= "stylesheet" type="text/css" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <title>Buka Warung</title>
</head>
<body>
    <!--header-->
    <header>
        <div class = "container">
        <h1><a href= "dashboard.php">Buka Warung</a></h1>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="data-kategori.php">Data Kategori</a></li>
            <li><a href="data-produk.php">Data Produk</a></li>
            <li><a href="keluar.php">Logout</a></li>
        </ul>
        </div>
    </header>
    <!-- content -->

    <div class = "section">
    <div class = "container">
        <h3>Tambah Data Produk</h3>
        <div class="box">
        <form action ="" method= "POST" enctype= "multipart/form-data">
        <select class ="input-control" name="kategori" required>
            <option value= "">--Pilih--</option>
            <?php 
               $kategori = mysqli_query($koneksi, "SELECT * FROM tb_category ORDER BY category_id DESC"); 
                while($r = mysqli_fetch_array($kategori)){
                ?>
                <option value= "<?php echo $r['category_id']?>"><?php echo $r['category_name'] ?></option>
                <?php
                    } 
                ?>

               
            ?>
            </select>
            <input type="text" name="nama" class="input-control" placeholder= "Nama Produk" required>
            <input type="text" name="harga" class="input-control" placeholder= "Harga" required>
            <input type="file" name="gambar" class="input-control" required>
            <textarea class= "input-control" name="deskripsi" placeholder="Deskripsi"></textarea>
            <select class="input control" name="status">
                <option value="">--Pilih--</option>
                <option value="1">--Aktif--</option>
                <option value="2">--Tidak Aktif--</option>

            </select>
            <input type = "submit" name = "submit" value ="Submit" class="btn">         
    </form>
    <?php 
        if(isset($_POST['submit'])) {
            
            //print_r($_FILES['gambar']);

            //menampung inputan dari form
            $kategori= $_POST['kategori'];
            $nama= $_POST['nama'];
            $harga= $_POST['harga'];
            $deskripsi= $_POST['deskripsi'];
            $status= $_POST['status'];

            //menampung data file yang akan diupload
            $filename   = $_FILES['gambar']['name'];
            $tmp_name   = $_FILES['gambar']['tmp_name'];

            $type1      = explode('.', $filename);
            $type2      = $type1[1];

            $newname = 'produk'.time().'.'.$type2;

            //menampung file yang diijinkan
            $tipe_diizinkan = array('jpg', 'jpeg', 'png','gif');

            //validasi format file
            if(!in_array($type2, $tipe_diizinkan)){
                // jika format file tidak ada didalam file type yang dijinkan
                echo '<script>alert("Format file tidak diizinkan") </script>';

            }else {

              
            }

            //jika format file sesuai dengan yang ad di dalam array tipe diizinkan
            //proses upload file sekaligus insert ke database
            move_uploaded_file($tmp_name, './produk/'.$newname);

           $insert = mysqli_query($koneksi, "INSERT INTO tb_product VALUES (
                null,
                '".$kategori."',
                '".$nama."',
                '".$harga."',
                '".$deskripsi."',
                '".$newname."',
                '".$status."',
                null

                    )");


            if($insert){
                echo '<script>alert("Tambah data berhasil")</script>';
                echo '<script>window.location="data-produk.php"</script>';
            }else
                echo 'gagal' .mysqli_error($koneksi);
    }
        
    ?>

   
            </div>

            
            </div>

</div>
    
        <!--footer-->
        <footer>
        <div class = "container">
        <small>Copyright &copy; 2024 Buka Warung</small>
        </div>

        </footer>
        <script>
						CKEDITOR.replace( 'deskripsi' );
				</script>
        
</body>
</html>