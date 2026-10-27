<?php 
include 'koneksi.php'; 
 
if (isset($_POST['register'])) { 
    $nama = $_POST['nama_lengkap']; 
    $user = $_POST['username']; 
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT); 
 
    $query = "INSERT INTO users (username, password, nama_lengkap) VALUES ('$user', '$pass', '$nama')"; 
    if (mysqli_query($koneksi, $query)) { 
        echo "<script>alert('Registrasi berhasil! Silakan login.'); 
window.location='login.php';</script>"; 
    } else { 
        echo "Error: " . mysqli_error($koneksi); 
    } 
} 
?> 
 
<!DOCTYPE html> 
<html> 
<head> 
    <title>Register - Perpustakaan SMK Muhammadiyah 3 Tangsel</title> 
</head> 
<body> 
    <h2>Registrasi Petugas Perpustakaan</h2> 
    <form method="POST" action=""> 
        <label>Nama Lengkap:</label><br> 
        <input type="text" name="nama_lengkap" required><br><br> 
        <label>Username:</label><br> 
        <input type="text" name="username" required><br><br> 
        <label>Password:</label><br> 
        <input type="password" name="password" required><br><br> 
        <button type="submit" name="register">Daftar</button> 
    </form> 
    <p>Sudah punya akun? <a href="login.php">Login di sini</a></p> 
</body> 
</html> 