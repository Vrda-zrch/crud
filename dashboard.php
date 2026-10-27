<?php 
session_start(); 
include 'koneksi.php'; 
 
// Proteksi halaman 
if (!isset($_SESSION['status_login'])) { 
    header("Location: login.php"); 
    exit; 
} 
?> 
 
<!DOCTYPE html> 
<html> 
<head> 
    <title>Dashboard - Perpustakaan SMK Muhammadiyah 3 Tangsel</title> 
</head> 
<body> 
    <h1>Selamat Datang, <?php echo $_SESSION['nama_lengkap']; ?>!</h1> 
    <h3>Sistem Informasi Perpustakaan SMK Muhammadiyah 3 Tangerang 
Selatan</h3> 
     
    <a href="tambah.php"><button>+ Tambah Buku</button></a> |  
    <a href="logout.php"><button>Logout</button></a> 
    <br><br> 
 
    <table border="1" cellpadding="10" cellspacing="0"> 
        <thead> 
            <tr> 
                <th>No</th> 
                <th>Judul Buku</th> 
                <th>Pengarang</th> 
                <th>Penerbit</th> 
                <th>Tahun</th> 
                <th>Stok</th> 
                <th>Aksi</th> 
            </tr> 
        </thead> 
        <tbody> 
            <?php 
            $no = 1; 
            $query = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY id 
DESC"); 
            while ($row = mysqli_fetch_assoc($query)) { 
            ?> 
            <tr> 
                <td><?php echo $no++; ?></td> 
                <td><?php echo $row['judul']; ?></td> 
                <td><?php echo $row['pengarang']; ?></td> 
                <td><?php echo $row['penerbit']; ?></td> 
                <td><?php echo $row['tahun_terbit']; ?></td> 
                <td><?php echo $row['stok']; ?></td> 
                <td> 
                    <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> 
|  
                    <a href="hapus.php?id=<?php echo $row['id']; ?>" 
onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a> 
                </td> 
            </tr> 
            <?php } ?> 
        </tbody> 
    </table> 
</body> 
</html>