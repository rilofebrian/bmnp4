<!doctype html>
<html lang="en">
  <nav class="navbar navbar-expand topbar mb-4 static-top"></nav>
    <body>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <h2 class="form">Form <?= $judul; ?></h2>
                        <?php if(session()->getFlashdata('msg')):?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                        <?php endif;?>
                        <div class="alert alert-primary">
                            <form action="<?= base_url('masuk/auth'); ?>" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="user_admin" class="form-control" id="username">
                            </div>
                            <div class="mb-3">
                                <label for="InputForPassword" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="InputForPassword">
                            </div>
                            <input type="button" onclick="location.href='<?= base_url('peminjam');?>'" class="btn btn-danger" value='Kembali'>
                            <button type="submit" class="btn btn-primary">Masuk</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
    <!-- Popper.js first, then Bootstrap JS -->
    <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="/assets/css/sb-admin-2.min.css" rel="stylesheet">
        <!-- <link href="/assets/css/sb-admin2.css" rel="stylesheet">  -->

        <!-- Bootstrap core JavaScript-->
        <script src="/assets/js/jquery.min.js"></script>
        <script src="/assets/vendor/jquery/jquery.min.js"></script>
        <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="/assets/js/sb-admin-2.min.js"></script>

        <!-- My Script -->
        <script src="/assets/js/script.js"></script>
    </body>
</html>