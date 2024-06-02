<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Auction Items</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../vendor/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../vendor/dist/css/adminlte.min.css">
    <!-- Bootstrap CSS for Modal -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

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
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Barang Lelang</h1>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Item Lelang</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Barang</th>
                                    <th>Deskripsi</th>
                                    <th>Harga Awal</th>
                                    <th>Foto</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include '../koneksi/koneksi.php';

                                $sql = "SELECT *
                                FROM barang ";

                                $result = $conn->query($sql);

                                if (!$result) {
                                    // Jika query gagal, cetak pesan error di browser console
                                    echo "<script>console.error('SQL Error: " . $conn->error . "');</script>";
                                } else {
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                   <td>{$row['id_barang']}</td>
                   <td>{$row['nama_barang']}</td>
                   <td>{$row['deskripsi']}</td>
                   <td>{$row['harga_awal']}</td>
                   <td><img src='../uploads/{$row['foto']}' alt='{$row['nama_barang']}' width='100'></td>
                   <td>{$row['status']}</td>
                   <td>
                       <button class='btn btn-primary btn-sm' data-toggle='modal' data-target='#editModal' 
                           data-id='{$row['id_barang']}' data-nama='{$row['nama_barang']}' data-deskripsi='{$row['deskripsi']}' 
                           data-harga='{$row['harga_awal']}' data-status='{$row['status']}'>
                           Edit
                       </button>
                       <a href='../delete.php?id={$row['id_barang']}' class='btn btn-danger btn-sm'>Delete</a>
                   </td>
               </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='7'>No records found</td></tr>";
                                    }
                                }

                                $conn->close();
                                ?>
                            </tbody>
                        </table>

                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">

            <strong>Copyright &copy; 2023-2024 <a href="#">Vokasi-ub</a>.</strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- /.wrapper -->

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editForm" method="post" action="../edit.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editId" name="id">
                        <div class="form-group">
                            <label for="editNamaBarang">Nama Barang</label>
                            <input type="text" class="form-control" id="editNamaBarang" name="namaBarang" required>
                        </div>
                        <div class="form-group">
                            <label for="editDeskripsiBarang">Deskripsi</label>
                            <textarea class="form-control" id="editDeskripsiBarang" name="deskripsiBarang" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editHargaAwal">Harga Awal</label>
                            <input type="number" class="form-control" id="editHargaAwal" name="hargaAwal" required>
                        </div>
                        <div class="form-group">
                            <label for="editStatus">Status</label>
                            <select class="form-control" id="editStatus" name="status" required>
                                <option value="Available">Available</option>
                                <option value="Sold">Sold</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../vendor/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../vendor/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../vendor/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../vendor/dist/js/demo.js"></script>
    <!-- Bootstrap JS for Modal -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#editModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var nama = button.data('nama');
                var deskripsi = button.data('deskripsi');
                var harga = button.data('harga');
                var status = button.data('status');

                var modal = $(this);
                modal.find('.modal-body #editId').val(id);
                modal.find('.modal-body #editNamaBarang').val(nama);
                modal.find('.modal-body #editDeskripsiBarang').val(deskripsi);
                modal.find('.modal-body #editHargaAwal').val(harga);
                modal.find('.modal-body #editStatus').val(status);
            });
        });
    </script>
</body>

</html>