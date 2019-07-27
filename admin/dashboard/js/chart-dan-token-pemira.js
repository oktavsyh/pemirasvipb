$(window).ready(function(){
    //live count
    var pilPK = 0;
    var kodePK = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","P","T","W"];
    var namaPK = [
        "Komunikasi",
        "Ekowisata",
        "Manajemen Informatika",
        "Teknik Komputer",
        "Supervisor Jaminan Mutu Pangan",
        "Manajemen Industri Jasa Makanan dan Gizi",
        "Teknologi Industri Benih",
        "Teknologi Produksi dan Manajemen Perikanan Budidaya",
        "Teknologi dan Manajemen Ternak",
        "Manajemen Agribisnis",
        "Manajemen Industri",
        "Analisis Kimia",
        "Teknik dan Manajemen Lingkungan",
        "Akuntansi",
        "Paramedik Veteriner",
        "Teknologi dan Manajemen Produksi Perkebunan",
        "Teknologi Produksi dan Pengembangan Masyarakat Pertanian"
    ];

    function chart(elem, arr, paslon) {
        // Load google charts
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        // Draw the chart and set the chart values
        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Paslon');
            data.addColumn('number', 'Jumlah Suara');
            data.addRows(arr);

            // Optional; add a title and set the width and height of the chart
            var options = {
                title: paslon,
                titleTextStyle:{
                    fontName: "Calibri",
                    fontSize: 24
                },
                width: 1057,
                height: 230,
                fontName: 'Calibri',
                fontSize: 16,
                is3D: true,
                sliceVisibilityThreshold: 0
            };

            // Display the chart inside the <div> element with id="piechart"
            var chart = new google.visualization.PieChart(elem);
            chart.draw(data, options);
        }
    }

    function voteTotal(tabel, judul, elem) {
        $.ajax({
            type: 'POST',
            url: 'functions/jmlsuara-tot.fun.php',
            data: {table: tabel},
            dataType: 'json',
            success: function(out) {
                chart(elem, out, judul);
            }
        });
    }

    function votePerPK(kodePK, tabel, kolom, judul, elem){
        $.ajax({
            type: 'POST',
            url: 'functions/jmlsuara-pk.fun.php',
            data: {
                pk: kodePK,
                table: tabel,
                field: kolom
            },
            dataType: 'json',
            success: function(out) {
                chart(elem, out, judul);
            }
        });
    }

    function pilihPK(idxPK){
        votePerPK(kodePK[idxPK], "paslon_bem_vokasi", "vokasi", "Paslon Ketua BEM Vokasi", $("#chart-vokasi-per-pk")[0]);
        votePerPK(kodePK[idxPK], "paslon_presma", "presma", "Paslon Presiden Mahasiswa", $("#chart-presma-per-pk")[0]);
        votePerPK(kodePK[idxPK], "paslon_bem_psdku", "psdku", "Paslon Ketua BEM SV PSDKU", $("#chart-psdku-per-pk")[0]);
        $(".prodi").html(namaPK[idxPK]);
    }

    var i;
    for(i = 0;i < 17;i++){
        $("select").append('<option value="'+i+'">'+kodePK[i]+'. '+namaPK[i]+'</option>');
    }

    function reload() {
        voteTotal("paslon_bem_vokasi", "Paslon Ketua BEM Vokasi", $("#chart-vokasi-tot")[0]);
        voteTotal("paslon_presma", "Paslon Presiden Mahasiswa", $("#chart-presma-tot")[0]);
        voteTotal("paslon_bem_psdku", "Paslon Ketua BEM SV PSDKU", $("#chart-psdku-tot")[0]);
        pilihPK(pilPK);
    }

    $('select').on('change', function() {
        pilPK = this.value;
        reload();
    });

    reload();
    var timeout = setInterval(reload, 1000);

    //kirim nim ke server tanpa refresh
    $("#form-token").submit(function(e){
        var nimInput = $('input[name="nim"]').val();
        e.preventDefault();
        $.post('functions/buat_token.fun.php', {
                nim: nimInput,
                submit: "submit"
            },
            function(token) {
                $("#status-buat-token").html(token);
                $('input[name="nim"]').val("");
            });
    });

    $("#form-admin").submit(function(e){
        e.preventDefault();
        if( confirm("Simpan perubahan?") ){
            var uname = $('input[name="uname"]').val();
            var oldpwd = $('input[name="oldpwd"]').val();
            var newpwd = $('input[name="newpwd"]').val();
            $.post('functions/update-admin.php', {
                    uname: uname,
                    oldpwd: oldpwd,
                    newpwd: newpwd,
                    submit: "submit"
                },
                function(admin) {
                    $("#status-update-admin").html(admin);
                    setTimeout(function () {
                        $("#status-update-admin").html("");
                    }, 2000);
                    $('input[name="oldpwd"]').val("");
                    $('input[name="newpwd"]').val("");
                });
        }
    });

});