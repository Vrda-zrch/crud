<?php 
session_start(); 
include 'koneksi.php'; 
 
if (!isset($_SESSION['status_login'])) { header("Location: login.php"); exit; 
} 
 
// Mengambil ID dari URL 
$id = $_GET['id']; 
$query = mysqli_query($koneksi, "SELECT * FROM buku WHERE id = '$id'"); 
$data = mysqli_fetch_assoc($query); 
 
// Proses Update 
if (isset($_POST['update'])) { 
    $judul = $_POST['judul']; 
    $pengarang = $_POST['pengarang']; 
    $penerbit = $_POST['penerbit']; 
    $tahun = $_POST['tahun_terbit']; 
    $stok = $_POST['stok']; 
 
    $update_query = "UPDATE buku SET  
                     judul = '$judul', pengarang = '$pengarang', penerbit = 
'$penerbit',  
                     tahun_terbit = '$tahun', stok = '$stok' WHERE id = 
'$id'"; 
                      
    if (mysqli_query($koneksi, $update_query)) { 
        echo "<script>alert('Data berhasil diubah!'); 
window.location='dashboard.php';</script>"; 
    } else { 
        echo "Error: " . mysqli_error($koneksi); 
    } 
} 
?> 
 
<!DOCTYPE html> 
<html> 
<head><title>Edit Buku</title></head> 
<body> 
    <h2>Form Edit Data Buku</h2> 
    <form method="POST" action=""> 
        <label>Judul Buku:</label><br> 
        <input type="text" name="judul" value="<?php echo $data['judul']; ?>" 
required><br><br> 
         
        <label>Pengarang:</label><br> 
        <input type="text" name="pengarang" value="<?php echo 
$data['pengarang']; ?>" required><br><br> 
         
        <label>Penerbit:</label><br> 
        <input type="text" name="penerbit" value="<?php echo 
$data['penerbit']; ?>" required><br><br> 
         
        <label>Tahun Terbit:</label><br> 
        <input type="number" name="tahun_terbit" value="<?php echo 
$data['tahun_terbit']; ?>" required><br><br> 
         
        <label>Stok:</label><br> 
        <input type="number" name="stok" value="<?php echo $data['stok']; ?>" 
required><br><br> 
         
        <button type="submit" name="update">Update Data</button> 
        <a href="dashboard.php">Batal</a> 
    </form> 
</body> 
</html> 