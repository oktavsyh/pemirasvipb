$(window).ready(function () {

    function printListTPS() {
        $.get('functions/print-list-tps.php',function (out) {
            $('.list-group').html(out);
            $('.list-group a').click(function(e) {
                e.preventDefault();

                $that = $(this);

                $('.list-group').find('a').removeClass('active');
                $that.addClass('active');

                var id = $('a.active').html().substring(0, 1);
                $.post('form-ubah-data-tps.php',{
                    nourut: id
                },function (out) {
                    $('#import-form-ubah-data-tps').html(out);
                });
            });
        });
    }

    function insertTPS() {
        printListTPS();

        $('input[name="submit"]').click(function(e) {
            e.preventDefault();
            if(
                $('input[name="uname"]').val() == "" ||
                $('input[name="namatps"]').val() == "" ||
                $('input[name="pwd"]').val() == ""
            ){
                alert("Semua form harus diisi!");
            }
            else{
                ajaxInputData('functions/insert-tps.php', $('form')[0]);
            }
        });

        $('#btn-hapus-tps').click(function (e) {
            e.preventDefault();
            if($('a.active').html() == undefined){
                alert('Anda belum memilih salah satu TPS!');
            }
            else{
                var idTPS = $('a.active').html().substring(0, 1);
                if(confirm("Anda yakin ingin menghapus data TPS ini?")){
                    $.post('functions/hapus-tps.php', {id: idTPS}, function (out) {
                        printListTPS();
                        $('.status-hapus').html(out);
                        setTimeout(function () {
                            $('.status-hapus').html("");
                        }, 2000);
                    });
                }
            }
        });

        $('#btn-hapus-semua-tps').click(function (e) {
            e.preventDefault();
            if(confirm('Anda yakin ingin menghapus SEMUA data tps?')){
                $.get('functions/hapus-semua-tps.php', function (out) {
                    printListTPS();
                    $('.status-hapus').html(out);
                    setTimeout(function () {
                        $('.status-hapus').html("");
                    }, 2000);
                });
            }
        });

        $('#btn-ubah-data-tps').click(function (e) {
            if($('a.active').html() == undefined){
                e.stopPropagation();
                alert('Anda belum memilih salah satu TPS');
            }
            else {
                $('#status-tambah').toggleClass('status-upload');

                $('#btn-simpan-ubah-data-tps').click(function (e) {
                    e.preventDefault();
                    if(
                        $('input[name="uname"]')[1].value === "" ||
                        $('input[name="namatps"]')[1].value === ""
                    ){
                        $('.status-upload').html("Username dan nama TPS harus diisi!");
                        setTimeout(function () {
                            $('.status-upload').html("");
                        }, 2000);
                    }
                    else{
                        var pwdLama = $('input[name="pwdlama"]').val();
                        var pwdBaru = $('input[name="pwdbaru"]').val();

                        if( pwdLama !== "" && pwdBaru !== ""){
                            var idTPS = $('a.active').html().substring(0, 1);
                            $.post('functions/read-akun-tps.php', {id: idTPS},
                                function (passLama) {
                                    if( passLama === $('input[name="pwdlama"]').val() ){
                                        ajaxInputData('functions/update-tps.php', $('#form-ubah-data-tps')[0]);
                                    }
                                    else{
                                        $('.status-upload').html("Password lama salah!");
                                        setTimeout(function () {
                                            $('.status-upload').html("");
                                        }, 2000);
                                    }
                                }
                            );
                        }
                        else if( ( (pwdLama === "")  && !(pwdBaru === "") ) || ( !(pwdLama === "")  && !(pwdBaru === "") ) ){
                            $('.status-upload').html("Isi password lama dan password baru jika ingin mengganti password!");
                            setTimeout(function () {
                                $('.status-upload').html("");
                            }, 2000);
                        }
                        else{
                            ajaxInputData('functions/update-tps.php', $('#form-ubah-data-tps')[0]);
                        }
                    }
                });
            }
        });
    };

    insertTPS();

    function ajaxInputData(url, form){
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
                if(out == "Akun TPS berhasil ditambah!" || out == "Akun TPS berhasil diperbarui!"){
                    $('input[name="uname"]').val("");
                    $('input[name="pwd"]').val("");
                    $('input[name="pwdlama"]').val("");
                    $('input[name="pwdbaru"]').val("");
                    $('input[name="namatps"]').val("");
                    $('.custom-file-label').html("");
                    printListTPS();
                }
                setTimeout(function () {
                    $('.status-upload').html("");
                }, 2000);
                setTimeout(function () {
                    if(out == "Akun TPS berhasil diperbarui!") {
                        $('#modal-ubah-data-tps').modal('hide');
                        $('#status-tambah').toggleClass('status-upload');
                    }
                }, 1000);
            },
            async: false
        });
    }

});