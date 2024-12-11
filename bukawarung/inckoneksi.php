<?php 
    $hostname   = 'localhost';
    $username   = 'root';
    $password   = '';
    $dbname     = 'dbbukawarung';

    $koneksi = mysqli_connect($hostname, $username, $password, $dbname) or die ('Gagal terhubung');
?>