$(window).ready(function () {
    $('.custom-file-input').on('change',function(){
        $(this).next('.custom-file-label').addClass("selected").html($(this).val().replace("C:\\fakepath\\", ""));
        if($(this).val() == ""){
            $(this).next('.custom-file-label').html("Belum memilih foto...");
        }
    });
});