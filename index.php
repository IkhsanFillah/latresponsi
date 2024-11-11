<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>halaman utama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .dropdown-menu {
            margin-left: -80px;
        }
    </style>
</head>
<body>
    <?php 
    session_start();
    if(!isset($_SESSION['email'])) {
        header('Location: login.php?pesan=belum_login');
    }
    include 'db.php';
    $email = $_SESSION['email'];
    $sql = "select name from users where email='$email'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $name = $row['name'];
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid flex justify-content-between">
        <a class="navbar-brand ms-4" href="#">Perpustakaan</a>
        <!-- Search (poin) -->
        <form class="d-flex" method="GET" action="index.php">
            <input class="form-control me-2" type="search" name="search" placeholder="Cari buku..." aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Cari</button>
        </form>
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Halo, <?php echo $name; ?> <!-- name user (poin) -->
            </a>
            <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                <li><a class="dropdown-item" href="editProfile.php">Edit Profile</a></li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
    </nav>

    <div class="container mt-4">
        <h2 class="text-center mt-4 mb-4">Daftar Buku</h2>
        <a href="addBook.php" class="text-white text-decoration-none"><button class="btn btn-success mb-3" type="button">Tambah Buku</button></a>
        <table class="table table-striped" border="1">
            <thead>
                <tr class="bg-dark text-white">
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun</th>
                    <th>Genre</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $search = isset($_GET['search']) ? $_GET['search'] : '';
                $limit = 10; // Jumlah item per halaman (poin)
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $offset = ($page - 1) * $limit;

                $sql = "SELECT * FROM books WHERE (title LIKE '%$search%' OR author LIKE '%$search%') AND user_id = (SELECT id FROM users WHERE email='$email') LIMIT $limit OFFSET $offset";
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>". $row["title"] ."</td>";
                    echo "<td>". $row["author"] ."</td>";
                    echo "<td>". $row["year"] ."</td>";
                    echo "<td>". $row["genre"] ."</td>";
                    echo "<td>
                            <button class='btn btn-warning'><a class='text-white text-decoration-none' href='editBook.php?id=" . $row["id"] . "'>Edit</a></button>
                            <button class='btn btn-danger'><a class='text-white text-decoration-none' href='deleteBook.php?id=" . $row["id"] . "'>Delete</a></button>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <?php
        //Menghitung total halaman (poin)
        $sql_total = "SELECT COUNT(*) AS total FROM books WHERE (title LIKE '%$search%' OR author LIKE '%$search%') AND user_id = (SELECT id FROM users WHERE email='$email')";
        $result_total = $conn->query($sql_total);
        $row_total = $result_total->fetch_assoc();
        $total_pages = ceil($row_total['total'] / $limit);

        //Menampilkan link pagination 
        echo '<nav aria-label="Page navigation">';
        echo '<ul class="pagination justify-content-center">';
        for ($i = 1; $i <= $total_pages; $i++) {
            echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '"><a class="page-link" href="index.php?page=' . $i . '&search=' . $search . '">' . $i . '</a></li>';
        }
        echo '</ul>';
        echo '</nav>';
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>