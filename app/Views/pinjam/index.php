<!-- Begin Page Content -->
<div class="container-fluid">
    
    <!-- Page Heading -->
    <?php if (session()->get('message')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        Data Barang Berhasil <strong> <?= session()->getFlashdata('message');?> </strong>
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

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary"><?= $judul;?></h3>
    </div>
    <div class="card-body">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger btn-icon-split mb-3" data-toggle="modal" data-target="#modalCetak">
            <span class="icon text-white-50">
                <i class="fas fa-print"></i>
            </span>
            <span class="text">Cetak</span>
        </button>
        <div class="table-responsive">
                
            <table id="dataTable" class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Pegawai</th>
                        <th>Subbagian</th>
                        <th>Nama Barang</th> 
                        <th>Tanggal Pinjam</th>
                        <th>Jumlah</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;?>
                    <?php foreach($pinjam as $row): ?>
                    <tr>
                        <td scope="row"> <?= $i; ?> </td>
                        <td><?= $row['nama_depan']; ?> <?= $row['nama_belakang']; ?></td>
                        <td><?= $row['nm_subbagian']; ?></td>
                        <td><?= $row['nm_barang']; ?></td>
                        <td><?= $row['tgl_pinjam']; ?></td>
                        <td><?= $row['jml_pinjam'];?></td>
                        <td>
                            <button type="button" data-toggle="modal" data-target="#modalEdit"
                                class="btn btn-sm btn-warning" id="btn-edit" 
                                data-id_pinjam="<?= $row['id_pinjam'];?>"
                                data-nama_depan="<?= $row['nama_depan'];?>" 
                                data-nama_belakang="<?= $row['nama_belakang'];?>"
                                data-subbagian="<?= $row['subbagian'];?>"
                                data-barang="<?= $row['id_barang'];?>"
                                data-tgl_pinjam="<?= $row['tgl_pinjam'];?>"
                                data-jml_pinjam="<?= $row['jml_pinjam'];?>"> 
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" data-toggle="modal" data-target="#modalHapus"
                                class="btn btn-sm btn-danger" id="btn-hapus" data-id_hapus="<?= $row['id_pinjam'];?>"
                                data-nama_depan="<?= $row['nama_depan'];?>"> <i
                                    class="fa fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    <?php $i++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Modal Cetak Laporan Pegawai -->
<div class="modal fade" id="modalCetak">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cetak Laporan <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('pinjam/cetak_pdf'); ?>" method="post">
                    <div class="form-group row">
                        <label for="tanggal_mulai" class="col-sm-5 col-form-label">Tanggal Mulai</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control" id="tanggal_mulai" name="mulai" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_selesai" class="col-sm-5 col-form-label">Tanggal Selesai</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control" id="tanggal_selesai" name="akhir" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Data -->
<div class="modal fade" id="modalEdit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('pinjam/edit'); ?>" method="post">
                    <input type="hidden" name="id_pinjam" id="edit_id_pinjam">

                    <div class="form-group mb-0">
                        <label for="edit_nama_depan">Nama Depan</label>
                        <input type="text" name="nama_depan" id="edit_nama_depan" class="form-control"
                            placeholder="Masukkan Nama Depan">
                    </div>

                    <div class="form-group mb-0">
                        <label for="edit_nama_belakang">Nama Belakang</label>
                        <input type="text" name="nama_belakang" id="edit_nama_belakang" class="form-control"
                            placeholder="Masukkan Nama Belakang">
                    </div>

                    <div class="form-group">
                        <label for="subbagian">SubBagian</label>
                        <select name="subbagian" id="edit_subbagian" class="form-control" required>

                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-9">
                            <label for="barang">Barang</label>
                            <select id="edit_barang" name="barang" class="form-control" readonly>
                                
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="jumlah">Jumlah</label>

                                <input id="edit_jml_pinjam" type="number" name="jml_pinjam" class="form-control input-number" value="0" min="1" readonly>
                                
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" name="tgl_pinjam" id="edit_tgl_pinjam" class="form-control" value="<?= $now; ?>" placeholder="Pilih Tanggal" required>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" name="edit" class="btn btn-warning">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Delete Data-->
<div class="modal fade" id="modalHapus">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" id="btn_hapus_pinjam"> Delete </a>
            </div>
        </div>
    </div>
</div>

</div>
</div>
<!-- End of Main Content -->

