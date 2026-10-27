<?php 
session_start(); 
include 'koneksi.php'; 
 
if (isset($_POST['login'])) { 
    $user = $_POST['username']; 
    $pass = $_POST['password']; 
 
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username = 
'$user'"); 
    $data = mysqli_fetch_assoc($query); 
 
    // Cek apakah username ada dan password cocok 
    if ($data && password_verify($pass, $data['password'])) { 
        $_SESSION['status_login'] = true; 
        $_SESSION['nama_lengkap'] = $data['nama_lengkap']; 
        header("Location: dashboard.php"); 
    } else { 
        echo "<script>alert('Username atau Password salah!');</script>"; 
    } 
} 
?> 
 
<!DOCTYPE html> 
<html> 
<head> 
    <title>Login - Perpustakaan SMK Muhammadiyah 3 Tangsel</title> 
</head> 
<body> 
    <h2>Login Perpustakaan</h2> 
    <form method="POST" action=""> 
        <label>Username:</label><br> 
        <input type="text" name="username" required><br><br> 
        <label>Password:</label><br> 
        <input type="password" name="password" required><br><br> 
        <button type="submit" name="login">Login</button> 
    </form> 
    <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p> 
</body> 
</html> 