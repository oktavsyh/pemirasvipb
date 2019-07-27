$(window).ready(function () {

    function printListPaslon(table) {
        $.post('functions/print-list-paslon.php',{
            tabel: table
        },function (out) {
            $('.list-group').html(out);
            $('.list-group a').click(function(e) {
                e.preventDefault();

                $that = $(this);

                $('.list-group').find('a').removeClass('active');
                $that.addClass('active');

                var nomorUrut = $('a.active').html().substring(0, 1);
                $.post('form-ubah-data-paslon.php',{
                    tabel: table,
                    nourut: nomorUrut
                },function (out) {
                    $('#import-form-ubah-data-paslon').html(out);
                });
            });
        });
    }

    uploadPaslon = function(input, table, update) {
        printListPaslon(table);

        $('input[name="submit"]').click(function(e) {
            e.preventDefault();
            if(
                $('input[name="nourut"]').val() == "" ||
                $('input[name="namapaslon"]').val() == "" ||
                $('textarea[name="deskripsi"]').val() == "" ||
                (
                    $('.custom-file-label').html() == "Pilih foto..." ||
                    $('.custom-file-label').html() == "Belum memilih foto..."
                )
            ){
                alert("Semua form harus diisi!");
            }
            else{
                if( $('input[name="nourut"]').val() < 1){
                    alert('Nomor urut tidak boleh kurang dari 1!');
                }
                else{
                    ajaxInputData(input, $('form')[0], table);
                }
            }
        });

        $('#btn-hapus-paslon').click(function (e) {
            e.preventDefault();
            if($('a.active').html() == undefined){
                alert('Anda belum memilih salah satu paslon');
            }
            else{
                if(confirm("Anda yakin ingin menghapus data paslon ini?")){
                    var nomorUrut = $('a.active').html().substring(0, 1);
                    $.post('functions/hapus-paslon.php', {
                        nourut: nomorUrut,
                        tabel: table
                    }, function (out) {
                        printListPaslon(table);
                        $('.status-hapus').html(out);
                        setTimeout(function () {
                            $('.status-hapus').html("");
                        }, 2000);
                    });
                }
            }
        });

        $('#btn-hapus-semua-paslon').click(function (e) {
            e.preventDefault();
            if(confirm('Anda yakin ingin menghapus SEMUA data paslon?')){
                $.post('functions/hapus-semua-paslon.php',{
                    tabel: table
                },function (out) {
                    printListPaslon(table);
                    $('.status-hapus').html(out);
                    setTimeout(function () {
                        $('.status-hapus').html("");
                    }, 2000);
                });
            }
        });

        $('#btn-ubah-data-paslon').click(function (e) {
            if($('a.active').html() == undefined){
                e.stopPropagation();
                alert('Anda belum memilih salah satu paslon');
            }{
                $('#status-tambah').toggleClass('status-upload');
                $('.custom-file-input').on('change',function(){
                    $(this).next('.custom-file-label').addClass("selected").html($(this).val().replace("C:\\fakepath\\", ""));
                    if($(this).val() == ""){
                        $(this).next('.custom-file-label').html("Belum memilih foto...");
                    }
                });

                $('#btn-simpan-ubah-data-paslon').click(function (e) {
                    e.preventDefault();
                    if(
                        $('#form-ubah-data-paslon input[name="nourut"]').val() == "" ||
                        $('#form-ubah-data-paslon input[name="namapaslon"]').val() == "" ||
                        $('#form-ubah-data-paslon textarea[name="deskripsi"]').val() == ""
                    ){
                        alert("Semua form harus diisi!");
                    }
                    else{
                        if( $('#form-ubah-data-paslon input[name="nourut"]').val() < 1){
                            alert('Nomor urut tidak boleh kurang dari 1!');
                        }
                        else{
                            ajaxInputData(update, $('#form-ubah-data-paslon')[0], table);
                        }
                    }
                });
            }
        });
    };

    function ajaxInputData(url, form, table){
        $.ajax({
            // Your server script to process the upload
            url: url,
            type: 'POST',

            // Form data
            data: new FormData(form),

            // Tell jQuery not to process data or worry about content-type
            // You *must* include these options!
            cache: false,
            contentType: false,
            processData: false,

            // Custom XMLHttpRequest
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) {
                    // For handling the progress of the upload
                    myXhr.upload.addEventListener('progress', function(e) {
                        if (e.lengthComputable) {
                            $('progress').attr({
                                value: e.loaded,
                                max: e.total,
                            });
                        }
                    } , false);
                }
                return myXhr;
            },

            success: function (out) {
                $('.status-upload').html(out);
                var status = out;
                if(out == "Data paslon berhasil ditambah!" || out == "Data paslon berhasil diperbarui!"){
                    $('input[name="nourut"]').val("");
                    $('input[name="namapaslon"]').val("");
                    $('textarea[name="deskripsi"]').val("");
                    $('.custom-file-label').html("");
                    printListPaslon(table);
                }
                setTimeout(function () {
                    $('.status-upload').html("");
                }, 2000);
                setTimeout(function () {
                    if(status == "Data paslon berhasil diperbarui!") {
                        $('#modal-ubah-data-paslon').modal('hide');
                        $('#status-tambah').toggleClass('status-upload');
                    }
                }, 1000);
            },
            async: false
        });
    }

});