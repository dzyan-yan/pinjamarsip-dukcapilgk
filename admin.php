<?php
//buat session start
session_start();

//uji jika sesion telah diset/ tidak
if (
    empty($_SESSION['username'])
    or empty($_SESSION['password'])
    or empty($_SESSION['nama_user'])
) {
    echo "<script> alert('Maaf, Silahkan Login terlebih dahulu...!'); 
	document.location='index.php';</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Form Input Peminjaman Arsip</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">


    <!-- Custom fonts for this template -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/sweetalert.css">

<!-- Include SweetAlert CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

<!-- Include SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>

<body id="page-top">

    <!-- koneksi ke database -->
    <?php

    include "koneksi.php";

    //uji tombol simpan
    if (isset($_POST['bsimpan'])) {

        date_default_timezone_set("Asia/Jakarta");
        $tgl             = date('Y-m-d');
        $jenis_buku      = $_POST['jenis_buku'];
        $tahun           = $_POST['tahun'];
        $no_buku         = strtoupper(htmlspecialchars($_POST['no_buku'],ENT_QUOTES));
        $no_akta         = strtoupper(htmlspecialchars($_POST['no_akta'],ENT_QUOTES));
        $nama_akta       = strtoupper(htmlspecialchars($_POST['nama_akta'],ENT_QUOTES));
        $nama_peminjam   = strtoupper(htmlspecialchars($_POST['nama_peminjam'],ENT_QUOTES));
        $keterangan      = $_POST['keterangan'];


        $simpan = mysqli_query($koneksi, "INSERT INTO pinjam (tanggal, jenis_buku, tahun, no_buku, no_akta, nama_akta, nama_peminjam, keterangan) VALUES ('$tgl','$jenis_buku', '$tahun','$no_buku','$no_akta','$nama_akta','$nama_peminjam','$keterangan')");

        if ($simpan) {

            echo "<script>
            Swal.fire({
              title: 'Sukses!',
              text: 'Data Berhasil Disimpan',
              icon: 'success',
              showConfirmButton: false,
              timer: 2500
            });
          </script>";


        } else {
            echo "<script>
                Swal.fire({
                  title: 'Error!',
                  text: 'Data gagal disimpan.',
                  icon: 'error',
                  confirmButtonText: 'Coba lagi'
                });
              </script>";
        }
    }
    ?>


    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion " id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-text mx-3">
                    <img src="assets/img/logo1.png" class="img-fluid">
                </div>
            </a>

            <!-- Divider -->
            <hr class=" sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="editdata.php">
                    <i class="fas fa-fw fa-edit"></i>
                    <span>Edit Data Peminjam</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Laporan</span>
                </a> -->


                <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="grafik.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Grafik</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="rekapitulasi.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Rekapitulasi Peminjaman</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

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
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-white"> Halo,
                                    <?php echo $_SESSION['nama_user'];

                                    ?>
                                </span>
                                <img class="img-profile rounded-circle" src="assets/img/undraw_profile.svg">
                            </a>
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

                <!-- Begin Page Content -->
                <div class="container-fluid bg-light">
                    <!-- Awal Form -->
                    <div class="row mt-2">
                        <!-- col lg-8 -->
                        <div class="col-lg-8 mb-3">
                            <div class="card shadow bg-info-200">
                                <!-- card body -->
                                <div class="card-body">
                                    <div class=" p-1">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-5">Form Input Peminjaman Arsip</h1>
                                        </div>
                                        <form class="user text-gray-900" method="POST" action="">
                                        <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Jenis Buku</label>
                                                <div class="col-sm-9">
                                                <select name="jenis_buku" class="dropdown form-control">
                                                    <option selected>Pilih Jenis Buku</option>
                                                    <option value="LU">LU</option>
                                                    <option value="LT">LT</option>
                                                    <option value="LD">LD</option>
                                                    <option value="KM">KM</option>
                                                    <option value="U">U</option>
                                                    <option value="T">T</option>
                                                    <option value="D">D</option>
                                                    <option value="CSU">CSU</option>
                                                    <option value="CSK">CSK</option>

                                                    <!-- nambah option instansi disini ya-->

                                                </select>
</div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Tahun</label>
                                                <div class="col-sm-9">                                          <input type="number" min="1000" max="2999" class="form-control" name="tahun" required>
                                            </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Nomor Buku</label>
                                                <div class="col-sm-9">
                                                <input type="text" class="form-control" style="text-transform: uppercase" name="no_buku" required>
</div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Nomor Akta</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" style="text-transform: uppercase" name="no_akta" required>
                                                </div>
                                            </div>

                                            

                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Nama di Akta</label>
                                                <div class="col-sm-9">
                                                <input type="text" class="form-control" style="text-transform: uppercase"  name="nama_akta" required>
</div>
                                            </div>

                                            <div class="form-group row ">
                                                <label class="col-sm-3 col-form-label">Nama Peminjam</label>
                                                <div class="col-sm-9 text-gray-500">
                                                <select name="nama_peminjam" class="dropdown form-control">
                                                    <option selected>Pilih Satu Saja</option>
                                                    <option value="SM. YULI PURWAWATI">SM. YULI PURWAWATI</option>
                                                    <option value="YULITA NINDA SAPUTRI">YULITA NINDA SAPUTRI</option>
                                                    <option value="SEPTIAMI RAHAYU">SEPTIAMI RAHAYU</option>
                                                    <option value="FANISSA RACHMA KUSUMA">FANISSA RACHMA KUSUMA</option>
                                                    <option value="WINARNI">WINARNI</option>
                                                    <option value="NOVIKA DAMAYANTI">NOVIKA DAMAYANTI</option>
                                                    <option value="ETIK LISWAHYUNINGSIH">ETIK LISWAHYUNINGSIH</option>
                                                    <option value="Y. TRI ENI ASTUTI">Y. TRI ENI ASTUTI</option>
                                                    <option value="BUDI SANTOSA">BUDI SANTOSA</option>
                                                    <option value="BANGUN SULISTYAWAN">BANGUN SULISTYAWAN</option>
                                                    <option value="UMI PUJI RIYANTI">UMI PUJI RIYANTI</option>
                                                    <option value="HETY SURYANI">HETY SURYANI</option>
                                                    <option value="RUSPAMILU YULIANTA">RUSPAMILU YULIANTA</option>
                                                    <option value="RIZA ANITA">RIZA ANITA</option>
                                                    <!-- nambah option instansi disini ya-->

                                                </select>
                                            </div>
                                            </div>

                                            <div class="form-group">
                                                <input type="hidden" class="form-control" style="text-transform: capitalize" name="keterangan" value="Belum Dikembalikan" placeHolder="Keterangan">
                                            </div>

                                            <button type="submit" name="bsimpan" class="btn btn-primary btn-block">Simpan Data
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                        </div>
                        <!-- end col lg-8 -->

                        <!-- col lg-4 -->
                        <div class="col-lg-4 mb-3">
                            <!-- card -->
                            <div class="card shadow bg-light mb-3">
                                <!-- card body -->
                                <div class="card-body py-3">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-3 mt-2">Jumlah Peminjam Hari Ini</h1>
                                    </div>

                                    <?php
                                    //tanggal sekarang
                                    $tgl_sekarang = date('Y-m-d');

                                    ?>

                                    <table class="table table-bordered text-gray-900 text-center">

                                        <tr>
                                            <?php
                                            //query tampilkan data peminjam
                                            $data_lu = mysqli_query($koneksi, "SELECT * FROM pinjam where jenis_buku like 'LU' and tanggal like '%$tgl_sekarang%'");
                                            $jml_lu = mysqli_num_rows($data_lu);
                                            ?>
                                            <td>LU</td>
                                            <td>: <?= $jml_lu; ?></td>
                                        </tr>

                                        <tr>
                                            <?php
                                            //query tampilkan data pengunjung
                                            $data_lt = mysqli_query($koneksi, "SELECT * FROM pinjam where jenis_buku = 'LT' and tanggal like '%$tgl_sekarang%'");
                                            $jml_lt = mysqli_num_rows($data_lt);
                                            ?>
                                            <td>LT</td>
                                            <td>: <?= $jml_lt; ?></td>
                                        </tr>

                                        <tr>
                                            <?php
                                            //query tampilkan data pengunjung
                                            $data_ld = mysqli_query($koneksi, "SELECT * FROM pinjam where jenis_buku = 'LD' and tanggal like '%$tgl_sekarang%'");
                                            $jml_ld = mysqli_num_rows($data_ld);
                                            ?>
                                            <td>LD</td>
                                            <td>: <?= $jml_ld; ?></td>
                                        </tr>

                                        <tr>
                                            <?php
                                            //query tampilkan data pengunjung
                                            $data_km = mysqli_query($koneksi, "SELECT * FROM pinjam where jenis_buku = 'KM' and tanggal like '%$tgl_sekarang%'");
                                            $jml_km = mysqli_num_rows($data_km);
                                            ?>
                                            <td>KM</td>
                                            <td>: <?= $jml_km; ?></td>
                                        </tr>

                                        <tr>
                                            <?php
                                            //query tampilkan data pengunjung
                                            $data_u = mysqli_query($koneksi, "SELECT * FROM pinjam where jenis_buku = 'U' and tanggal like '%$tgl_sekarang%'");
                                            $jml_u = mysqli_num_rows($data_u);
                                            ?>
                                            <td>U</td>
                                            <td>: <?= $jml_u; ?></td>
                                        </tr>

                                        <tr>
                                            <?php
                                            //query tampilkan data pengunjung
                                            $data_t = mysqli_query($koneksi, "SELECT * FROM pinjam where jenis_buku = 'T' and tanggal like '%$tgl_sekarang%'");
                                            $jml_t = mysqli_num_rows($data_t);
                                            ?>
                                            <td>T</td>
                                            <td>: <?= $jml_t; ?></td>
                                        </tr>

                                        <tr>
                                            <?php
                                            //query tampilkan data pengunjung
                                            $data_d = mysqli_query($koneksi, "SELECT * FROM pinjam where jenis_buku = 'D' and tanggal like '%$tgl_sekarang%'");
                                            $jml_d = mysqli_num_rows($data_d);
                                            ?>
                                            <td>D</td>
                                            <td>: <?= $jml_d; ?></td>
                                        </tr>

                                        <tr>
                                            <?php
                                            //query tampilkan data pengunjung
                                            $data_csu = mysqli_query($koneksi, "SELECT * FROM pinjam where jenis_buku = 'CSU' and tanggal like '%$tgl_sekarang%'");
                                            $jml_csu = mysqli_num_rows($data_csu);
                                            ?>
                                            <td>CS.U</td>
                                            <td>: <?= $jml_csu; ?></td>
                                        </tr>

                                        <tr>
                                            <?php
                                            //query tampilkan data pengunjung
                                            $data_csk = mysqli_query($koneksi, "SELECT * FROM pinjam where jenis_buku = 'CSK' and tanggal like '%$tgl_sekarang%'");
                                            $jml_csk = mysqli_num_rows($data_csk);
                                            ?>
                                            <td>CS.K</td>
                                            <td>: <?= $jml_csk; ?></td>
                                        </tr>

                                        <tfoot class="text-danger">
                                            <tr>
                                                <?php
                                                //query jumlah pengunjung hari ini
                                                $jml = ($jml_lu + $jml_lt + $jml_ld + $jml_km + $jml_u + $jml_t + $jml_d + $jml_csu + $jml_csk);
                                                ?>

                                                <th>JUMLAH</th>
                                                <th>: <?= $jml; ?></th>
                                            </tr>
                                        </tfoot>

                                    </table>

                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col lg-4 -->

                    </div>
                    <!-- Akhir Form -->

                    <!-- AwalTabel Daftar Pengunjung -->
                    <div class="card shadow mb-4">
                        <div class="card-header text-center py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Peminjam Hari Ini Tanggal
                                <?php date_default_timezone_set("Asia/Jakarta");
                                echo date("d M Y") ?></h6>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered text-gray-900" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Jenis Buku</th> <!-- nama pengunjung -->
                                            <th class="text-center">Nama Peminjam</th> <!-- jenis_buku -->
                                            <th class="text-center">Nomor Akta</th> <!-- keperluan -->
                                            <th class="text-center">Nomor Buku</th> <!-- keperluan -->
                                            <th class="text-center">Nama di Akta</th> <!-- nope -->
                                            <th class="text-center">Keterangan</th> <!-- nope -->
                                        </tr>
                                    </thead>

                                    <tbody style="text-transform: capitalize">
                                        <?php
                                        date_default_timezone_set("Asia/Jakarta");
                                        $tgl = date('Y-m-d');
                                        $tampil = mysqli_query($koneksi, "SELECT * FROM pinjam where tanggal like '%$tgl%' order by id_pinjam desc");
                                        $no = 1;
                                        while ($data = mysqli_fetch_array($tampil)) {
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td class="text-center"><?= $data['jenis_buku'] ?></td>
                                                <td><?= $data['nama_peminjam'] ?></td>
                                                <td><?= $data['no_akta'] ?></td>
                                                <td><?= $data['no_buku'] ?></td>
                                                <td><?= $data['nama_akta'] ?></td>
                                                <td><?= $data['keterangan'] ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Akhir Tabel Daftar Pengunjung -->


                </div>
                <!-- /.container-fluid -->
            </div>

            <!-- Footer -->

            <footer class="sticky-footer text-center bg-light">
                <div class="copyright text-primary my-auto">
                    <h6>Copyright &copy; Dinas Kependudukan dan Pencatatan Sipil Kabupaten Gunungkidul 2024 - <?= date("Y") ?> | All rights reserved</h6>
                </div>
            </footer>

            <!-- End of Footer -->

        </div>
        <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->


    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-gray-900" id="exampleModalLabel">Yakin ingin keluar..?</h4>
                    <button class="close" type="button" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Klik Oke untuk melanjutkan.! <br> Semoga Lelahmu Jadi Ibadah. (^_^)</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="logout.php">Oke</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>


    <!-- tambahan -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"

      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"

        crossorigin="anonymous"></script>
    <!-- tambahan -->

</body>

</html>