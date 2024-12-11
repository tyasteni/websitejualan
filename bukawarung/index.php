<?php 
    include ('inckoneksi.php');
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
        <h1><a href= "index.php">Buka Warung</a></h1>
        <ul>
            <li><a href="produk.php">Produk</a></li>
           
        </div>
    </header>
    <!--search-->
    <div class="search">
        <div class= "container">
            <form action="produk.php">
                <input type="text" name="search" placeholder="Cari Produk"/>
                
                <input type="submit" name="cari" value="Cari Produk"/>
            </form>

        </div>


    </div>
    <!--kategori-->
    <div class="section">
        <div class= "container">
            <h3>Kategori</h3>
            <div class="box">
                <?php 
                    $kategori= mysqli_query($koneksi, "SELECT * FROM tb_category ORDER BY category_id DESC");
                    if(mysqli_num_rows($kategori) > 0 ){
                        while($k = mysqli_fetch_array($kategori)) {
                        ?>     
                        <a href="produk.php?kat=<?php echo $k['category_id']?>">            
                
                <div class="col-5">
                    <img src="img/kategori.png" width="60px">
                    <p><?php echo $k['category_name']?></p>
                
                </div>
                </a>
                <?php }} else { ?> <!--looping bila data ada-->
                    <p>Kategori tidak ada</p>
                    <?php }?>
            </div>
            
        </div>
    </div>
    <!--new product-->
    <div class="section">
        <div class= "container">
            <h3>Produk Terbaru</h3>
            <div class="box">
                <?php 
                    $produk= mysqli_query($koneksi, "SELECT * FROM tb_product WHERE product_status = 1 ORDER BY product_id DESC LIMIT 8"); 
                    if(mysqli_num_rows($produk) > 0){
                       while($p = mysqli_fetch_array($produk)){
                    ?>
                <a href="detail-produk.php?id=<?php echo $p['product_id'] ?>">
                <div class="col-4">
                <img src="produk/<?php echo $p['product_image'] ?> ">    
                <p class="nama"> <?php echo substr($p['product_name'], 0,30) ?></p>     
                <p class="harga">Rp.<?php echo number_format($p['product_price']) ?></p>   
                </div>
                       </a>
                <?php }} else { ?>
                    <p>Produk tidak ada</p>
                    <?php } ?>
            </div>
        </div>
        <footer>
            <div class="footer">
                <div class="container">
                    <small>@2024 Buka warung</small>
                    <h4>Alamat</h4>
                </div>


            </div>
        </footer>
</body>
</html>