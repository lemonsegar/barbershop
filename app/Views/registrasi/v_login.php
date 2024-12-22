<!DOCTYPE html>
<html>
<head>
    <title>Halaman Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4e54c8, #8f94fb); /* Gradasi warna biru ke ungu */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-container img {
            width: 80px; /* Ukuran logo masjid */
            margin-bottom: 20px;
        }

        .login-container h2 {
            color: #4e54c8;
            margin-bottom: 30px;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            font-weight: bold;
            color: #555555;
        }

        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 16px;
            transition: 0.3s;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="password"]:focus {
            border-color: #4e54c8;
            box-shadow: 0 0 8px rgba(78, 84, 200, 0.3);
            outline: none;
        }

        .form-group input[type="checkbox"] {
            margin-right: 5px;
        }

        .form-group a {
            font-size: 14px;
            color: #4e54c8;
            text-decoration: none;
            float: right;
        }

        .form-group a:hover {
            text-decoration: underline;
        }

        .btn {
            background: linear-gradient(135deg, #4CAF50, #8BC34A); /* Gradasi warna hijau */
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s;
        }

        .btn:hover {
            background: linear-gradient(135deg, #45a049, #7cb342);
        }

        .login-container p {
            color: #555555;
            margin-top: 20px;
            font-size: 14px;
        }

        .login-container p a {
            color: #4e54c8;
            text-decoration: none;
            font-weight: bold;
        }

        .login-container p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php
                if (session()->getFlashdata('msg')) : ?>
                    <div class="alert aler-danger">
                        <?= session()->getFlashdata('msg') ?> </div>

                <?php
                endif;
                ?>
<form class="form-horizontal m-t-20" action="/login/ceklogin" method="post">
    <div class="login-container">
        <img src="<?= base_url()?>/assets/images/logomasjid.jpg" alt="Logo Masjid"> <!-- Logo masjid -->
        <h2>Login Masjid</h2>
        <form>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" >
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" >
            </div>
            <div class="form-group">
                <input type="checkbox" id="remember">
                <label for="remember">Remember me</label>
                <a href="#">Forgot password?</a>
            </div>
            <button type="submit" class="btn">LOGIN</button>
            <p>Don't have an account? <a href="#">Register here</a></p>
        </form>
    </div>
</body>
</html>
