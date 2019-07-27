$(window).ready(function () {
    $('#tanggal-pemira').submit(function (e) {
        var tm = $('input[type="date"]').val();
        var pm = $('input[name="pklmulai"]').val();
        var ps = $('input[name="pklselesai"]').val();
        e.preventDefault();
        if(tm == "" || pm == "" || ps == ""){
            alert("Tanggal dan jam tidak boleh kosong!");
        }
        else{
            $.post('functions/tanggal-pemira.php',{
                tglmulai: tm,
                pklmulai: pm,
                pklselesai: ps
            },
            function () {
                alert("Waktu PEMIRA telah diubah");
            });
        }
    });
});