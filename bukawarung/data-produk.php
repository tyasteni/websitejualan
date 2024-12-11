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
        <h3>Data Produk</h3>
        <div class="box">
            <p><a href="tambah-produk.php">Tambah Produk</a></p>
            <table border="1" cellspacing="0" class="table"> 
                <thead>
                    <tr>
                        <th width="60px">No</th>
                        <th>Kategori</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th>Status</th>
                        <th width="150px">Aksi</th>

                    </tr>

                </thead>
            <tbody>
                <?php 
                    $no  = 1;
                    $produk= mysqli_query($koneksi, "select * from tb_product LEFT JOIN tb_category using (category_id) ORDER by product_id DESC");
                    if(mysqli_num_rows($produk) >0){
                        while($row = mysqli_fetch_array($produk)){
                            
                    ?>

                    
                <tr>
                    <td><?php echo $no++?></td>
                    <td><?php echo $row['category_name']?></td>
                    <td><?php echo $row['product_name']?></td>
                    <td>Rp.<?php echo number_format($row['product_price']) ?></td>
                    <td><a href ="produk/<?php echo $row['product_image']?>" target ="_blank"><img src= "produk/<?php echo $row['product_image']?>" width="50px" ></a></td>
                    <td><?php echo ($row['product_status'] == 0)? 'Tidak aktif':'Aktif'; ?> </td>
                    <td>
                        <a href ="edit-produk.php?id=<?php echo $row['product_id']?>"> Edit </a> || <a href="proses-hapus.php?idp=<?php echo $row['product_id']?>" onclick="return confirm ('Yakin hapus?')">Hapus</a>

                    </td>

                </tr>
               <?php }} else{ ?> 
                    <tr>    
                        <td colspan ="7">Tidak ada data</td>
                    </tr>

               <?php } ?>              
            </tbody>
            </table>

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