<head>
    <link   href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link   href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css">
    <link   rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="shortcut icon" href="<?= base_url('/assets/img/logop4.png'); ?>" />
</head>
<body>
    <!-- <nav class="navbar navbar-expand topbar mb-4 static-top"></nav> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
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
