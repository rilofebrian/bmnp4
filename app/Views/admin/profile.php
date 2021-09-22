<!-- Begin Page Content -->
<div class="container-fluid">
    
<!-- Page Heading -->
  <?php if (session()->get('err')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong> <?= session()->getFlashdata('err');?> </strong>
    </div>
  <?php endif; ?>
  <?php if (session()->get('message')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong> <?= session()->getFlashdata('message');?> </strong>
    </div>
  <?php endif; ?>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="text-primary"><?= $judul;?> Admin</h3>
    </div>
    
    <div class="card-body">

      <form action="<?= base_url('admin/update_password'); ?>" method="post">
        <div class="form-group row">
          <label for="nama" class="col-sm-2 col-form-label">Nama Admin</label>
          <div class="col-sm-3">
            <input type="text" name="nama_admin" class="form-control" id="nama" value="<?= $result->nama_admin;?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Username</label>
          <div class="col-sm-3">
            <input type="text" name="user_admin" class="form-control" id="staticEmail" value="<?= $result->user_admin;?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
          <div class="col-sm-3">
            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password Baru">
          </div>
        </div>
        <button type="submit" class="btn btn-primary mb-2">Update</button>
      </form>
    </div>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="text-primary">Pejabat Penandatangan</h3>
    </div>
    
    <div class="card-body">

      <form action="<?= base_url('admin/update_penandatangan'); ?>" method="post">
        <div class="form-group row">
          <label for="nama" class="col-sm-2 col-form-label">Nama Penandatangan</label>
          <div class="col-sm-3">
            <input type="text" name="nama" class="form-control" id="nama" value="<?= $penandatangan->nm_penandatangan;?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Jabatan</label>
          <div class="col-sm-3">
            <input type="text" name="jabatan" class="form-control" id="staticEmail" value="<?= $penandatangan->jbt_penandatangan;?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">NIP</label>
          <div class="col-sm-3">
            <input type="number" name="nip" class="form-control" id="staticEmail" value="<?= $penandatangan->nip;?>">
          </div>
        </div>
        <button type="submit" class="btn btn-primary mb-2">Update</button>
      </form>
    </div>
  </div>

</div>
</div>