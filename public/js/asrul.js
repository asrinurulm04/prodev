// TABEL PERSIAPAN PROSES

$(document).ready(function(){
    // tombol tambah proses
$("select.items").select2();
var a = 0;
$("table").on('click','.tr_clone_add' ,function() {
    $(this).closest('.tr_clone').find(".items").select2("destroy");
    var $tr = $(this).closest('.tr_clone');
    var $clone = $tr.clone();
    $clone.find(':text').val('');
    $tr.after($clone);
    $("select.items").select2();
});

$("select.items").select2();
var a = 0;
$("table").on('click','.tr_clone_add' ,function() {
    $(this).closest('.tr_clone').find(".items").select2("destroy");
    var $tr = $(this).closest('.tr_clone');
    var $clone = $tr.clone();
    $clone.find(':text').val('');
    $tr.after($clone);
    $("select.items").select2();
});

$("tabledata").on('click','.tr_clone_add' ,function() {
	alert("syalalalala");
    $(this).closest('.tr_clone').find(".items").select2("destroy");
    var $tr = $(this).closest('.tr_clone');
    var $clone = $tr.clone();
    $clone.find(':text').val('');
    $tr.after($clone);
    $("select.items").select2();
});

$("select.items").select2();
var a = 0;
$("tableklaim").on('click','.add_data' ,function() {
    $(this).closest('.add').find(".items").select2("destroy");
    var $tr = $(this).closest('.add');
    var $clone = $tr.clone();
    $clone.find(':text').val('');
    $tr.after($clone);
    $("select.items").select2();
});

$("select.items").select2();
var a = 0;
$("step4").on('click','.add_row' ,function() {
alert("syalalalala");
    $(this).closest('.data4').find(".items").select2("destroy");
    var $tr = $(this).closest('.data4');
    var $clone = $tr.clone();
    $clone.find(':text').val('');
    $tr.after($clone);
    $("select.items").select2();
});

    // delete baris proses

    $('#table').on('click', 'tr a', function(e) {
        e.preventDefault();
        var lenRow = $('#table tbody tr').length;
        if (lenRow == 1 || lenRow <= 1) {
            alert("Tidak bisa hapus semua baris!!");
        } else {
            $(this).parents('tr').remove();
        }
    });
	
	
    $('#tableklaim').on('click', 'tr a', function(e) {
        e.preventDefault();
        var lenRow = $('#tableklaim tbody tr').length;
        if (lenRow == 1 || lenRow <= 1) {
            alert("Tidak bisa hapus semua baris!!");
        } else {
            $(this).parents('tr').remove();
        }
    });
	
	$('#tabledata').on('click', 'tr a', function(e) {

        e.preventDefault();
        var lenRow = $('#tabledata tbody tr').length;
        if (lenRow == 1 || lenRow <= 1) {
            alert("Tidak bisa hapus semua baris!!");
        } else {
            $(this).parents('tr').remove();
        }
    });

    $('.data').keyup(function(event) {
        alert("coba");
        if(event.which >= 37 && event.which <= 40) return;
    
        // format number
        $(this).val(function(index, value) {
          return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        });
      });

    // pilihan proses

    $('#tableklaim').on('change', 'tr #komponen', function(e) {

        // kosongkan pilihan

        $(this).parent().next().find('#klaim').val("");

        $(this).parent().next().next().find('#detail').val("");

    });

 

    // pilihan lokasi proses

    $('#tableklaim').on('change', 'tr #komponen', function(e) {


        var klaim   = $(this).parent().next().find('#klaim');
        var detail   = $(this).parent().next().next().find('#detail');


        klaim.empty();

 

        // kosongkan pilihan

        $(this).parent().next().find('#klaim').empty();

        $(this).parent().next().next().find('#detail').val("");

 

        $.get("{{ route('getkomponen') }}", {idkomponen:klaim,idkomponen1:detail }, function(data){

            if (data.length >= 1){

                klaim.append($("<option/>",{

                    value : "",

                    text  : "Pilih..."

                }));

            }else if (data.length == 0){

                klaim.append($("<option/>",{

                    value : "",

                    text  : "Tidak ada data..."

                }));

            }

            $.each(data, function(i, dataklaim){

                klaim.append($("<option/>",{

                    value : dataklaim.id,

                    text  : dataklaim.klaim

                }));

                // jika data hanya 1 maka otomatis terseleksi

                if (data.length == 1){

                    klaim.val(dataklaim.id);

                }

            });

           

        });

 

    });

   

   

  });

 

