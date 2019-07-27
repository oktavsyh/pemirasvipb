$(window).ready(function () {
    function ajaxCountdown(url, replace) {
        $.ajax({
            type: 'POST',
            url: url,
            success: function (out) {
                if(out == "true"){
                    window.location.replace(replace);
                }
                //console.log(out);
            },
            async: false
        });
    }
    function reload() {
        if(window.location.href.includes("admin")){
            var url = "../includes/cek-countdown-jika-blm-mulai-ajax.inc.php";
            var replace = "../countdown.php";
        }
        else{
            var url = "../includes/cek-countdown-jika-blm-mulai-ajax.inc.php";
            var replace = "countdown.php";
        }

        ajaxCountdown(url, replace);

        if(window.location.href.includes("admin")){
            var url = "../includes/countdown-sampai-selesai-cek-ajax.inc.php";
            var replace = "../votingselesai.php";
        }
        else{
            var url = "../includes/countdown-sampai-selesai-cek-ajax.inc.php";
            var replace = "votingselesai.php";
        }

        ajaxCountdown(url, replace);

        if(window.location.href.includes("admin")){
            var link = '../includes/countdown-sampai-selesai-print.inc.php';
        }
        else{
            var link = '../includes/countdown-sampai-selesai-print.inc.php';
        }
        $('.timer').load(link);
    }
    reload();
    var timeout = setInterval(reload, 1000);
});