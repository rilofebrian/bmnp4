    <div>    
        <div>   
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Lambada <?= date('Y'); ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/vendor/jquery/jquery.js"></script>
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    
    <script>
        $(document).ready(function() {
        $('#dataTable').DataTable();
        } );
    </script>
    <!-- Core plugin JavaScript-->
    <script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/assets/js/sb-admin-2.min.js"></script>

    <!-- My Script -->
    <script src="/assets/js/script.js"></script>
    
    <!-- Edit Barang Script -->
    <script>
        $(document).ready(function(){
            //edit data
            $(document).on('click', '#btn-edit', function(){
                $('#edit_id_barang').attr('value', $(this).data('id'));
                $('#edit_nm_barang').attr('value', $(this).data('nm_barang'));
                $('#edit_tgl_masuk_barang').attr('value', $(this).data('tgl_masuk_barang'));
                $('#edit_jml_barang').attr('value', $(this).data('jml_barang'));
                $('#edit_ket_barang').attr('value', $(this).data('ket_barang'));
                const satuan_barang =  $(this).data('satuan_barang');
                const jns_barang = $(this).data('jns_barang');
                $('#edit_nama_satuan').html(`
                    <label for="edit_nama_satuan">Nama Satuan</label>
                    <?php foreach($satuan as $s) : ?>
                        <option value="<?= $s['id_satuan'] ?>" ${ satuan_barang == <?= $s['id_satuan'] ?> ? 'selected' : '' } ><?= $s['nama_satuan'] ?></option> 
                    <?php endforeach ?>
                `);
                if(jns_barang == 'Aset Tetap')
                {
                    $('#edit_jns_barang').html(`
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="edit_jns_barang1" name="edit_jns_barang" class="custom-control-input" value="Aset Tetap" checked>
                            <label class="custom-control-label" for="edit_jns_barang1">Aset Tetap</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="edit_jns_barang2" name="edit_jns_barang" class="custom-control-input" value="Aset Persediaan">
                            <label class="custom-control-label" for="edit_jns_barang2">Aset Persediaan</label>
                        </div>
                    `);
                }
                else
                {
                    $('#edit_jns_barang').html(`
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="edit_jns_barang1" name="edit_jns_barang" class="custom-control-input" value="Aset Tetap">
                            <label class="custom-control-label" for="edit_jns_barang1">Aset Tetap</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="edit_jns_barang2" name="edit_jns_barang" class="custom-control-input" value="Aset Persediaan" checked>
                            <label class="custom-control-label" for="edit_jns_barang2">Aset Persediaan</label>
                        </div>
                    `);
                }
            });

            //hapus data
            $(document).on('click', '#btn-hapus', function(){
                const id_hapus = $(this).data('id_hapus');
                const hapus_nm_barang = $(this).data('hapus_nm_barang');
                const base_url = "<?= base_url();  ?>";
                console.log(base_url);
                $('#modalHapus .modal-body').html(`<p>Anda yakin ingin menghapus <strong>${hapus_nm_barang}</strong> dari daftar barang?</p>`);
                $('#modalHapus #btn_hapus_barang').attr('href', `${base_url}/barang/hapus/${id_hapus}`);
            });
        });
    </script>

</body>

</html>