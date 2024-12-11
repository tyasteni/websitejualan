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
<body= id= "bg-login">
    <div class= "box-login">
    <h2>Login</h2>
    <form action ="" method="POST">
        <input type ="text" name="user" placeholder="Username" class= "input-control">
        <input type ="password" name="pass" placeholder="Password" class= "input-control">
        <input type = "submit" name="submit" value="login" class = "btn">
    </form>
    <?php 
        

         if(isset($_POST['submit'])){
            session_start();

            $user = mysqli_real_escape_string($koneksi, $_POST['user']);
            $pass = mysqli_real_escape_string($koneksi, $_POST['pass']);
         
            $cek = mysqli_query($koneksi, "SELECT * FROM td_admin WHERE username = '".$user."' AND password = '".md5($pass)."'");


            

            if (mysqli_num_rows($cek) > 0) {
                $d = mysqli_fetch_object($cek);
                $_SESSION['status_login'] = true;
                $_SESSION['a_global'] = $d;
                $_SESSION['id'] = $d->admin_id;
                echo '<script>window.location="dashboard.php"</script>';

            }else {
                echo "login gagal";


            }
         }
 

    
    ?>
    </div> 
    
</body>
</html>