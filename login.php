<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="vendor/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="vendor/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="vendor/dist/css/adminlte.min.css">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
        <img src="vendor/dist/img/ub-vokasi.png" alt="Logo" class="img-fluid " style="max-width: 50px;" >
            <a href="login.php"><b>Sistem E-Lelang Vokasi</b></a>
            
        </div>
        <?php
        session_start();
        include 'koneksi/koneksi.php';

        if (isset($_SESSION['status']) && $_SESSION['status'] === "login") {
            if ($_SESSION['hak_akses'] === "operator") {
                header("location: operator/dashboard.php");
                exit;
            } elseif ($_SESSION['hak_akses'] === "admin") {
                header("location: admin/dashboard.php");
                exit;
            } elseif ($_SESSION['hak_akses'] === "user") {
                header("location: user/dashboard.php");
                exit;
            }
        }

        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = md5($_POST['password']); // For stronger security, consider using password_hash

            // Check in 'pengguna' table
            $stmt = $conn->prepare("SELECT * FROM pengguna WHERE username = ? AND password = ?");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result_pengguna = $stmt->get_result();

            if ($result_pengguna->num_rows === 0) {
                // Check in 'petugas' table if not found in 'pengguna'
                $stmt = $conn->prepare("SELECT * FROM petugas WHERE username = ? AND password = ?");
                $stmt->bind_param("ss", $username, $password);
                $stmt->execute();
                $result_petugas = $stmt->get_result();

                if ($result_petugas->num_rows > 0) {
                    $row = $result_petugas->fetch_assoc();
                    $_SESSION['status'] = "login";
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['id_user'] = $row['id_petugas'];

                    if ($row['role'] == 'admin') {
                        $_SESSION['hak_akses'] = "admin";
                        header("location: admin/dashboard.php");
                    } elseif ($row['role'] == 'operator') {
                        $_SESSION['hak_akses'] = "operator";
                        header("location: operator/dashboard.php");
                    }
                    exit;
                }
            } else {
                $row = $result_pengguna->fetch_assoc();
                $_SESSION['status'] = "login";
                $_SESSION['username'] = $row['username'];
                $_SESSION['id_user'] = $row['id_pengguna'];
                $_SESSION['hak_akses'] = "user";
                header("location: user/dashboard.php");
                exit;
            }

            $error_message = "Username or password is incorrect!";
            $stmt->close();
        }
        ?>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>
                <form action="login.php" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block w-100" name="submit">Sign In</button>
                        </div>
                    </div>
                </form>
                <p class="mb-0">
                    <a href="register.php" class="text-center">Register a new membership</a>
                </p>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="vendor/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="vendor/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="vendor/dist/js/adminlte.min.js"></script>
</body>
</html>
