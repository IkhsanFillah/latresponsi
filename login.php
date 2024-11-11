<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <h1 class="text-center mt-5">Login</h1>
    <?php 
    if(isset($_GET['pesan'])){
        if($_GET['pesan'] == "gagal"){
            echo "login gagal! username dan password salah!";
        } else if($_GET['pesan'] == "logout"){
            echo "anda telah berhasil logout";
        } else if($_GET['pesan'] == "belum_login"){
            echo "anda harus login untuk mengakses halaman utama!";
        } else if($_GET['pesan'] == "akun_terhapus"){
            echo "akun anda telah terhapus";
        }
    }
    ?>
    <div class="p-5">
        <form action="cek_login.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
        <p class="">don't have an account? <a href="signup.php">Signup</a></p>
    </div>
</body>
</html>