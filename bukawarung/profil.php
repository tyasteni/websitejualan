<?php 
    include ('inckoneksi.php');

    session_start();
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }

    $query = mysqli_query($koneksi, "Select * from td_admin where admin_id ='".$_SESSION['id']."'" );
    $d = mysqli_fetch_object($query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <h3>Profil</h3>
        <div class="box">
        <form action ="" method= "POST">
        <input type = "text" name = "nama" placeholder="Nama Lengkap" class= "input-control" value= "<?php echo $d->admin_name ?>"required>
        <input type = "text" name = "user" placeholder="Username" class= "input-control" value= "<?php echo $d->username ?>" required>
        <input type = "text" name = "hp" placeholder="No Hp" class= "input-control" value= "<?php echo $d->admin_telp ?>"required>
        <input type = "text" name = "email" placeholder="Email" class= "input-control" value= "<?php echo $d->admin_email ?>"  required>
        <input type = "text" name = "alamat" placeholder="Alamat" class= "input-control" value= "<?php echo $d->admin_adress ?>" required>
        <input type = "submit" name = "submit" value ="Ubah Profil" class="btn">         
    </form>

    <?php 
        if(isset($_POST['submit'])){
            $nama   = $_POST['nama'];
            $user   = $_POST['user'];
            $hp     = $_POST['hp'];
            $email  = $_POST['email'];
            $alamat = $_POST['alamat'];

            $update = mysqli_query($koneksi, "UPDATE td_admin SET
                        admin_name = '".$nama."', 
                        username = '".$user."', 
                        admin_telp = '".$hp."', 
                        admin_email = '".$email."', 
                        admin_adress = '".$alamat."'
                        WHERE admin_id ='".$d->admin_id."'");

            if($update){
                echo '<script>alert ("Ubah Data Berhasil") </script>';
                echo '<script>window.location="profil.php" </script>';
             }else {
                echo 'gagal' .mysqli_error($koneksi); 
                
             }
        }
    ?>
            </div>

            <h3>Ubah Password</h3>
        <div class="box">
        <form action ="" method= "POST">
        <input type = "password" name = "pass1" placeholder="Password Baru" class= "input-control" required>
        <input type = "password" name = "pass2" placeholder="Konfirmasi Password" class= "input-control"  required>
       
        <input type = "submit" name = "ubah_password" value ="Ubah Password" class="btn">         
    </form>

    <?php 
        if(isset($_POST['ubah_password'])){
            $pass1  = $_POST['pass1'];
            $pass2 = $_POST['pass2'];

            if($pass2 != $pass1){
                echo '<script>alert("Konfirmasi Password Baru tidak sesuai")</script>';
                }else { 
                 $u_pass = mysqli_query($koneksi, "UPDATE td_admin SET
                        
                        password = '".MD5($pass1)."'
                        WHERE admin_id ='".$d->admin_id."'");    
                if ($u_pass) {
                    echo '<script>alert("Ubah data berhasil silahkan logout dan login kembali")</script>';
                    echo '<script>window.location="profil.php" </script>';   
                }else {
                    echo 'gagal' .mysqli_error($koneksi); 

                }        

                }
            }

         
    ?>
            </div>

</div>
    
        <!--footer-->
        <footer>
        <div class = "container">
        <small>Copyright &copy; 2024 Buka Warung</small>
        </div>

        </footer>
</body>
</html>