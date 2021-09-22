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
                $('#edit_id_pinjam').attr('value', $(this).data('id_pinjam'));
                $('#edit_nama_depan').attr('value', $(this).data('nama_depan'));
                $('#edit_nama_belakang').attr('value', $(this).data('nama_belakang'));
                $('#edit_jml_pinjam').attr('value', $(this).data('jml_pinjam'));
                $('#edit_jml_barang').attr('value', $(this).data('jml_barang'));
                $('#edit_tgl_pinjam').attr('value', $(this).data('tgl_pinjam'));
                const subbagian =  $(this).data('subbagian');
                const id_barang = $(this).data('barang');
                $('#edit_subbagian').html(`
                    <label for="edit_subbagian">SubBagian</label>
                    <?php foreach ($subbagian as $s) { ?>
                        <option value="<?= $s['id_subbagian']; ?>" ${ subbagian == <?= $s['id_subbagian'] ?> ? 'selected' : '' } ><?= $s['nm_subbagian']; ?></option>                    
                    <?php } ?>
                `);
                $('#edit_barang').html(`
                    <label for="edit_barang">Barang</label>
                    <?php foreach ($barang as $s) { ?>
                        <option value="<?= $s['id']; ?>" ${ id_barang == <?= $s['id'] ?> ? 'selected' : '' } ><?= $s['nm_barang']; ?></option>
                    <?php } ?>
                `);
                
            });

            //hapus data
            $(document).on('click', '#btn-hapus', function(){
                const id_hapus = $(this).data('id_hapus');
                const nama_depan = $(this).data('nama_depan');
                const base_url = "<?= base_url();  ?>";
                console.log(base_url);
                $('#modalHapus .modal-body').html(`<p>Anda yakin ingin menghapus data ini dari daftar peminjam ?</p>`);
                $('#modalHapus #btn_hapus_pinjam').attr('href', `${base_url}/pinjam/hapus/${id_hapus}`);
            });
        });
    </script>

</body>

</html>