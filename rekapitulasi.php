<?php
//buat session start
session_start();

//uji jika sesion telah diset/ tidak
if (
    empty($_SESSION['username'])
    or empty($_SESSION['password'])
) {
    echo "<script> alert('Maaf, Silahkan Login terlebih dahulu...!'); 
	document.location='index.php';</script>";
}

include "koneksi.php";
?>


<html>


<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Rekapitulasi Peminjaman Arsip</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-primary topbar mb-4 static-top shadow">

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- awal -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle">
                                <marquee behavior="" direction="">
                                    <span class="mr-2 d-none d-lg-inline text-white">
                                        -- Semoga Lelahmu Jadi Ibadah dan Jangan Lupa Bersyukur --
                                    </span>
                                </marquee>
                            </a>
                        </li>
                        <!-- akhir -->
                        <div class="topbar-divider d-none d-sm-block"> </div>

                        <!-- awal -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle">
                                <span class="mr-2 d-none d-lg-inline text-white">
                                    <?php
                                    setlocale(LC_TIME, 'id_ID.utf8');
                                    date_default_timezone_set("Asia/Jakarta");
                                    echo strftime('%A, %d %B %Y') ?>
                                </span>
                            </a>
                        </li>
                        <!-- akhir -->

                        <div class="topbar-divider d-none d-sm-block"> </div>

                        <!-- Nav Item - User Information -->
                        <div class="col-md-3 mt-3">
                            <a href="admin.php" class="btn btn-primary form-control"><i class="fa fa-backward"></i> Kembali</a>
                        </div>

                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <div class="container-fluid">
                    <div class="col-md-12 mt-2">
                        <!-- awal row -->
                        <div class="row">
                            <!-- awal col md 12 -->
                            <div class="col-md-12 mt-4">
                                <!-- awal card -->
                                <div class="card shadow mb-4">
                                    <div class="card-header text-center py-3">
                                        <h2 class="m-0 font-weight-bold text-primary">Rekapitulasi Peminjaman Arsip</h2>
                                    </div>
                                    <div class="card-body text-gray-900">
                                        <form method="POST" action="" class="text-center">
                                            <div class="row">
                                                <div class="col-md-3"> </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Dari tanggal</label>
                                                        <input class="form-control" type="date" name="tgl1" value="<?= isset($_POST['tgl1']) ? $_POST['tgl1'] : date('Y-m-d') ?>" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>Hingga tanggal</label>
                                                        <input class="form-control" type="date" name="tgl2" value="<?= isset($_POST['tgl2']) ? $_POST['tgl2'] : date('Y-m-d') ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <Label type="hidden">Proses</Label>
                                                    <button class="btn btn-info form-control" name="btampilkan"><i class="fa fa-search"></i> Tampilkan</button>
                                                </div>

                                        </form>

                                        <?php
                                        if (isset($_POST['btampilkan'])) :
                                        ?>

                                            <div class="table-responsive">
                                                <table class="table table-bordered text-gray-900" id="mauexport" style="text-transform: capitalize" width="100%" cellspacing="0">
                                                    <thead class="text-center">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Tanggal</th>
                                                           
                                                            <th>Jenis Buku</th>
                                                            <th>Tahun</th>
                                                            <th>No. Buku</th>
                                                            <th>No. Akta</th>
                                                            <th>Nama di Akta</th>
                                                            <th>Nama Peminjam</th>
                                                            <th>status</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        $tanggal1 = $_POST['tgl1'];
                                                        $tanggal2 = $_POST['tgl2'];

                                                        $tampil = mysqli_query($koneksi, "SELECT * FROM pinjam where tanggal BETWEEN '$tanggal1' and '$tanggal2' order by id_pinjam asc");
                                                        $no = 1;
                                                        while ($data = mysqli_fetch_array($tampil)) {
                                                        ?>
                                                            <tr>
                                                                <td class="text-center"><?= $no++ ?></td>
                                                                <td><?= $data['tanggal'] ?></td>
                                                                                                                                <td class="text-center"><?= $data['jenis_buku'] ?></td>
                                                                <td class="text-center"><?= $data['tahun'] ?></td>
                                                                <td><?= $data['no_buku'] ?></td>
                                                                <td><?= $data['no_akta'] ?></td>
                                                                <td><?= $data['nama_akta'] ?></td>
                                                                <td><?= $data['nama_peminjam'] ?></td>
                                                                <td><?= $data['keterangan'] ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>

                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!-- akhir card -->
                            </div>
                            <!-- akhir col md 12 -->
                        </div>
                        <!-- akhir row -->
                    </div>
                </div>
            </div>


            <!-- Footer -->
            <footer class="sticky-footer text-center bg-light">
                <div class="copyright text-primary my-auto">
                    <h6>Copyright &copy; Dinas Kependudukan dan Pencatatan Sipil Kabupaten Gunungkidul 2024 - <?= date("Y") ?> | All rights reserved</h6>
                </div>
            </footer>
            <!-- End of Footer -->


            <script>
                $(document).ready(function() {
                    $('#mauexport').DataTable({

                        dom: 'Bfrtip',
                        buttons: [{
                                extend: 'pdf',
                                oriented: 'Lanscape',
                                pageZise: 'A4',
                                title: 'Rekapitulasi Peminjaman Arsip Disdukcapil',
                                download: 'open',
                            },
                            'copy', 'csv', 'excel', 'print'
                        ]
                    });
                });
            </script>

            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>



</body>

</html>