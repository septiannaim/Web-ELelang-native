<?php
include 'koneksi/koneksi.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Convert password to MD5
    $hashed_password = md5($password);

    // Insert user data into the appropriate table based on the role
    if ($role === 'admin' || $role === 'operator') {
        $table_name = 'petugas';
    } else {
        $table_name = 'pengguna';
    }

    try {
        $query = "INSERT INTO $table_name (nama, username, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $fullname, $username, $hashed_password, $role);

        if ($stmt->execute()) {
            $success_message = "Registration successful. You can now <a href='login.php'>login</a>.";
        } else {
            $error_message = "Error: " . $stmt->error;
        }

        $stmt->close();
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            // Duplicate entry
            $error_message = "Username already exists. Please choose a different username.";
        } else {
            $error_message = "Error: " . $e->getMessage();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="vendor/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="vendor/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="vendor/dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
    <div class="register-logo">
        <img src="vendor/dist/img/ub-vokasi.png" alt="Logo" class="img-fluid " style="max-width: 50px;" >
            <a href="login.php"><b>Sistem E-Lelang Vokasi</b></a>
            
        </div>
        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new membership</p>

                <?php
                if (isset($error_message)) {
                    echo '<div class="alert alert-danger">' . $error_message . '</div>';
                }
                if (isset($success_message)) {
                    echo '<div class="alert alert-success">' . $success_message . '</div>';
                }
                ?>

                <form action="register.php" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="fullname" class="form-control" placeholder="Full name" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="repassword" class="form-control" placeholder="Retype password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select name="role" class="form-control" required>
                            <option value="" disabled selected>Select role</option>
                            <option value="admin">Admin</option>
                            <option value="operator">Operator</option>
                            <option value="user">User</option>
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-tag"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block w-100">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <a href="login.php" class="text-center">I already have a membership</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="vendor/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="vendor/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="vendor/dist/js/adminlte.min.js"></script>
</body>

</html>
