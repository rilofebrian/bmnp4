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
            <!-- Button trigger modal -->
            <h3 class="m-0 font-weight-bold text-primary">Data Barang</h3>
            
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-success btn-icon-split mb-4" data-toggle="modal" data-target="#modalAdd">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add</span>
            </button>
            <button type="button" class="btn btn-danger btn-icon-split mb-4" data-toggle="modal" data-target="#modalCetak">
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
                            <th>Nama Barang</th>
                            <th>Jenis Barang</th>
                            <th>Tanggal Masuk</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;?>
                        <?php foreach($barang as $row): ?>
                        <tr>
                            <td scope="row"> <?= $i; ?> </td>
                            <td><?= $row['nm_barang']; ?></td>
                            <td><?= $row['jns_barang']; ?></td>
                            <td><?= $row['tgl_masuk_barang']; ?></td>
                            <td><?= $row['jml_barang']; ?></td>
                            <td><?= $row['nama_satuan'];?></td>
                            <td><?= $row['ket_barang']; ?></td>
                            <td>
                                <button type="button" data-toggle="modal" data-target="#modalEdit"
                                    class="btn btn-sm btn-warning" id="btn-edit" 
                                    data-id="<?= $row['id'];?>"
                                    data-nm_barang="<?= $row['nm_barang'];?>" 
                                    data-jns_barang="<?= $row['jns_barang'];?>"
                                    data-tgl_masuk_barang="<?= $row['tgl_masuk_barang'];?>"
                                    data-jml_barang="<?= $row['jml_barang'];?>"
                                    data-nama_satuan="<?= $row['nama_satuan'];?>"
                                    data-ket_barang="<?= $row['ket_barang'];?>"
                                    data-satuan_barang="<?= $row['satuan_barang']; ?>"> 
                                    <i class="fas fa-edit"></i>
                                </button>
                                <!-- <button type="button" data-toggle="modal" data-target="#modalHapus"
                                    class="btn btn-sm btn-danger" id="btn-hapus" data-id_hapus="<?= $row['id'];?>"
                                    data-hapus_nm_barang="<?= $row['nm_barang'];?>"> <i
                                        class="fa fa-trash-alt"></i></button> -->
                            </td>
                        </tr>
                        <?php $i++ ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Input Data-->
<div class="modal fade" id="modalAdd">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('barang/tambah'); ?>" method="post">
                    <div class="form-group mb-0">
                        <label for="nm_barang">Nama Barang</label>
                        <input type="text" name="nm_barang" id="nm_barang" class="form-control"
                            placeholder="Masukkan Nama Barang" required>
                    </div>
                    <div class="form-group mb-0">
                        <label for="tgl_masuk_barang">Tanggal Masuk</label>
                        <input type="date" name="tgl_masuk_barang" id="tgl_masuk_barang" class="form-control"
                            placeholder="Pilih Tanggal Barang Masuk">
                    </div>
                    <div class="form-group mb-0">
                        <label for="jml_barang">Jumlah</label>
                        <input type="text" name="jml_barang" id="jml_barang" class="form-control"
                            placeholder="Masukkan Jumlah Barang" required>
                    </div>
                    <div class="form-group mb-0">
                        <label for="ket_barang">Keterangan</label>
                        <input type="text" name="ket_barang" id="ket_barang" class="form-control"
                            placeholder="Masukkan Keterangan Barang" required>
                    </div>
                    <br>
                    <div class="form-group mb-0">
                        <label for="nama_satuan">Satuan</label>
                        <select name="nama_satuan" id="nama_satuan" class="form-control">
                            <?php foreach ($satuan as $s) { ?>
                                <option value="<?= $s['id_satuan']; ?>"><?= $s['nama_satuan']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <br>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary active">
                            <input type="radio" name="jns_barang" value="Aset Tetap"> Aset Tetap
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="jns_barang" value="Aset Persediaan"> Aset Persediaan
                        </label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" name="tambah" class="btn btn-primary">Save</button>
            </div>
            </form>
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
                <form action="<?= base_url('barang/edit'); ?>" method="post">
                    <input type="hidden" name="edit_id_barang" id="edit_id_barang">

                    <div class="form-group mb-0">
                        <label for="edit_nm_barang"></label>
                        <input type="text" name="edit_nm_barang" id="edit_nm_barang" class="form-control"
                            placeholder="Masukkan Nama Barang">
                    </div>

                    <div class="form-group mb-0">
                        <label for="edit_tgl_masuk_barang"></label>
                        <input type="date" name="edit_tgl_masuk_barang" id="edit_tgl_masuk_barang" class="form-control"
                            placeholder="Pilih Tanggal Barang Masuk">
                    </div>

                    <div class="form-group mb-0">
                        <label for="edit_jml_barang"></label>
                        <input type="text" name="edit_jml_barang" id="edit_jml_barang" class="form-control"
                            placeholder="Masukkan Jumlah Barang">
                    </div>

                    <br>
                    <div class="form-group mb-0">
                        <select name="edit_nama_satuan" id="edit_nama_satuan" class="form-control">

                        </select>
                    </div>

                    <div class="form-group mb-0">
                        <label for="edit_ket_barang"></label>
                        <input type="text" name="edit_ket_barang" id="edit_ket_barang" class="form-control"
                            placeholder="Masukkan Keterangan Barang">
                    </div>
                    <div class="form-group mt-3" id="edit_jns_barang">

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" name="edit" class="btn btn-primary">Update</button>
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
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" id="btn_hapus_barang"> Yes </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cetak Laporan -->
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
                <form action="<?= base_url('barang/cetak_pdf'); ?>" method="post">
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