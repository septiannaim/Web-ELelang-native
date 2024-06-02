<?php
include '../koneksi/koneksi.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    // Check if any required field is empty
    if (empty($fullname) || empty($username) || empty($password) || empty($role)) {
        $error_message = "All fields are required.";
    } else {
        // Convert password to MD5
        $hashed_password = md5($password);

        // Insert user data into the appropriate table based on the role
        if ($role === 'admin' || $role === 'operator') {
            $table_name = 'petugas';
        } else {
            $table_name = 'pengguna';
        }

        try {
            // Prepare the SQL statement
            $query = "INSERT INTO $table_name (nama, username, password, role) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);

            // Bind parameters
            $stmt->bind_param("ssss", $fullname, $username, $hashed_password, $role);

            // Execute the statement
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
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home | E-Lelang</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../vendor/plugins/fontawesome-free/css/all.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="../vendor/dist/css/adminlte.min.css" </head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../admin/dashboard.php" class="brand-link">
                <img src="../vendor/dist/img/vokasi.png" class=" bg-white brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">E-Lelang</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="barang_lelang.php" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Lelang
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Tambah Barang
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="user.php" class="nav-link">
                                <i class="nav-icon fal fa-user-plus"></i>
                                <p>
                                    User
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="tambah_user.php" class="nav-link">
                                <i class="nav-icon fal fa-user-plus"></i>
                                <p>
                                    Tambah User
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../operator/logout.php" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Registration</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" action="tambah_user.php" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter full name">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role">
                                <option value="admin">Admin</option>
                                <option value="operator">Operator</option>
                                <!-- You can add more roles here if needed -->
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.1.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="vendor//plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="vendor/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="vendor/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="vendor/dist/js/demo.js"></script>

    <!-- Bootstrap JS for Modal -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Modal Popup -->
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Informasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalMessage">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script to trigger modal -->
    <script>
        function showModal(message) {
            document.getElementById('modalMessage').innerText = message;
            $('#messageModal').modal('show');
        }
    </script>

    <?php
    if (isset($_GET['message'])) {
        echo "<script>showModal('" . $_GET['message'] . "');</script>";
    }
    ?>
</body>

</html>