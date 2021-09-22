$(document).on("click", "#btn-edit", function () {
  $(".modal-body #id-barang").val($(this).data("id"));
  $(".modal-body #nm_barang").val($(this).data("nm_barang"));
  $(".modal-body #jns_barang").val($(this).data("jns_barang"));
  $(".modal-body #tgl_masuk_barang").val($(this).data("tgl_masuk_barang"));
  $(".modal-body #jml_barang").val($(this).data("jml_barang"));
  $(".modal-body #ket_barang").val($(this).data("ket_barang"));
});
