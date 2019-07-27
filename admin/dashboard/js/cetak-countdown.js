$(window).ready(function () {
    function reload() {
        $.ajax({
            type: 'POST',
            url: '../../includes/cek-countdown-jika-blm-mulai-ajax.inc.php',
            success: function (out) {
                if(out == "true"){
                    var link = '../../includes/countdown-sampai-mulai-print.inc.php';
                }
                else{
                    var link = '../../includes/countdown-sampai-selesai-print.inc.php';
                }
                $('.timer').load(link);
            },
            async: false
        });
    }
    reload();
    var timeout = setInterval(reload, 1000);

    $('#downloadlaporan').click(function (e) {
        e.preventDefault();
        $.get("../../includes/countdown-sampai-selesai-print.inc.php", function(out){
            if(out == "Voting Selesai"){
                window.location.replace("laporanhasil/buatlaporan.php");
            }
            else{
                alert("Anda hanya dapat mendownload laporan bila voting sudah selesai");
            }
        });
    });

    $('#kelola-paslon a').click(function (e) {
        $.ajax({
            type: 'POST',
            url: '../../includes/cek-countdown-jika-blm-mulai-ajax.inc.php',
            success: function (out) {
                if(out != "true"){
                    e.stopPropagation();
                    alert('Anda tidak bisa mengelola data paslon saat voting sudah dimulai atau selesai');
                }
            },
            async: false
        });
    });

    $('#logout').click(function (e) {
        e.preventDefault();
        window.location.replace("../includes/logout.inc.php");
    });
});