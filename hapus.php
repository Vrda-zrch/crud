<?php 
session_start(); 
include 'koneksi.php'; 
if (!isset($_SESSION['status_login'])) { header("Location: login.php"); exit; 
} 
$id = $_GET['id']; 
$query = "DELETE FROM buku WHERE id = '$id'"; 
if (mysqli_query($koneksi, $query)) { 
echo "<script>alert('Data berhasil dihapus!'); 
window.location='dashboard.php';</script>"; 
} else { 
echo "Error: " . mysqli_error($koneksi); 
} 
?>