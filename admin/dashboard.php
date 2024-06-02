<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] !== "login" || $_SESSION['hak_akses'] !== "admin") {
    header("Location: ../login.php");
    exit;
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
                            <a href="logout.php" class="nav-link">
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
                    <h3 class="card-title">Unggah Barang Lelang</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" action="../upload_lelang.php" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="namaBarang">Nama Barang</label>
                            <input type="text" class="form-control" id="namaBarang" name="namaBarang" placeholder="Masukkan nama barang">
                        </div>
                        <div class="form-group">
                            <label for="deskripsiBarang">Deskripsi</label>
                            <textarea class="form-control" id="deskripsiBarang" name="deskripsiBarang" placeholder="Masukkan deskripsi barang"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="hargaAwal">Harga Awal</label>
                            <input type="number" class="form-control" id="hargaAwal" name="hargaAwal" placeholder="Masukkan harga awal lelang">
                        </div>

                        <div class="form-group">
                            <label for="waktuLelang">Waktu Lelang</label>
                            <input type="datetime-local" class="form-control" id="waktuLelang" name="waktuLelang">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Foto Barang</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="fotoBarang" name="fotoBarang">
                                    <label class="custom-file-label" for="fotoBarang">Pilih file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
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