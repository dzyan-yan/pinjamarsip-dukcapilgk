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


    <title>Edit Data Peminjaman Arsip</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">


    <!-- Custom fonts for this template -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
    <?php include "koneksi.php";

    //uji tombol ubah
    if (isset($_POST['bubah'])) {

        $ubah = mysqli_query($koneksi, "UPDATE pinjam  SET
                                                            jenis_buku = '$_POST[tjenis_buku]',
                                                            tahun = '$_POST[ttahun]',
                                                            no_buku = '$_POST[tno_buku]',
                                                            no_akta = '$_POST[tno_akta]',
                                                            nama_akta = '$_POST[tnama_akta]',
                                                            nama_peminjam = '$_POST[tnama_peminjam]',
                                                            keterangan = '$_POST[tketerangan]'
                                                        WHERE id_pinjam = '$_POST[id]'
                                                        ");
        //jika ubah sukses
        if ($ubah) {
            echo "<script>
            Swal.fire({
              title: 'Berhasil!',
              text: 'Data Berhasil Dirubah',
              icon: 'success',
               confirmButtonText: 'OK'
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

    //uji tombol hapus
    if (isset($_POST['bhapus'])) {

        $hapus = mysqli_query($koneksi, "DELETE FROM pinjam WHERE id_pinjam = '$_POST[id]'");

        //jika hapus sukses
        if ($hapus) {
            echo "<script>
            Swal.fire({
              title: 'Berhasil!',
              text: 'Data Berhasil Dihapus',
              icon: 'success',
               confirmButtonText: 'OK'
            });
          </script>";
        } else {
            echo "<script>
                Swal.fire({
                  title: 'Error!',
                  text: 'Data Gagal Dihapus.',
                  icon: 'error',
                  confirmButtonText: 'Coba lagi'
                });
              </script>";
        }
    }



    ?>

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

                <!-- Begin Page Content -->
                <div class="container-fluid bg-light">

                    <!-- Awal Tabel Daftar Peminjaman -->
                    <div class="card shadow mb-4">
                        <div class="card-header text-center py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Data Buku yang Belum Dikembalikan</h5>

                        </div>
                        <div class="card-body text-gray-900">

                            <div class="table-responsive">
                                <table class="table table-bordered text-gray-900" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal Peminjaman</th>
                                            <th>Jenis Buku</th>
                                            <th>Tahun Buku</th>
                                            <th>No. Buku</th>
                                            <th>No. Akta</th>
                                            <th>Nama di Akta</th>
                                            <th>Nama Peminjam</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody style="text-transform: capitalize">
                                        <?php
                                        // date_default_timezone_set("Asia/Jakarta");
                                        // $tgl = date('Y-m-d');
                                        // $status = $keterangan;
                                        $tampil = mysqli_query($koneksi, "SELECT * FROM pinjam where keterangan = 'Belum Dikembalikan' order by id_pinjam desc");
                                        $no = 1;
                                        while ($data = mysqli_fetch_array($tampil)) {
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td class="text-center"><?= $data['tanggal'] ?></td>
                                                <td class="text-center"><?= $data['jenis_buku'] ?></td>
                                                <td class="text-center"><?= $data['tahun'] ?></td>
                                                <td><?= $data['no_buku'] ?></td>
                                                <td><?= $data['no_akta'] ?></td>
                                                <td><?= $data['nama_akta'] ?></td>
                                                <td><?= $data['nama_peminjam'] ?></td>
                                                <td>
                                                    <button class="btn btn-info  text-gray-900" title="Edit" data-toggle="modal" data-target="#modalUbah<?= $no ?>"> <i class="fa fa-edit"></i> </button>
                                                    <button class="btn btn-danger" title="Hapus" data-toggle="modal" data-target="#modalHapus<?= $no ?>"> <i class="fa fa-trash"></i> </button>
                                                </td>
                                            </tr>

                                            <!-- Awal Modal Ubah-->
                                            <div class="modal fade" id="modalUbah<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-gray-900">Ubah Data Peminjaman</h5>
                                                        </div>

                                                        <div class="modal-body">

                                                            <form class="user" method="POST" action="">
                                                                <input type="hidden" name="id" value="<?= $data['id_pinjam'] ?>">

                                                                <div class="form-group row">
                                                                    <label class="col-sm-4 col-form-label">Jenis Buku</label>
                                                                    <div class="col-sm-8">

                                                                        <select name="tjenis_buku" class="dropdown form-control">
                                                                            <option selected><?= $data['jenis_buku'] ?></option>
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
                                                                    <label class="col-sm-4 col-form-label">Tahun</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" style="text-transform: capitalize" class="form-control" name="ttahun" value="<?= $data['tahun'] ?>">
                                                                    </div>
                                                                </div>


                                                                <div class="form-group row">
                                                                    <label class="col-sm-4 col-form-label">No. Buku</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" style="text-transform: capitalize" class="form-control" name="tno_buku" value="<?= $data['no_buku'] ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-sm-4 col-form-label">No. Akta</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" style="text-transform: capitalize" class="form-control" name="tno_akta" value="<?= $data['no_akta'] ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-sm-4 col-form-label">Nama di Akta</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="tnama_akta" value="<?= $data['nama_akta'] ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-sm-4 col-form-label">Nama Peminjam</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="tnama_peminjam" value="<?= $data['nama_peminjam'] ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-sm-4 col-form-label">Keterangan</label>
                                                                    <div class="col-sm-8">

                                                                        <select name="tketerangan" class="dropdown form-control">
                                                                            <option selected><?= $data['keterangan'] ?></option>
                                                                            <option value="Sudah Dikembalikan">Sudah Dikembalikan</option>

                                                                            <!-- nambah option instansi disini ya-->

                                                                        </select>

                                                                    </div>
                                                                </div>


                                                                <div class="modal-footer">
                                                                    <button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
                                                                    <button class="btn btn-success" type="submit" name="bubah" href="">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhir Modal Ubah-->

                                            <!-- Awal Modal Hapus -->
                                            <div class="modal fade" id="modalHapus<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-gray-900">Hapus Data Peminjaman</h5>
                                                        </div>


                                                        <div class="modal-body">
                                                            <form class="user" method="POST" action="">
                                                                <input type="hidden" name="id" value="<?= $data['id_pinjam'] ?>">

                                                                <h5 class="text-center">Yakin ingin menghapus data ini? <br>
                                                                    <span class="text-danger"><?= $data['nama'] ?></span>
                                                                </h5>
                                                        </div>


                                                        <div class="modal-footer">
                                                            <button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
                                                            <button class="btn btn-danger" type="submit" name="bhapus" href="">Hapus</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- Akhir Modal Hapus -->


                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Akhir Tabel Daftar Peminjam -->

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- Footer -->
            <div>
                <footer class="page-footer bg-light">
                    <div class="text-center text-primary py-3">
                        <h6>Copyright &copy; Dinas Dukcapil Kabupaten Gunungkidul 2024 - <?= date("Y") ?> | All rights reserved</h6>
                    </div>
                </footer>
            </div>
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

    <!-- Awal Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-gray-900" id="exampleModalLabel">Yakin ingin keluar..?</h5>
                    <button class="close" type="button" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Klik Oke untuk melanjutkan. <br> Semoga Lelahmu Jadi Ibadah..!!</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="logout.php">Oke</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Logout Modal-->

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>
    <script src="assets/js/sweetalert2.all.min.js"></script>

    <!-- Page level plugins -->
    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/datatables-demo.js"></script>

    <!-- tambahan -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- tambahan -->

</body>

</html>