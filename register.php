```php
<?php
include 'koneksi.php';

$error = '';

if (isset($_POST['register'])) {
    $nama = trim($_POST['nama_lengkap']);
    $user = trim($_POST['username']);
    $password = $_POST['password'];

    // Periksa apakah username sudah digunakan
    $cek = mysqli_prepare(
        $koneksi,
        "SELECT username FROM users WHERE username = ?"
    );

    mysqli_stmt_bind_param($cek, "s", $user);
    mysqli_stmt_execute($cek);
    mysqli_stmt_store_result($cek);

    if (mysqli_stmt_num_rows($cek) > 0) {
        $error = 'Username sudah digunakan. Silakan pilih username lain.';
    } else {
        // Hash password sebelum disimpan ke database
        $pass = password_hash($password, PASSWORD_DEFAULT);

        $query = mysqli_prepare(
            $koneksi,
            "INSERT INTO users (username, password, nama_lengkap)
             VALUES (?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $query,
            "sss",
            $user,
            $pass,
            $nama
        );

        if (mysqli_stmt_execute($query)) {
            echo "<script>
                alert('Registrasi berhasil! Silakan login.');
                window.location.href = 'login.php';
            </script>";
            exit;
        } else {
            $error = 'Registrasi gagal. Silakan coba lagi.';
        }

        mysqli_stmt_close($query);
    }

    mysqli_stmt_close($cek);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Perpustakaan SMK Muhammadiyah 3 Tangsel</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background: linear-gradient(135deg, #101828, #243b65);
            color: #1e293b;
        }

        .register-card {
            width: 100%;
            max-width: 420px;
            padding: 36px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        }

        .logo {
            width: 58px;
            height: 58px;
            margin: 0 auto 18px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 16px;
            background: #2563eb;
            color: #ffffff;
            font-size: 25px;
            font-weight: bold;
        }

        h1 {
            text-align: center;
            font-size: 26px;
            margin-bottom: 8px;
        }

        .subtitle {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 26px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            font-size: 15px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.13);
        }

        button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: #2563eb;
            color: #ffffff;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
        }

        button:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .error {
            padding: 12px;
            margin-bottom: 18px;
            border-radius: 9px;
            background: #fee2e2;
            color: #b91c1c;
            font-size: 13px;
            line-height: 1.5;
        }

        .footer {
            margin-top: 22px;
            text-align: center;
            font-size: 14px;
            color: #64748b;
        }

        .footer a {
            color: #2563eb;
            font-weight: bold;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .register-card {
                padding: 26px 22px;
            }

            h1 {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>

    <div class="register-card">

        <div class="logo">C</div>

        <h1>Buat Akun</h1>

        <p class="subtitle">
            Registrasi Petugas Perpustakaan<br>
            SMK Muhammadiyah 3 Tangsel
        </p>

        <?php if ($error !== ''): ?>
            <div class="error">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">

            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input
                    type="text"
                    id="nama_lengkap"
                    name="nama_lengkap"
                    placeholder="Masukkan nama lengkap"
                    autocomplete="name"
                    value="<?= htmlspecialchars($_POST['nama_lengkap'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                    required
                >
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    placeholder="Buat username"
                    autocomplete="username"
                    value="<?= htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Buat password"
                    autocomplete="new-password"
                    required
                >
            </div>

            <button type="submit" name="register">
                Daftar Sekarang
            </button>

        </form>

        <div class="footer">
            Sudah punya akun?
            <a href="login.php">Login di sini</a>
        </div>

    </div>

</body>
</html>
```