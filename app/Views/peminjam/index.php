<head>
    <link   href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link   href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css">
    <link   rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand topbar mb-2 static-top"></nav>
    <!-- <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <!-- Begin Page Content -->
    <div id="cover-caption">
        <div class="row justify-content-center">
            <div class="col-xl-8 mx-auto form p-2">
                <div class="px-2">
                    <!-- Page Heading -->
                    <?php if (session()->get('message')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            Data Peminjaman Berhasil <strong> <?= session()->getFlashdata('message');?>, Terimakasih !</strong>
                        </div>
                    <?php endif; ?>
                    <!-- Allert -->
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if (session()->get('err')) {
                                echo "<div class='alert alert-danger' role='alert'>". session()->get('err') . "</div>";
                                // echo "<div class='alert alert-danger' role='alert'>" . $validation->listErrors() . "</div>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="container h-100">
                        <div class="row h-100 justify-content-center align-items-center">
                            <div class="card col-12">
                                <h5 class="card-header text-center m-0 font-weight-bold text-primary">Form <?= $judul; ?></h5>
                                <div class="card-body">
                                    <form action="<?= base_url('peminjam/tambah'); ?>" class="justify-content-center" method="post">
                                    <div class="row">
                                        <div class="form-group col-xl-6">
                                            <label for="nama_depan">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama_depan" name="nama_depan" placeholder="Nama Depan" required>
                                        </div>
                                        <div class="form-group col-xl-6">
                                            <label for="nama_belakang"><br></label>
                                            <input type="text" class="form-control" id="nama_belakang" name="nama_belakang" placeholder="Nama Belakang" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="subbagian">SubBagian</label>
                                        <select id="subbagian" name="subbagian" class="form-control" required>
                                            <?php foreach ($subbagian as $s) { ?>
                                                <option value="<?= $s['id_subbagian']; ?>"><?= $s['nm_subbagian']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-xl-9">
                                            <label for="barang">Barang</label>
                                            <select id="barang" name="barang" class="form-control" required>
                                                <option value="" selected>-- Pilih Barang --</option>
                                                <?php foreach ($barang as $s) { ?>
                                                    <option value="<?= $s['id']; ?>"><?= $s['nm_barang']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-xl-3">
                                                <label for="jumlah">Jumlah</label>
                                                <input id="hasil" type="number" name="jml_pinjam" class="form-control input-number" value="0" min="1">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tanggal</label>
                                            <input type="date" name="tgl_pinjam" class="form-control" value="<?= $now; ?>" placeholder="Pilih Tanggal" required>
                                        </div>
                                        <button type="submit" name="tambah" class="btn btn-primary btn-block">Simpan</button>
                                    </div>
                                    </form>
                                </div>
                                <p class="card-text text-center" style="transform: rotate(0); color:#858796;">
                                <a href="<?= base_url('masuk'); ?>" class="text-decoration-none stretched-link">Klik Disini</a> jika anda login sebagai Admin/PIC.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- End of Main Content -->
    
    <!-- Custom styles for this template-->
    <link   href="/assets/css/sb-admin-2.css" rel="stylesheet">
    
    <!-- Bootstrap core JavaScript-->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" 
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" 
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" 
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
            
    <!-- Core plugin JavaScript-->
    <script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
            
    <!-- Custom scripts for all pages-->
    <script src="/assets/js/sb-admin-2.min.js"></script>
            
    <!-- My Script -->
    <script src="/assets/js/script.js"></script>

</body>
        
